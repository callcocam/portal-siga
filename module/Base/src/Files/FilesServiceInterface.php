<?php

namespace Base\Files;

/**
 * Interface FilesServiceInterface
 * @author Alejandro Celaya Alastrué
 * @link http://www.wonnova.com
 */
interface FilesServiceInterface {

      const CODE_SUCCESS = 'trigger_success';
    const CODE_ERROR = 'trigger_error';

    /**
     * @return \SplFileInfo[]
     */
    public function getFiles();

    /**
     * Envia um arquivo
     * @param array $file
     * return string
     */
    public function persistFile(array $file);

    /**
     * @param array $files
     * @return string
     */
    public function persistFiles(array $files);

    /**
     * pega os dados tratados
     */
    public function getData();

    /**
     * seta os dados
     * @param type $data
     */
    public function setData($data);
    
    /**
     * pega o result
     * return bool
     */
    public function getResult();

    /**
     * pega as menssages
     */
    public function getMessages();

    /**
     * Set as menssages
     * @param type $mgs 
     */
    public function setMessages($mgs);
}
