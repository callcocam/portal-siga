<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/08/2016
 * Time: 11:43
 */

namespace Facebook\Storage;


use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Interop\Container\ContainerInterface;
use Zend\Debug\Debug;

class Authentication {

    /**
     * @var $containerInterface
     */
    private $containerInterface;

    /**
     * @param ContainerInterface $containerInterface
     */
    public function __construct(ContainerInterface $containerInterface){

        $this->containerInterface = $containerInterface;
    }

    public function setAuthenticationFb()
    {
        $config = $this->containerInterface->get('config');
        $config = $config['facebook'];
        if (is_null($config))
            throw new \RuntimeException(_('Config could not be found!'));
        $this->containerInterface->get(FbStorage::class);
        return new Facebook($config);
    }

    public function publicalink($data)
    {
        $result=[];
        /**
         * @var $session FbStorage
         */
        $session=$this->containerInterface->get(FbStorage::class);
        $config = $this->containerInterface->get('config');
        $config = $config['facebook'];
        if (is_null($config))
            throw new \RuntimeException(_('Config could not be found!'));

        $fb= new Facebook($config);
         $linkData = [
            'link' => $data['link'],
            'message' => $data['message'],
        ];
        $result[]=$session->getAccessToken();
        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->post('/me/feed', $linkData,$session->getAccessToken());
            $result[]=$response;
        } catch(FacebookResponseException $e) {
            $result[]='Graph returned an error: ' . $e->getMessage();

        } catch(FacebookSDKException $e) {
            $result[]='Facebook SDK returned an error: ' . $e->getMessage();

        }
        return $result;


    }
    public function getUser()
    {
        $result=[];
        /**
         * @var $session FbStorage
         */
        $session=$this->containerInterface->get(FbStorage::class);
        $config = $this->containerInterface->get('config');
        $config = $config['facebook'];
        if (is_null($config))
            throw new \RuntimeException(_('Config could not be found!'));
        $fb= new Facebook($config);
        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->get('/me?fields=id,name,first_name,last_name,email', $session->getAccessToken());
        } catch(FacebookResponseException $e) {
            $result[]= 'Graph returned an error: ' . $e->getMessage();

        } catch(FacebookSDKException $e) {
            $result[]= 'Facebook SDK returned an error: ' . $e->getMessage();

        }

        $result[]= $response->getGraphUser();
        $result[]= $response;
        return $result;

    }
} 