<?php

namespace BW\UserBundle\Service;

/**
 * Description of SocialService
 *
 * @author BrainForce 3.0
 */
class SocialService {
    
    /**
     * The Facebook instance
     * 
     * @var \Facebook
     */
    protected $facebook;
    
    /**
     * The Google Client instance
     * 
     * @var \Google_Client
     */
    protected $googleClient;
    

    public function __construct($config) {
        
        /* Facebook */
        if ($config['facebook']['is_active']) {
            $this->facebook = new \Facebook(array(
                'appId' => $config['facebook']['app_id'],
                'secret' => $config['facebook']['secret'],
            ));
        }
        
        /* Google Login */
        if ($config['google']['is_active']) {
            $this->googleClient = new \Google_Client();
            $this->googleClient->setClientId($config['google']['client_id']);
            $this->googleClient->setClientSecret($config['google']['client_secret']);
            $this->googleClient->setRedirectUri($config['google']['redirect_uri']);
            $this->googleClient->setDeveloperKey($config['google']['developer_key']);
            $this->googleClient->setScopes($config['google']['scopes']);
        }
    }
    
    
    /**
     * Get the Facebook instance
     * @return \Facebook
     */
    public function getFacebook() {
        
        return $this->facebook;
    }
    
    /**
     * Get the Google Client instance
     * @return \Google_Client
     */
    public function getGoogleClient() {
        
        return $this->googleClient;
    }
    
}
