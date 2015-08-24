<?php
namespace LedsOAuth2;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface{

	public function onBootstrap(MvcEvent $e){
		$eventManager = $e->getApplication()->getEventManager();
		$eventManager->attach('dispatch', array($this, 'loadConfiguration'));
	}

	public function loadConfiguration(MvcEvent $e){
		$application = $e->getApplication();
		$sm = $application->getServiceManager();
		$router = $sm->get('router');
		$request = $sm->get('request');
		$routeMatch = $router->match($request);
	}

	public function getServiceConfig(){
		return array(
			'abstract_factories' => array(
				'LedsOAuth2\Service\ClientDetailAbstractService',
				'LedsOAuth2\Service\ClientsAbstractService',
				'LedsOAuth2\Service\CssAbstractService', // css classes declaration 			
			),
			'factories' => array(
				'loginService' => 'LedsOAuth2\Service\Factory\LoginServiceFactory',
				'cssService' => 'LedsOAuth2\Service\Factory\CssServiceFactory',				
			),
			'invokables' => array(
				'clients_service' => 'LedsOAuth2\Service\ClientsService',				
				'password' => 'LedsOAuth2\Service\PasswordService',
			),
		);
	}

	public function getViewHelperConfig(){
		return array(
			'factories' => array(
				'oauthWidget' => 'LedsOAuth2\View\Helper\LoginWidgetViewFactory',
				'cssWidget' => 'LedsOAuth2\View\Helper\CssViewFactory',				
			),
			'invokables' => array(
				'providerDetails' => 'LedsOAuth2\View\Helper\LoginWidget',
				'providerBoxCss' => 'LedsOAuth2\View\Helper\CssWidget',				
			)
		);
	}

	public function getConfig(){
        return include __DIR__ . '/../../config/module.config.php';
	}

	public function getControllerPluginConfig(){
		return array(
			'invokables' => array(
				'getCallback' => 'LedsOAuth2\Controller\Plugin\GetCallback',
				'getSession' => 'LedsOAuth2\Controller\Plugin\GetSession',
				'clearSession' => 'LedsOAuth2\Controller\Plugin\ClearSession'
			)
		);
	}

    public function getAutoloaderConfig(){
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
