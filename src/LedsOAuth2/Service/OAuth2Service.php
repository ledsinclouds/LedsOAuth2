<?php
namespace LedsOAuth2\Service;

use Zend\Crypt\Password\Bcrypt;
use Zend\Authentication\AuthenticationService;
use Doctrine\ORM\EntityManager;
use LedsOAuth2\Entity\OAuth2User;

class OAuth2Service{

	protected $em;
	protected $authenticatioService;
	protected $user_role;

	public function __construct(EntityManager $em, AuthenticationService $authenticatioService){
		$this->em = $em;
		$this->AuthenticationService = $authenticatioService;
	}

	public function oauthAuthenticate($email, $password){
		$adapter = $this->authenticationService->getAdapter();
		$adapter->setIdentityValue($email);
		$adapter->setCredentialValue($password);
		$authResult = $this->authenticationService->authenticate();
		return $authResult->isValid();
	}

	public function hasIdentity(){
		$this->authenticationService->hasIdentity();
	}

	public function logout(){
		$this->authenticationService->clearIdentity();
	}

	public static function OAuth2Verify(OAuth2User $user, $passwordGiven){
		$bcrypt = new Bcrypt();
		return $bcrypt->verify($passwordGiven, $user->getPassword());
	}

}
