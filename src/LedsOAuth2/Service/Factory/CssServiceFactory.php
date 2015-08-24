<?php
namespace LedsOAuth2\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CssServiceFactory implements FactoryInterface{

	public function createService(ServiceLocatorInterface $serviceLocator){
		$classes = $serviceLocator->get('details_box');
		return $classes;
	}

} 
