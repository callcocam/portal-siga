<?php

namespace Base\Files;

use Zend\Debug\Debug;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Filter\Exception\InvalidArgumentException;

/**
 * Class FilesService
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class FilesService implements FilesServiceInterface, InputFilterAwareInterface {

    /**
     * @var FilesOptions
     */
    protected $options;
    protected $messages;
    protected $data;
    protected $result;
    protected $temp = "";
    protected $realFolder;

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    public function __construct(FilesOptions $options, InputFilter $inputFilter = null) {

        $this->options = $options;
        $this->inputFilter = $inputFilter;
        $this->result = TRUE;
    }

    /**
     * @param \SplFileInfo $file
     * @return bool
     */
    public function isFileHidden(\SplFileInfo $file) {
        $basename = $file->getBasename();
        return strpos($basename, '.') === 0;
    }

    public function getInputFilter() {
        if (!isset($this->inputFilter)) {
            $this->setInputFilter(new FilesInputFilter($this->options));
        }
        return $this->inputFilter;
    }

    public function persistFile(array $file, array $data = array()) {
        $this->options->setMimetype($this->options->getImageAccept());
        $type = "images";
        $file['name'] = $this->options->setFileName($file['name']);
        $this->options->CheckFolder($type);
        $filter = clone $this->getInputFilter();
        $filter->setData([FilesInputFilter::FILE => $file]);
        try {
            if (!$filter->isValid()) {
                $msg = "";
                if (is_array($filter->getMessages())):
                    foreach ($filter->getMessages() as $key => $value) {
                        $msg.=implode(PHP_EOL, $value);
                    }
                else:
                    $msg = $filter->getMessages();
                endif;
                $this->setMessages($msg);
                $this->result = FALSE;
                return self::CODE_ERROR;
            }
            $filter->getValues();
        } catch (InvalidArgumentException $e) {
            $this->temp = \Base\Model\Check::ImageCaminho(sprintf("%s%s", $this->options->getSend(), $file['name']));
            $this->realFolder = sprintf("%s%s", $this->options->getSend(), $file['name']);
            $this->setMessages($e->getMessage());
            $this->result = TRUE;
            return self::CODE_ERROR;
        }
        $this->temp = \Base\Model\Check::ImageCaminho(sprintf("%s%s", $this->options->getSend(), $file['name']));
        $this->realFolder = sprintf("%s%s", $this->options->getSend(), $file['name']);
        $this->setMessages("MIDIA {$this->realFolder} ENVIADO COM  SUCESSO!");
        return self::CODE_SUCCESS;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        $this->inputFilter = $inputFilter;
        return $this;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    public function getResult() {
        return $this->result;
    }

    public function getMessages() {
        return $this->messages;
    }

    public function setMessages($mgs) {
        $this->messages = $mgs;
        return $this;
    }

    public function getOptions() {
        return $this->options;
    }

    public function getTemp() {
        return $this->temp;
    }

    public function getRealFolder() {
        return $this->realFolder;
    }

    public function getFiles() {
        
    }

    public function persistFiles(array $files) {
        
    }

}
