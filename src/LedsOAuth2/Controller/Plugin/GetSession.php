<?php
namespace LedsOAuth2\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Session\Container;

class GetSession extends AbstractPlugin {

	public function __invoke(){
		$container = new Container('auth');
		$provider = $_SESSION['auth']['provider'];
		return $provider;
	}

}
