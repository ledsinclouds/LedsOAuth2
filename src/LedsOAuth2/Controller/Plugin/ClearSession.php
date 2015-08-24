<?php
namespace LedsOAuth2\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Session\Container;

class ClearSession extends AbstractPlugin {
	
	public function __invoke(){
		$container = new Container('auth');
		$sessionManager = $container->getManager();
		$provider = $_SESSION['auth']['provider'];
		
			//$provider = $container->provider;
			//var_dump($provider);die;
			//var_dump($sessionManager->getId());die;
		return $sessionManager->getStorage()->clear();
	}
	
}
