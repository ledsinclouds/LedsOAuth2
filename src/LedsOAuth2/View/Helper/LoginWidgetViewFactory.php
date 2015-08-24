<?php
namespace LedsOAuth2\View\Helper;

use LedsOAuth2\View\Helper\LoginWidget;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoginWidgetViewFactory implements FactoryInterface{

	public function createService(ServiceLocatorInterface $serviceLocator){
		$loginService = $serviceLocator->getServiceLocator()->get('loginService');
		$helper = new LoginWidget($loginService);
		return $helper;
	}

} 
