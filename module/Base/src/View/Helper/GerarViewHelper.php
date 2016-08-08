<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 24/07/2016
 * Time: 18:40
 */

namespace Base\View\Helper;


use Base\Form\BuscaForm;
use Base\Services\Table;
use Interop\Container\ContainerInterface;
use Zend\Debug\Debug;
use Zend\View\Helper\AbstractHelper;

class GerarViewHelper extends AbstractHelper {


    /**
     * @var ContainerInterface
     */
    private $container;

    protected $table;
    protected static $html = array();
    protected static $labels = array();
    protected static $hidden = array();
    protected static $btn = array();
    protected static $user;
    protected static $campos_array = array('1' => 'criteria');
    protected static $id;
    protected static $body;
    protected static $gegal;
    protected static $images;
    protected static $datas;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->table=$container->get(Table::class);
    }

    public function BlockList($table,$col="3")
     {
         $colunas=$this->table->setColumns($table)->getColumns();
         $div_col=$this->view->Html('div')->setClass('col-md-3 col-sm-6 col-xs-12 col-box-list')->setText(PHP_EOL);
         $pricing=$this->view->Html('div')->setClass('pricing')->setText(PHP_EOL);
         $title=$this->view->Html('div')->setClass('title')->setText(PHP_EOL)->appendText($this->view->Html('h1')->setText("{{title}}"))->appendText(PHP_EOL);
         $x_content=$this->view->Html('div')->setClass('x_content')->setText(PHP_EOL);
         $divSemClass=$this->view->Html('div')->setText(PHP_EOL);
         $pricing_features=$this->view->Html('div')->setText(PHP_EOL)->setClass('pricing_features');
         $pricing_footer=$this->view->Html('div')->setClass('pricing_footer')->setText(PHP_EOL);
         $ul=$this->view->Html('ul')->setClass('list-unstyled text-left')->setText(PHP_EOL);
         $colunaName=[];
         foreach($colunas as $coluna):
             extract($coluna);
             $i=$this->view->Html('i')->setClass('fa fa-check  text-success');
             $strong=$this->view->Html('strong')->setText("{{{$name}}}");
             $colunaName[]=$this->view->Html('li')->setText($i)->appendText(PHP_EOL)->appendText($strong);
         endforeach;
         $ul->appendText(implode(PHP_EOL,$colunaName));
         $pricing_features->appendText($ul);
         $divSemClass->appendText($pricing_features);
         $x_content->appendText($divSemClass);
         $pricing_footer->appendText("{{buttons}}")->appendText(PHP_EOL);
         $x_content->appendText(PHP_EOL)->appendText($pricing_footer)->appendText(PHP_EOL);
         $pricing->appendText($title)->appendText(PHP_EOL)->appendText($x_content)->appendText(PHP_EOL);
         $div_col->appendText($pricing);
         return $div_col;
    }

    public function createBtn($registro, $button) {
        //\Base\Model\Check::debug($button);
        foreach ($button as $value) {
            extract($value, EXTR_OVERWRITE);
            $url = $this->view->url($this->view->route, array('controller' => $this->view->controller, 'action' => $action, 'id' => $registro, 'page' => $page));
            $attr = array("class" => "btn btn-{$class} {$action}", 'id' => "{$id}-{$registro}");
            if ($type == "a") {
                $attr = array("class" => "btn btn-{$class} {$action}", 'id' => "{$id}-{$registro}", 'href' => $url,'role'=>'button');
            }
            $btns[] = $this->view->Html($type)->setAttributes($attr)->setText
            (
                $this->view->Html('i')->setClass($icone)
            )->appendText
            (
                $this->view->Html('span')->setClass("hidden-xs")->setText($this->view->translate($label))
            );
        }
        return implode("", $btns);
    }

    public function GerarElement($form) {

        foreach ($form->getElements() as $key => $element) {
            $visible = "";
            //verifica se o usuario pode ter acesso ao campo
            if ((int)$element->getAttribute('data-access')) {
                $visible = $this->view->user->role_id <= $element->getAttribute('data-access') ? "" : " disabled";
            }
            if ($element->hasAttribute('placeholder')) {
                $element->setAttribute('placeholder', $this->view->translate($element->getAttribute('placeholder')));
            }
            if (!empty($element->getLabel())) {
                self::$labels["{{{$key}}}"] = $this->view->Html("label")->setAttributes(array("class" => "field-label {$visible}", "for" => $element->getName()))->setText($this->view->translate($element->getLabel()));
            }

            // verifica se e um campo hidden [oculto]
            $blokcs = $element->getAttribute('data-position');
            if ($element->getAttribute('type') === "hidden") {
                $this->setHidden($key);
                self::$html["#{$key}#"] = $this->view->formHidden($element->setLabel(''));
            } elseif ($element->getAttribute('type') === "submit") {
                $this->setBtn($key);
                self::$html["#{$key}#"] = $this->view->formSubmit($element);
           } elseif ($element->getAttribute('type') === "radio") {
                self::$html["#{$key}#"] = $this->radio($element);
                $this->setBtn($key);

            } else {
                if ($blokcs === "geral") {
                    $this->setGeral($key, $visible);
                }
                 if ($blokcs === "images") {
                    $base_path = $this->container->get('request')->getServer('DOCUMENT_ROOT');
                    if (!is_file(sprintf("%s%sdist%s%s", $base_path, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $element->getValue()))):
                        $caminho = "no_avatar.jpg";
                    else:
                        $caminho = $element->getValue();
                    endif;
                    self::$html["#imagePreview#"] = \Base\Model\Check::Image($caminho, $element->getValue(), "420", "330", "thumbnail img-responsive preview_IMG");
                    $element->setAttribute('type', 'hidden')->setLabel("");
                    $this->setImages($key, $visible);
                }
                if ($blokcs === "galery") {
                    $this->setGalery($key, $visible);
                }
                if ($blokcs === "datas") {
                    $this->setDatas($key, $visible);
                }
                self::$html["#{$key}#"] = $this->view->formRow($element->setLabel(''));

            }
        }
        self::$html["#btn-voltar#"] =  $this->setBtnVoltar();

    }
    public function formGrupo() {
        $box = $this->view->Html("fildset")->setText(PHP_EOL)->appendText($this->view->Html("legend")->setText("FORMULARIO DE MANUTENÇÃO"))->appendText(PHP_EOL);
        if (self::$hidden):
            self::$gegal['hiddeh'] = implode("", self::$hidden);
            $boxGeral = $this->boxWidgets(array('body' => implode(PHP_EOL, self::$gegal), "title" => "CADASTRO GERAL", "class" => "box-default", 'footer' =>sprintf("%s%s",implode("", self::$btn),"#btn-voltar#"), 'icone' => 'clipboard'));
            $box->appendText($this->view->Html("div")->setClass('col-md-8 col-xs-12')->setText(PHP_EOL)->appendText($boxGeral)->appendText(PHP_EOL))->appendText(PHP_EOL);
        else:
            if(self::$gegal):
            $boxGeral = $this->boxWidgets(array('body' => implode(PHP_EOL, self::$gegal), "title" => "GERAL SEM HIDDEN", "class" => "box-default", 'footer' => implode("", self::$btn), 'icone' => 'clipboard'));
            $box->appendText($this->view->Html("div")->setClass('col-md-4 col-xs-12')->setText(PHP_EOL)->appendText($boxGeral)->appendText(PHP_EOL))->appendText(PHP_EOL);
            endif;
        endif;

        if (self::$images):
            $boxImages = $this->boxWidgets(array('body' => implode(PHP_EOL, self::$images), "title" => "CADASTRAR IMAGEM", "class" => "box-default", 'icone' => 'clipboard'));
            $box->appendText($this->view->Html("div")->setClass('col-md-4 col-xs-12')->setText(PHP_EOL)->appendText($boxImages)->appendText(PHP_EOL))->appendText(PHP_EOL);
        endif;

        if (self::$datas):
            $boxDatas = $this->boxWidgets(array('body' => implode(PHP_EOL, self::$datas), "title" => "CADASTRAR CONTRLES E DATAS", "class" => "box-default", 'icone' => 'clipboard'));
            $box->appendText($this->view->Html("div")->setClass('col-md-4 col-xs-12')->setText(PHP_EOL)->appendText($boxDatas)->appendText(PHP_EOL))->appendText(PHP_EOL);
        endif;

        return $box;
    }

    public function setGeral($key, $visible) {
      $label=$this->view->Html("div")->setAttributes(['class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'{{$key}}'])->setText(PHP_EOL)->appendText("<?php echo \$this->translate('{{{$key}}}');?>");
      $input=$this->view->Html("div")->setClass('col-md-9 col-sm-9 col-xs-12')->setText(PHP_EOL)->appendText("#{$key}#");
      self::$gegal[$key] = $this->view->Html("div")->setClass('form-group')->setText(PHP_EOL)->appendText($label)->appendText($input)->appendText(PHP_EOL);
    }

    public function setDatas($key, $visible) {


        $col=$this->view->Html("div")->setClass("col-md-11 xdisplay_inputx form-group has-feedback");
        $addon = $this->view->Html("span")->setClass("fa fa-calendar-o form-control-feedback right");
        //$col->setText(PHP_EOL)->appendText("#{$key}#")->appendText($addon);
        $label=$this->view->Html("div")->setAttributes(['class'=>'control-label col-md-4 col-sm-4 col-xs-12','for'=>'{{$key}}'])->setText(PHP_EOL)->appendText("<?php echo \$this->translate('{{{$key}}}');?>");
        $input=$this->view->Html("div")->setClass('col-md-8 xdisplay_inputx form-group has-feedback')->setText(PHP_EOL)->appendText("#{$key}#")->appendText($addon);
        self::$datas[$key] = $this->view->Html("div")->setClass('form-group')->setText(PHP_EOL)->appendText($label)->appendText($input)->appendText(PHP_EOL);
    }

    public function radio($element){

        foreach($element->getValueOptions() as $key=> $options){
            $icone=$element->getAttribute('icones');
            $attr=$element->getAttributes();
            $attr['title']=$options;
            $attr['value']=$key;
            $ctive=$key==$element->getValue()?"active":"";
            if(isset($attr['icones'])){
                unset($attr['icones']);
                $options=$this->view->Html("span")->setClass($icone[$key]);
            }
            if(isset($attr['data-tpl'])){
                $tpl=$attr['data-tpl'];
                $attr['data-tpl']=$tpl[$key];
            }
            $input=$this->view->Html("input")->setAttributes($attr);
            $label[]=$this->view->Html("label")->setAttributes(['class'=>"btn btn-default {$ctive}",'title'=>$attr['title']])->setText(PHP_EOL)->appendText($input)->appendText($options);
        }
       return implode('',$label);

    }

    public function setHidden($key) {
        self::$hidden[$key] = "#{$key}#";
    }

    /* CRIA A BOX DE IMAGES */

    public function setImages($key, $visible) {
        $iFaparpeClicp = $this->view->Html('i')->setClass('ion ion-android-upload');
        $attachment = $this->view->Html('input')->setAttributes(array('name' => 'attachment', 'type' => 'file', 'id' => 'attachment'));
        // $imagenHidden = $this->view->formRow($element->setLabel('')->setAttributes(array('type' => 'hidden')));
        $divbtnPrimary = $this->view->Html('div')->setClass('btn btn-primary btn-file');
        $span = $this->view->Html('span')->setClass('file-text')->appendText("Selecione uma imagem");
        $divbtnPrimary->setText($iFaparpeClicp)->appendText($span);
        $divbtnPrimary->appendText($attachment)->appendText("#{$key}#");
        $divInputGroup = $this->view->Html('div')->setClass("input-group class-file{$visible}");
        $divInputGroup->setText($divbtnPrimary)->appendText($this->view->Html('p')->setText($this->view->translate("Max. 32MB"))->setClass('help-block'));
        self::$images[] = $this->view->Html('div')->setattributes(array('class' => "img-add "))->setText("<?php echo \$this->translate('{{{$key}}}');?>")->appendText("#imagePreview#");
        self::$images[] = $this->view->Html("div")->setClass('row')->setText(PHP_EOL)->appendText($divInputGroup)->appendText(PHP_EOL)->appendText($this->view->Html("div")->setClass('clear'))->appendText(PHP_EOL);
    }

    public function boxWidgets($options = array('body' => "", 'title' => "GEARL", 'class' => "box-green", 'icone' => 'clipboard')) {
        extract($options);
        $box_footer = "";
        $box = $this->view->Html('div')->setClass("x_panel");
        $box_header = $this->view->Html('fieldset')->setText(PHP_EOL);

        $ionIonBag = $this->view->Html("small")->setText($title);
        $clear = $this->view->Html("div")->setClass("clearfix");
        $box_title = $this->view->Html('legend')->setText($ionIonBag);
        //$box_title = $this->view->Html('legend')->setClass("x_title")->setText($ionIonBag);
        $box_header->appendText($box_title)->appendText(PHP_EOL)->appendText($clear);

        $box_body = $this->view->Html('div')->setClass("x_content")->setText(PHP_EOL)->appendText($body)->appendText(PHP_EOL);
        $box_header->appendText(PHP_EOL)->appendText($box_body)->appendText(PHP_EOL);
        if (isset($footer)) {
            $pull_right = $this->view->Html('div')->setClass("pull-right")->setText(PHP_EOL)->appendText($footer)->appendText(PHP_EOL);
            $box_footer = $this->view->Html('div')->setClass("box-footer")->setText(PHP_EOL)->appendText($pull_right)->appendText(PHP_EOL);
        }
        $box->setText(PHP_EOL)->appendText($box_header)->appendText(PHP_EOL)->appendText($box_footer)->appendText(PHP_EOL);
        return $box;
    }

    public function setBtnVoltar() {
        $linha = "<a class=\"btn btn-danger\" href=\"%s\">{$this->view->translate('BTN_VOLTAR_LABEL')}</a><p>";
        $btnVoltar = sprintf($linha, $this->view->url("{$this->view->route}/list", array('controller' => $this->view->controller, 'action' => "index",'id'=>'0','page'=>$this->view->page)));
        return $btnVoltar;
    }

    public function filterForm()
    {
        $html=[];
        $form=$this->container->get(BuscaForm::class);
       if($this->view->filtro){
            $form->setData($this->view->filtro);
        }

        $form->setAttribute('action', $this->view->url($this->view->route));
        $form->setAttribute('class', 'form-geral  form-inline');
        $this->view->formElementErrors()
            ->setMessageOpenFormat('<ul class="nav"><li class="erro-obrigatorio">')
            ->setMessageSeparatorString('</li>')->render($form);
        $html[]=$this->view->form()->openTag($form);

        $html[]= $this->view->Html('div')->setClass("input-group")->setText(PHP_EOL)->appendText($this->view->formElement($form->get('state')))->appendText(PHP_EOL);
        //$html[]= $this->view->Html('div')->setClass("input-group")->setText(PHP_EOL)->appendText($this->view->formElement($form->get('created')))->appendText(PHP_EOL);

        $span=$this->view->Html('span')->setClass("input-group-btn")->setText($this->view->formElement($form->get('submit')));

        $html[]= $this->view->Html('div')->setClass("input-group")->setText(PHP_EOL)->appendText($this->view->formElement($form->get('busca')))->appendText($span);
        $html[]=$this->view->form()->closeTag();
        return implode(PHP_EOL,$html);

    }

    public function modal($title,$id,$body){
        $modal=$this->view->Html('div')->setAttributes(["class"=>"modal fade","id"=>$id]);
        $modaldialog=$this->view->Html('div')->setAttributes(["class"=>"modal-dialog"]);
        $modalcontent=$this->view->Html('div')->setAttributes(["class"=>"modal-content"]);
        $modalheader=$this->view->Html('div')->setAttributes(["class"=>"modal-header"]);
        $close=$this->view->Html('button')->setAttributes(["class"=>"close","data-dismiss"=>"modal","aria-hidden"=>"true"])->setText('&times;');
        $modaltitle=$this->view->Html('h4')->setAttributes(["class"=>"modal-title"])->setText($title);
        $modalbody=$this->view->Html('div')->setAttributes(["class"=>"modal-body"]);
        $modalfooter=$this->view->Html('div')->setAttributes(["class"=>"modal-footer"]);
        $btndefault=$this->view->Html('button')->setAttributes(["class"=>"btn btn-default","type"=>"button","data-dismiss"=>"modal"])->setText("FECHAR");
        $btnprimary=$this->view->Html('button')->setAttributes(["class"=>"btn btn-primary","type"=>"button"])->setText("CONFIRMAR");

        $modalheader->setText(PHP_EOL)->appendText($close)->appendText(PHP_EOL)->appendText($modaltitle);

        $modalbody->setText(PHP_EOL)->appendText($body);

        $modalfooter->setText(PHP_EOL)->appendText($btndefault)->appendText(PHP_EOL)->appendText($btnprimary);

        $modalcontent->setText(PHP_EOL)->appendText($modalheader)->appendText(PHP_EOL)
            ->appendText(PHP_EOL)->appendText($modalbody)->appendText(PHP_EOL)->appendText($modalfooter);

        $modaldialog->setText(PHP_EOL)->appendText($modalcontent);
        $modal->setText(PHP_EOL)->appendText($modaldialog);
        return $modal;

    }

    public function setBtn($key) {
        self::$btn[$key] = "#{$key}#";
    }

    /**
     * @return mixed
     */
    public function getHtml()
    {
        return self::$html;
    }

    /**
     * @return mixed
     */
    public function getLabels()
    {
        return self::$labels;
    }

}