<?php
namespace Admin\View\Helper;
use Base\Model\Result;
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


}