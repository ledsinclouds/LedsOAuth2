<?php
namespace LedsOAuth2\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ClientsService implements ServiceLocatorAwareInterface{

	protected $sm;
	protected $provider = '';	

	public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
		$this->sm = $serviceLocator;
	}

	public function getServiceLocator(){
		return $this->sm;
	}

	public function getClients(){
		$clients = $this->getServiceLocator()->get('clients');
		return $clients;
	}
	
	public function setProvider($provider){
		$this->provider = $provider;
	}

	public function getProvider($provider){
		$client = $this->getServiceLocator()->get($provider);
		return $client;
	}	

}
