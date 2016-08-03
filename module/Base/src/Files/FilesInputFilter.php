<?php

namespace Base\Files;

use Zend\Filter\File\RenameUpload;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\Validator\File\Size;
use Zend\Validator\File\MimeType;

/**
 * Class FilesInputFilter
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class FilesInputFilter extends InputFilter {

    const FILE = 'file';

    public function __construct(FilesOptions $options) {

        $input = new FileInput(self::FILE);
        $input->getValidatorChain()->attach(new Size(['max' => $options->getMaxSize(), 'messageTemplates' => [
                Size::TOO_BIG => 'O arquivo fornecido é maior que o tamanho de arquivo permitido',
                Size::TOO_SMALL => 'O arquivo fornecido é muito pequeno',
                Size::NOT_FOUND => 'O arquivo não pode ser encontrado']]));

        $mimetype = new MimeType();
        $mimetype->setMessages(array(
            MimeType::FALSE_TYPE => 'Este arquivo não é um tipo permitido',
            MimeType::NOT_DETECTED => 'O tipo de arquivo não foi detectado',
            MimeType::NOT_READABLE => 'O tipo de arquivo não era legível',
        ));
        $mimetype->setMimeType($options->getMimetype());
        $input->getValidatorChain()->attach($mimetype);
        $renameUpload = new RenameUpload([
            'overwrite' => false,
            'use_upload_name' => true,
            //'use_upload_extension' => true,
            //'randomize'=>true,
            'target' => $options->getBasePath()
        ]);
        $input->getFilterChain()->attach($renameUpload);
        $this->add($input);
    }

}
