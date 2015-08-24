<?php
namespace LedsOAuth2\Service;

use Zend\ServiceManager\AbstractFactoryInterface;

class ClientsAbstractService implements AbstractFactoryInterface{

	public function canCreateServiceWithName(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $name, $requestedName){
		$config = $serviceLocator->get('Config');
		return isset($config['social_auth'][$requestedName]) ? true : false;
	}

	public function createServiceWithName(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $name, $requestedName){
		$config = $serviceLocator->get('Config');
		return $config['social_auth'][$requestedName];
	}

}
