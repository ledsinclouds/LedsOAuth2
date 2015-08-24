<?php
namespace LedsOAuth2\View\Helper;

use LedsOAuth2\View\Helper\CssWidget;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CssViewFactory implements FactoryInterface{

	public function createService(ServiceLocatorInterface $serviceLocator){
		$cssService = $serviceLocator->getServiceLocator()->get('cssService');
		$helper = new CssWidget($cssService);
		return $helper;
	}

}  
