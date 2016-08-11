<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 04/08/2016
 * Time: 10:14
 */

namespace Home\View\Helper;


use Base\Model\Cache;
use Base\Model\Check;
use Base\Model\Result;
use Base\Services\Client;
use Cidadeonline\Form\ComentariosForm;
use Cidadeonline\Form\EmpresasForm;
use Cidadeonline\Form\SearchForm;
use Home\Form\AuthForm;
use Home\Form\ProfileForm;
use Home\Form\RegisterForm;
use Cidadeonline\Form\ClassificadosForm;
use Interop\Container\ContainerInterface;
use Mail\Form\MailForm;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Debug\Debug;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Helper\AbstractHelper;
use Zend\Db\Adapter\AdapterInterface;
class HomeHelper extends AbstractHelper{

    protected static $html = array();
    protected static $labels = array();
    protected static $hidden = array();

    const MSG_SUCCESS="SUA BUSCA RETORNOU %s";
    const MSG_ERROR="SUA BUSCA RETORNOU NENHUM RESULTADO";
    protected $MES=['Jan'=>'Janeiro','Feb'=>'Fevereiro','Mar'=>'Março','Apr'=>'Abril','May'=>'Maio','Jun'=>"Junho",'Jul'=>'Julho','Aug'=>'Agosto','Sep'=>'Setembro','Oct'=>'Outubro','Nov'=>'Novembro','Dec'=>'Dezembro'];
    protected $DIASEMANA=['1'=>"Seg",'2'=>"Terç",'3'=>"Quart",'4'=>"Quint",'5'=>"Sext",'6'=>"Sab",'7'=>"Dom"];
    protected $categorias=['onde-comprar'=>"ONDE COMPRAR",'onde-comer'=>"ONDE COMER",'onde-ficar'=>"ONDE FICAR",'onde-se-divertir'=>"ONDE SE DIVERTIR",
        'quero-comprar'=>"QUERO COMPRAR",'quero-vender'=>"QUERO VENDER",'quero-trocar'=>"QUERO TROCAR",'quero-alugar'=>"QUERO ALUGAR"];
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

    /**
     * @return array
     */
    public function getDIASEMANA($key)
    {
        if(isset($this->DIASEMANA[$key])){
            return $this->DIASEMANA[$key];
        }
        return $key;
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
                $this->data->setData($this->paginator($results));
            }

          $this->data->setError(sprintf(self::MSG_SUCCESS,$results->count()));
        }
        return $this->getData();
    }



    public function paginator($data){
        $resultSet = new ResultSet(); //$this->tableGateway->getResultSetPrototype();
        $resultSet->initialize($data);
        $paginator=new Paginator(new ArrayAdapter($resultSet->toArray()));
        $paginator->setCurrentPageNumber($this->view->page);
        $paginator->setItemCountPerPage($this->config->count_per_page);
        return $paginator;
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
                    $a=$this->view->Html('a')->setAttributes(['href'=>$this->view->url('cidadeonline-pages',['action'=>$action,'id'=>$key])])->setText($o)->appendText(" ({$count} )");
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
                    $a=$this->view->Html('a')->setAttributes(['href'=>$this->view->url('cidadeonline-pages',['action'=>$action,'id'=>$o['id']])])->setText($o['title'])->appendText(" ({$count} )");
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
            $Linha[$param_url]=$this->view->url('cidadeonline-pages',['action'=>$action,'id'=>$Linha[$param_url]]);
        }
        if(isset($Linha['title'])){
            $Linha['title']= Check::Words($Linha['title'], $wordTitle);
        }
        if(isset($Linha['description'])){
            $Linha['description'] = Check::Words($Linha['description'], $wordDesc);
        }
        if(isset($Linha['created'])){
            $Linha['datetime'] = date('Y-m-d', strtotime($Linha['created']));
            $Linha['dia'] = date('d', strtotime($Linha['created']));
            $Linha['mes'] = $this->MES[date('M', strtotime($Linha['created']))];
            $Linha['ano'] = date('Y', strtotime($Linha['created']));
        }
        if(isset($Linha['modified'])){
            $Linha['pubdate'] = date('d/m/Y H:i', strtotime($Linha['modified']));
            $Linha['horas'] = date('H:i', strtotime($Linha['modified']));
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
    public function getCategorias($key="NÃO ENCONTRADA")
    {

        if(isset($this->categorias[$key])){
            return $this->categorias[$key];
        }
        return $key;
    }


    public function formComentarios($data){

        if($this->view->user):
        extract($data);
        $form = $this->container->get(ComentariosForm::class);
        $form->setAttribute('action', $this->view->url('cidadeonline-pages', array('controller' => 'cidadeonline', 'action' => 'comments')));
        $form->setAttribute('id', $id_form);
        $this->view->formElementErrors()
            ->setMessageOpenFormat('<ul class="nav"><li class="erro-obrigatorio">')
            ->setMessageSeparatorString('</li>')->render($form);
        $form->get('tipo')->setValue($tipo)->setAttribute('type','hidden');
        $form->get('parent')->setValue($parent)->setAttribute('type','hidden');
        $form->get('created_by')->setValue($this->view->user->id)->setAttribute('type','hidden');
        $form->get('parent_id')->setValue($parent_id)->setAttribute('type','hidden');
        $form->get('title')->setValue($title)->setAttribute('type','hidden');
        $form->get('created')->setAttribute('type','hidden');
        $form->get('state')->setValue($this->config->moderarcomments)->setAttribute('type','hidden');
        $form->get('access')->setValue('5')->setAttribute('type','hidden');
        $formRender[]= $this->view->form()->openTag($form);
        $this->GerarElement($form);
        $primeiro = str_replace(array_keys(self::$html), array_values(self::$html), $html);
        $formRender[]= str_replace(array_keys(self::$labels), array_values(self::$labels), $primeiro);
        $formRender[]= $this->view->form()->closeTag();
        return implode("",$formRender);
        else:
            return $this->alert("Por Favor Faça Login");
        endif;
    }

    public function formRegister($html){
        echo  $this->view->messages();
        if(!$this->view->user):
            $form = $this->container->get(RegisterForm::class);
            $form->setAttribute('action', $this->view->url('cidadeonline-pages', array('controller' => 'cidadeonline', 'action' => 'cadastro')));
             $this->view->formElementErrors()
                ->setMessageOpenFormat('<ul class="nav"><li class="erro-obrigatorio">')
                ->setMessageSeparatorString('</li>')->render($form);
            $formRender[]= $this->view->form()->openTag($form);
            $form->get('created')->setAttribute('type','hidden');
            $form->get('modified')->setAttribute('type','hidden');
            $form->get('asset_id')->setValue('clientes');
            $form->get('images')->setValue('no_avatar.jpg');
            $this->GerarElement($form);
            $primeiro = str_replace(array_keys(self::$html), array_values(self::$html), $html);
            $formRender[]= str_replace(array_keys(self::$labels), array_values(self::$labels), $primeiro);
            $formRender[]= $this->view->form()->closeTag();
            return implode("",$formRender);
        else:
            return $this->alert("Por Favor Faça Login");
        endif;
    }

    public function formProfile($html){
        echo  $this->view->messages();
        if($this->view->user):
            $form = $this->container->get(ProfileForm::class);
            $form->setData((array)$this->view->user);
            $form->setAttribute('action', $this->view->url('cidadeonline-pages', array('controller' => 'cidadeonline', 'action' => 'profile')));
            $this->view->formElementErrors()
                ->setMessageOpenFormat('<ul class="nav"><li class="erro-obrigatorio">')
                ->setMessageSeparatorString('</li>')->render($form);
            $formRender[]= $this->view->form()->openTag($form);
            $form->get('modified')->setAttribute('type','hidden');
            $form->get('access')->setAttribute('type','hidden');
            $this->GerarElement($form);
            $primeiro = str_replace(array_keys(self::$html), array_values(self::$html), $html);
            $formRender[]= str_replace(array_keys(self::$labels), array_values(self::$labels), $primeiro);
            $formRender[]= $this->view->form()->closeTag();
            return implode("",$formRender);
        else:
            return $this->alert("Por Favor Faça Login");
        endif;
    }

    public function formLogin($html){
        echo  $this->view->messages();
        if(!$this->view->user):
            $form = $this->container->get(AuthForm::class);
            $form->setAttribute('action', $this->view->url('cidadeonline-pages', array('controller' => 'cidadeonline', 'action' => 'login')));
            $this->view->formElementErrors()
                ->setMessageOpenFormat('<ul class="nav"><li class="erro-obrigatorio">')
                ->setMessageSeparatorString('</li>')->render($form);
            $formRender[]= $this->view->form()->openTag($form);
            $this->GerarElement($form);
            $primeiro = str_replace(array_keys(self::$html), array_values(self::$html), $html);
            $formRender[]= str_replace(array_keys(self::$labels), array_values(self::$labels), $primeiro);
            $formRender[]= $this->view->form()->closeTag();
            return implode("",$formRender);
        else:
            return $this->alert("Por Favor Faça Login");
        endif;
    }

    public function formContato($html){
           echo  $this->view->messages();
            $form = $this->container->get(MailForm::class);
            $form->setAttribute('action', $this->view->url('cidadeonline-pages', array('controller' => 'cidadeonline', 'action' => 'contact')));
            $this->view->formElementErrors()
                ->setMessageOpenFormat('<ul class="nav"><li class="erro-obrigatorio">')
                ->setMessageSeparatorString('</li>')->render($form);
            $formRender[]= $this->view->form()->openTag($form);
            $this->GerarElement($form,false);
            $primeiro = str_replace(array_keys(self::$html), array_values(self::$html), $html);
            $formRender[]= str_replace(array_keys(self::$labels), array_values(self::$labels), $primeiro);
            $formRender[]= $this->view->form()->closeTag();
            return implode("",$formRender);

    }


    public function formMinhaEmpresa($html){
        echo  $this->view->messages();
        if($this->view->user):

            $form = $this->container->get(EmpresasForm::class);
            $empresa=$this->ExeRead('bs_empresas',' WHERE created_by=?',[$this->view->user->id],true);
            if($empresa->getResult()){
                $form->setData($empresa->getData());
            }
            $form->setAttribute('action', $this->view->url('cidadeonline-pages', array('controller' => 'cidadeonline', 'action' => 'atualizaempresa')));
            $this->view->formElementErrors()
                ->setMessageOpenFormat('<ul class="nav"><li class="erro-obrigatorio">')
                ->setMessageSeparatorString('</li>')->render($form);
            $formRender[]= $this->view->form()->openTag($form);
            $form->get('url')->setAttribute('type','hidden');
            $form->get('access')->setAttribute('type','hidden');
            $form->get('uf')->setAttribute('type','hidden');
            $form->get('created_by')->setValue($this->view->user->id);
            $this->GerarElement($form);
            $primeiro = str_replace(array_keys(self::$html), array_values(self::$html), $html);
            $formRender[]= str_replace(array_keys(self::$labels), array_values(self::$labels), $primeiro);
            $formRender[]= $this->view->form()->closeTag();
            return implode("",$formRender);
        else:
            return $this->alert("Por Favor Faça Login");
        endif;
    }

    public function formNovoAnuncio($html){
            echo  $this->view->messages();
            if($this->view->user):
                $form = $this->container->get(ClassificadosForm::class);
                $form->setAttribute('action', $this->view->url('cidadeonline-pages', array('controller' => 'cidadeonline', 'action' => 'finalizaanucio')));
                $this->view->formElementErrors()
                    ->setMessageOpenFormat('<ul class="nav"><li class="erro-obrigatorio">')
                    ->setMessageSeparatorString('</li>')->render($form);
                $formRender[]= $this->view->form()->openTag($form);
                $form->get('url')->setAttribute('type','hidden');
                $form->get('access')->setAttribute('type','hidden');
                $form->get('created_by')->setValue($this->view->user->id);
                $this->GerarElement($form);
                $primeiro = str_replace(array_keys(self::$html), array_values(self::$html), $html);
                $formRender[]= str_replace(array_keys(self::$labels), array_values(self::$labels), $primeiro);
                $formRender[]= $this->view->form()->closeTag();
                return implode("",$formRender);
            else:
                return $this->alert("Por Favor Faça Login");
            endif;
        }

    public function formSearch($html,$url,$filtro=[]){
        echo  $this->view->messages();
            $form = $this->container->get(SearchForm::class);
            $form->setData($filtro);
            $form->setAttribute('action', $url);
            $this->view->formElementErrors()
                ->setMessageOpenFormat('<ul class="nav"><li class="erro-obrigatorio">')
                ->setMessageSeparatorString('</li>')->render($form);
            $formRender[]= $this->view->form()->openTag($form);
            self::$html['#search-value#']=$form->get('search')->getValue();
            self::$html['#count-value#']=$form->get('count')->getValue();
            self::$html['#first-value#']=$form->get('first')->getValue();
            self::$html['#lasted-value#']=$form->get('lasted')->getValue();
            $this->GerarElement($form);
            $primeiro = str_replace(array_keys(self::$html), array_values(self::$html), $html);
            $formRender[]= str_replace(array_keys(self::$labels), array_values(self::$labels), $primeiro);
            $formRender[]= $this->view->form()->closeTag();
            return implode("",$formRender);

    }



    public function GerarElement($form,$removeClass=true) {
        foreach ($form->getElements() as $key => $element) {
            $visible = "";
            //verifica se o usuario pode ter acesso ao campo
            if ($element->hasAttribute('placeholder')) {
                $element->setAttribute('placeholder', $this->view->translate($element->getAttribute('placeholder')));
            }
            if($removeClass){
                $element->setAttribute('class','');
            }

            if (!empty($element->getLabel())) {
                self::$labels["{{{$key}}}"] = $this->view->Html("label")->setAttributes(array("class" => "field-label", "for" => $element->getName()))->setText($this->view->translate($element->getLabel()));
            }
            // verifica se e um campo hidden [oculto]
            if ($element->getAttribute('type') === "hidden") {
                self::$html["#{$key}#"] = $this->view->formHidden($element->setLabel(''));
            } elseif ($element->getAttribute('type') === "submit") {
                self::$html["#{$key}#"] = $this->view->formSubmit($element);
            } elseif ($element->getAttribute('type') === "radio") {
                self:: $html["#{$key}#"] = $this->radio($element);
            } elseif ($element->getAttribute('name') === "images") {
                $base_path = $this->container->get('request')->getServer('DOCUMENT_ROOT');
                if (!is_file(sprintf("%s%sdist%s%s", $base_path, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $element->getValue()))):
                    $caminho = "no_avatar.jpg";
                else:
                    $caminho = $element->getValue();
                endif;
                self::$html["#imagePreview#"] = \Base\Model\Check::Image($caminho, $element->getValue(), "420", "330", "thumbnail img-responsive preview_IMG");
                $element->setAttribute('type', 'hidden')->setLabel("");
                self::$html["#{$key}#"] = $this->view->formHidden($element);
            } else {
                self::$html["#{$key}#"] = $this->view->formRow($element->setLabel(''));
           }
        }

    }

    public function readComments($comments,$tpl,$tpl_form)
    {
        $this->setSelect(" a.*, b.title as autor,b.images as images ");
        foreach ($comments->getData() as $comment):
            $comment['child']="";
            $comment['resp']="";
            $respostas=$this->ExeRead("bs_comentarios a", ", bs_users b WHERE a.created_by=b.id AND  a.parent=? AND a.parent_id=? AND a.tipo=? ORDER BY a.modified DESC", [$this->view->parent,$this->view->id,$comment['id']]);
            if ($respostas->getResult()):
                $filhos=$this->readComments($respostas,$tpl,$tpl_form);
                $comment['resp']=$this->view->Html('ul')->setText($filhos);
                $comment['child']="children";
            endif;
            $data['title']=$comment['title'];
            $data['html']=$tpl_form;
            $data['parent_id']=$comment['parent_id'];
            $data['parent']=$comment['parent'];
            $data['tipo']=$comment['id'];
            $data['id_form']="";
            $comment['idAbreForm']=$comment['id'];
            $comment['formulario']=$this->formComentarios($data);
            $html[]=$this->Show($comment, $tpl,"#",50,1000);
        endforeach;
        $this->setSelect(" * ");
        return implode(PHP_EOL,$html);
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