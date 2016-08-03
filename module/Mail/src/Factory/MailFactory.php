<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 13/07/2016
 * Time: 09:38
 */

namespace Mail\Factory;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Mail\Options\MailOptions;
use Mail\Service\Mail;
use Mail\Service\Template;
use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class MailFactory implements FactoryInterface {

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $transport = $this->mail_transport($container);
        $template = $this->mail_template($container);
        $options = $this->mail_options($container);
        return new Mail($transport, $options, $template);

    }

    protected function  mail_transport($container)
    {
        $config = $container->get('config');
        if (isset($config['Mail']['transport']['smtpOptions'])) {
            $valuesOptions = $config['Mail']['transport']['smtpOptions'];
            $transportSslOptions = $config['Mail']['transport']['transportSsl'];
            if ($transportSslOptions['use_ssl'])
                $valuesOptions['connection_config']['ssl'] = $transportSslOptions['connection_type'];
            $smtpOptions = new SmtpOptions($valuesOptions);
            $transport = new Smtp($smtpOptions);
            return $transport;
        } else {
            throw new \Exception('Você precisa configurar o STMP Options no module.config.php');
        }
    }

    protected function mail_template($container)
    {
        return new Template($container);
    }

    protected function mail_options($container)
    {
        $config = $container->get('config');
        if (isset($config['Mail']['options'])) {
            $valueOptions = $config['Mail']['options'];
            return new MailOptions($valueOptions);
        } else {
            throw new Exception('Erro ao carregar o arquivo de configuração com as opções');
        }
    }
}