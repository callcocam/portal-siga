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

class Authorization {

    /**
     * @var ContainerInterface
     */
    private $containerInterface;

    /**
     * @param ContainerInterface $containerInterface
     */
    public function __construct(ContainerInterface $containerInterface){

        $this->containerInterface = $containerInterface;

    }

    public function setAuthorizationFb()
    {
        $result=[];
        $session=$this->containerInterface->get(FbStorage::class);
        $config = $this->containerInterface->get('config');
        $config = $config['facebook'];

        if (is_null($config))
            throw new \RuntimeException(_('Config could not be found!'));

        /**
         * @var $session FbStorage
         */

        $fb= new Facebook($config);
        $helper = $fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            $result[]= 'Graph returned an error: ' . $e->getMessage();

        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            $result[]= 'Facebook SDK returned an error: ' . $e->getMessage();
        }
        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                $result[]= "Error: " . $helper->getError() . "\n";
                $result[]= "Error Code: " . $helper->getErrorCode() . "\n";
                $result[]= "Error Reason: " . $helper->getErrorReason() . "\n";
                $result[]= "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                $result[]= 'Bad request';
            }

        }
        $result[]=$accessToken->getValue();
        // Logged in
       $session->setAccessToken($accessToken->getValue());
       return  $result;
    }
}