<?php
namespace LedsOAuth2\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoginServiceFactory implements FactoryInterface{

	public function createService(ServiceLocatorInterface $serviceLocator){
		$clients = $serviceLocator->get('clients');
		return $clients;
	}

}
