<?php
namespace LedsOAuth2\Service;

use Zend\ServiceManager\AbstractFactoryInterface;

class CssAbstractService implements AbstractFactoryInterface{

	public function canCreateServiceWithName(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $name, $requestedName){
		$config = $serviceLocator->get('Config');
		return isset($config['widget'][$requestedName]) ? true : false;
	}

	public function createServiceWithName(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $name, $requestedName){
		$config = $serviceLocator->get('Config');
		return $config['widget'][$requestedName];
	}

} 
