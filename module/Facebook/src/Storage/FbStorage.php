<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/08/2016
 * Time: 21:19
 */

namespace Facebook\Storage;


use Facebook\Storage\Factory\AbstractFactory;
use Interop\Container\ContainerInterface;
use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;
use Zend\Session\SessionManager;

class FbStorage extends AbstractFactory {


    /**
     * @var AbstractFactory
     */
    private $my_conatiner;

     /**
     * @var ContainerInterface
     */
    private $containerInterface;


    /**
     * @param ContainerInterface $containerInterface
     */
    function __construct(ContainerInterface $containerInterface)
    {
        $this->setContainer();
        $this->containerInterface = $containerInterface;
        $session = $this->setSession();
        $session->start();
        $this->my_conatiner=$this->getContainer();
        if (isset($this->my_conatiner->init)) {
            $request        = $this->containerInterface->get('Request');
            $session->regenerateId(true);
            $this->my_conatiner->init          = 1;
            $this->my_conatiner->remoteAddr    = $request->getServer()->get('REMOTE_ADDR');
            $this->my_conatiner->httpUserAgent = $request->getServer()->get('HTTP_USER_AGENT');
        }
    }



     /**
     * @internal param $container
     * @return SessionManager
     */
    public function setSession()
    {
        $config = $this->containerInterface->get("Config");
        if (! isset($config['session'])) {
            $sessionManager = new SessionManager();
            Container::setDefaultManager($sessionManager);
            return $sessionManager;
        }
        $session = $config['session'];
        $sessionConfig = null;
        if (isset($session['config'])) {
            $class = isset($session['config']['class'])
                ?  $session['config']['class']
                : SessionConfig::class;

            $options = isset($session['config']['options'])
                ?  $session['config']['options']
                : [];

            $sessionConfig = new $class();
            $sessionConfig->setOptions($options);
        }
        $sessionStorage = null;
        if (isset($session['storage'])) {
            $class = $session['storage'];
            $sessionStorage = new $class();
        }

        $sessionSaveHandler = null;
        if (isset($session['save_handler'])) {
            // class should be fetched from service manager
            // since it will require constructor arguments
            $sessionSaveHandler = $this->containerInterface->get($session['save_handler']);
        }

        $sessionManager = new SessionManager(
            $sessionConfig,
            $sessionStorage,
            $sessionSaveHandler
        );
        Container::setDefaultManager($sessionManager);
        return $sessionManager;

    }
}