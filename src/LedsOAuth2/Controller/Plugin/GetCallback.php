<?php
namespace LedsOAuth2\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class getCallback extends AbstractPlugin{

	public function __invoke(){
		$router = $this->getController()->getEvent()->getRouter();
		$redirect = $router->assemble(array(), array(
			'name' => 'oauth', 'force_canonical' => true
		));
		$handle = $redirect . '/handle';
		return $handle;
	}

}
