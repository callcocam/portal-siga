<?php
namespace Admin\View\Helper;
use Base\Model\Result;
use Base\Model\Check;
use Interop\Container\ContainerInterface;
use Zend\Debug\Debug;
use Zend\View\Helper\AbstractHelper;
use Zend\Db\Adapter\AdapterInterface;

/**
* AdminHelper
*/
class AdminHelper extends AbstractHelper
{
    protected $data;

    const MSG_SUCCESS="SUA BUSCA RETORNOU %s";
    const MSG_ERROR="SUA BUSCA RETORNOU NENHUM RESULTADO";

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
   public  function __construct(ContainerInterface $container)
	{
		# code...
        $this->container = $container;
    }

    public function countRegister($tabela,$sql="",$paremeter=[]){
        $this->setData(new Result());
        $this->data->setError(self::MSG_ERROR);
        $this->data->setResult(false);
        $adapter =$this->container->get(AdapterInterface::class);
        $statement = $adapter->createStatement("SELECT COUNT(*) as qtd FROM {$tabela} {$sql}");
        $result = $statement->execute($paremeter);
        if($result->count()){
            $row= $result->current();
            return str_pad($row['qtd'],5,"0",STR_PAD_LEFT);
        }
        return '00000';

    }

    public function widgets($qtd,$title='Title',$text="Lorem ipsum psdea itgum rixt.",$ico='  fa-check-square-o',$col='flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12'){
        $flipInY=$this->view->Html('div')->setClass("animated {$col}");
        $stats=$this->view->Html('div')->setClass("tile-stats");
        $icon=$this->view->Html('div')->setClass("icon")->setText($this->view->Html('i')->setClass("fa {$ico}"));
        $count=$this->view->Html('div')->setClass("count")->setText($qtd);
        $h3=$this->view->Html('h3')->setText($title);
        $p=$this->view->Html('p')->setText($text);
        $stats->setText(PHP_EOL)->appendText($icon)->appendText(PHP_EOL)->appendText($count)->appendText(PHP_EOL)->appendText($h3)->appendText(PHP_EOL)->appendText($p);
        $flipInY->setText(PHP_EOL)->appendText($stats);
        echo $flipInY;

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