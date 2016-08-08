<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 04/08/2016
 * Time: 10:14
 */

namespace Cidadeonline\View\Helper;


use Base\Model\Cache;
use Base\Model\Result;
use Base\Services\Client;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\View\Helper\AbstractHelper;
use Zend\Db\Adapter\AdapterInterface;
class CidadeonlineHelper extends AbstractHelper{

    const MSG_SUCCESS="SUA BUSCA RETORNOU %s";
    const MSG_ERROR="SUA BUSCA RETORNOU NENHUM RESULTADO";
    protected $MES=['Jan'=>'Janeiro','Feb'=>'Fevereiro','Mar'=>'Março','Apr'=>'Abril','May'=>'Maio','Jun'=>"Junho",'Jul'=>'Julho','Aug'=>'Agosto','Sep'=>'Setembro','Oct'=>'Outubro','Nov'=>'Novembro','Dec'=>'Dezembro'];
    protected $categorias=['onde-comprar'=>"ONDE COMPRAR",'onde-comer'=>"ONDE COMER",'onde-ficar'=>"ONDE FICAR",'onde-se-divertir'=>"ONDE SE DIVERTIR"];
    protected $config;
    /**
     * @var $data Result
     */
    protected $data;

    private $linha;

    protected $select=' * ';
    /**
     * @var Keys
     */
    private $Keys;
    /**
     * @var Values
     */
    private $Values;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container){

        $this->container = $container;
        $this->config=$this->container->get("ZfConfig");


    }

    public function ExeRead($tabela,$extraselect="",$params=[],$current=false)
    {
       // echo sprintf('SELECT %s FROM %s %s  ',$this->select,$tabela,$extraselect);die;
        $this->setData(new Result());
        $this->data->setError(self::MSG_ERROR);
        $this->data->setResult(false);
        $adapter =$this->container->get(AdapterInterface::class);
        $statement = $adapter->createStatement(sprintf('SELECT %s FROM %s %s  ',$this->select,$tabela,$extraselect));
        $results = $statement->execute($params);
        if($results->count()){
          $this->data->setResult($results->count());
            if($current){
                $this->data->setData($results->current());
            }
            else{
                $this->data->setData($results);
            }

          $this->data->setError(sprintf(self::MSG_SUCCESS,$results->count()));

        }
        return $this->getData();
    }

    public function getCidades($action,$tabela="bs_empresas")
    {
        /**
         * @var $client ClientHttp
         */
        $url_cidades=[];
        $cache = new Cache();
        if($cache->hasItem('busca-cidedes')){
           $data=$cache->getItem('busca-cidedes');
            foreach($data as $key=> $o){
                 $this->setSelect(" count(cidade) as result ");
                 $encontrou=$this->ExeRead($tabela,' WHERE  catid=? AND cidade=?',[$action,$key],true);
                 $this->setSelect(" * ");
                   $count="0";
                   if($encontrou->getResult()){
                     $count=$encontrou->getData()['result'];
                   }
                if((int)$count){
                    $a=$this->view->Html('a')->setAttributes(['href'=>$this->view->url('cidaonline-pages',['action'=>$action,'id'=>$key])])->setText($o)->appendText(" ({$count} )");
                    $url_cidades[]=$this->view->Html('li')->setText($a)->appendText(PHP_EOL);
                }

            }
            return implode("",$url_cidades);
        }
        $client = $this->container->get(Client::class);
        $client->setUri(sprintf("%s/%s",$this->config->serverHost,'cidades'));
        $url_cidades=[];
        $response = $client->send();
        if ($response->isSuccess()) {
            $data=json_decode($response->getBody(),true);
            foreach($data['data'] as $o){
                $arraycidades[$o['id']]=$o['title'];
                $dadosCidade[$o['id']]=$o;
                $this->setSelect(" count(cidade) as result ");
                $encontrou=$this->ExeRead($tabela,' WHERE  catid=? AND cidade=?',[$action,$o['id']],true);
                $this->setSelect(" * ");
                $count="0";
                if($encontrou->getResult()){
                    $count=$encontrou->getData()['result'];
                }
                if((int)$count){
                    $a=$this->view->Html('a')->setAttributes(['href'=>$this->view->url('cidaonline-pages',['action'=>$action,'id'=>$o['id']])])->setText($o['title'])->appendText(" ({$count} )");
                    $url_cidades[]=$this->view->Html('li')->setText($a)->appendText(PHP_EOL);
                }
            }
            $cache->setItem("busca-cidedes",$arraycidades);
            $cache->setItem("dados-cidedes",$dadosCidade);
            return implode("",$url_cidades);
        }
    }

    public function getCidade($ibge)
    {
        /**
         * @var $client ClientHttp
         */
        $cache = new Cache();
        if($cache->hasItem('busca-cidedes')){
            $data=$cache->getItem('busca-cidedes');
            return $data[$ibge];
        }
        $client = $this->container->get(Client::class);
        $client->setUri(sprintf("%s/%s",$this->config->serverHost,'cidades'));
        $response = $client->send();
        if ($response->isSuccess()) {
            $data=json_decode($response->getBody(),true);
            foreach($data['data'] as $o){
                $arraycidades[$o['id']]=$o['title'];
                $dadosCidade[$o['id']]=$o;
        }
            $cache->setItem("busca-cidedes",$arraycidades);
            $cache->setItem("dados-cidedes",$dadosCidade);
            return $arraycidades[$ibge];
        }
    }

    public function getDadosCidade($ibge)
    {
        /**
         * @var $client ClientHttp
         */
        $cache = new Cache();
        if($cache->hasItem('dados-cidedes')){
            $data=$cache->getItem('dados-cidedes');
            return $data[$ibge];
        }
        $client = $this->container->get(Client::class);
        $client->setUri(sprintf("%s/%s",$this->config->serverHost,'cidades'));
        $response = $client->send();
        if ($response->isSuccess()) {
            $data=json_decode($response->getBody(),true);
            foreach($data['data'] as $o){
                $arraycidades[$o['id']]=$o['title'];
                $dadosCidade[$o['id']]=$o;
            }
            $cache->setItem("busca-cidedes",$arraycidades);
            $cache->setItem("dados-cidedes",$dadosCidade);
            return $dadosCidade[$ibge];
        }
    }


    public function CatByName($name){
        $this->setData(new Result());
        $this->data->setError(self::MSG_ERROR);
        $this->data->setResult(false);
        $adapter =$this->container->get(AdapterInterface::class);
        $statement = $adapter->createStatement('SELECT * FROM bs_categorias WHERE url=?');
        $result = $statement->execute([$name]);
        if($result->count()){
            if ($result instanceof ResultInterface && $result->isQueryResult()) {
                $resultSet = new ResultSet();
                $resultSet->initialize($result);
                $this->data->setResult($result->count());
                $this->data->setData($resultSet->current());
                $this->data->setError(sprintf(self::MSG_SUCCESS,$result->count()));

            }
        }
        return $this->getData();
    }

    public function CatById($name){
        $this->setData(new Result());
        $this->data->setError(self::MSG_ERROR);
        $this->data->setResult(false);
        $adapter =$this->container->get(AdapterInterface::class);
        $statement = $adapter->createStatement('SELECT * FROM bs_categorias WHERE id=?');
        $result = $statement->execute([$name]);
        if($result->count()){
            if ($result instanceof ResultInterface && $result->isQueryResult()) {
                $resultSet = new ResultSet();
                $resultSet->initialize($result);
                $this->data->setResult($result->count());
                $this->data->setData($resultSet->current());
                $this->data->setError(sprintf(self::MSG_SUCCESS,$result->count()));

            }
        }
        return $this->getData();
    }

    /**
     * @param string $select
     */
    public function setSelect($select)
    {
        $this->select = $select;
    }



    public function alert($msg,$tipo="danger"){
        $alert=$this->view->Html('div')->setClass("alert alert-{$tipo}");
        $button=$this->view->Html('button')->setAttributes(['type'=>"button",'data-dismiss'=>"alert",'aria-hidden'=>"true"])->setText(PHP_EOL)->appendText('&times;')->appendText(PHP_EOL);
        $strong=$this->view->Html('strong')->setText(PHP_EOL)->appendText($msg);
        $alert->setText(PHP_EOL)->appendText($button)->appendText(PHP_EOL)->appendText($strong)->appendText(PHP_EOL);
        echo $alert;

    }

    /**
     * <b>Exibir Template View:</b> Execute um foreach com um getResult() do seu model e informe o envelope
     * neste método para configurar a view. Não esqueça de carregar a view acima do foreach com o método Load.
     * @param array $Linha = Array com dados obtidos
     * @param View $View = Template carregado pelo método Load()
     * @param string $action
     * @param int $wordTitle
     * @param int $wordDesc
     * @return mixed
     */
    public function Show(array $Linha, $View,$action="index",$wordTitle=12,$wordDesc=38,$param_url="url") {
        if(isset($Linha[$param_url])){
            $Linha[$param_url]=$this->view->url('cidaonline-pages',['action'=>$action,'id'=>$Linha[$param_url]]);
        }
        if(isset($Linha['title'])){
            $Linha['title']= \Base\Model\Check::Words($Linha['title'], $wordTitle);
        }
        if(isset($Linha['description'])){
            $Linha['description'] = \Base\Model\Check::Words($Linha['description'], $wordDesc);
        }
        if(isset($Linha['created'])){
            $Linha['datetime'] = date('Y-m-d', strtotime($Linha['created']));
            $Linha['dia'] = date('d', strtotime($Linha['created']));
            $Linha['mes'] = $this->MES[date('M', strtotime($Linha['created']))];
            $Linha['ano'] = date('Y', strtotime($Linha['created']));
        }
        if(isset($Linha['modified'])){
            $Linha['pubdate'] = date('d/m/Y H:i', strtotime($Linha['modified']));
        }

        if(isset($Linha['images'])){
            $Linha['images']=str_replace('\\','/',$Linha['images']);
        }
        $this->setKeys($Linha);
        $this->setValues();
       return $this->ShowView($View);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getCategorias($key="")
    {
        if(empty($key)){
            return $this->categorias;
        }
        if(isset($this->categorias[$key])){
            return $this->categorias[$key];
        }
        return "NÃO ENCONTRADA";
    }



    /*
    * ***************************************
    * **********  PRIVATE METHODS  **********
    * ***************************************
    */

    //Executa o tratamento dos campos para substituição de chaves na view.
    private function setKeys($Linha) {
        $this->linha = $Linha;
        $this->Keys = explode('&', '#' . implode("#&#", array_keys($this->linha)) . '#');
      }

    //Obtém os valores a serem inseridos nas chaves da view.
    private function setValues() {
        $this->Values = array_values($this->linha);
    }

    //Exibe o template view com echo!
    private function ShowView($View) {
        return str_replace($this->Keys, $this->Values, $View);
    }



} 