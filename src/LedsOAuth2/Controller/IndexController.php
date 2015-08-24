<?php

namespace LedsOAuth2\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Guzzle\Http\Client;
use Zend\Session\Container;
//use League\OAuth2\Client\Provider;

class IndexController extends AbstractActionController{

    public function indexAction(){
		$params = $this->getRequest()->getQuery();
		if(!empty($params['provider'])){
			$provider = $params['provider'];
			return $this->redirect()->toRoute('oauth', array(
				'action' => 'redirect'
			), array(
				'query' => array('provider' => $provider)
			));
		}
		$clients = $this->getServiceLocator()->get('clients');
//		echo '<pre>';
//		print_r($clients);
//		echo '</pre>';
		return new ViewModel(array(
			'clients' => $clients,
		));
	}

	public function redirectAction(){
		$params = $this->getRequest()->getQuery();
		$provider = $params['provider'];

//$this->getSession();
		$clients = $this->getServicelocator()->get('clients_service');
		$clientService = $clients->getProvider($provider);

		$clientClass = '\\League\\OAuth2\\Client\\Provider\\' . ucfirst($provider);
		$handle = $this->getCallback();
//var_dump($handle);die;
		$client = new $clientClass(array(
			'clientId' => $clientService['client_id'],
			'clientSecret' => $clientService['client_secret'],
			'redirectUri' => $handle,
			'scope' => $clientService['scope']
		));
		//echo '<pre>';
		//print_r($client);
		//echo '</pre>';
		//die;
		if(!isset($params['code'])){
			header('Location: ' . $client->getAuthorizationUrl());
			$container = new Container('auth');
			$container->provider = $provider;
			exit;
		}
	}

	public function handleAction(){
		$provider = $this->getSession();
		$clients = $this->getServiceLocator()->get('clients_service');
		$client = $clients->getProvider($provider);

		$base_url = $client['base_url'];
		$handle = $this->getCallback();

		$providerClass = $_SESSION['auth']['provider'];
		$clientClass = '\\League\\OAuth2\\Client\\Provider\\' . ucfirst($providerClass);

		if($this->getRequest()->getQuery('code')){
			$client = new $clientClass(array(
				'clientId' => $client['client_id'],
				'clientSecret' => $client['client_secret'],
				'redirectUri' => $handle,
				'scope' => $client['scope']
			));
			$token = $client->getAccessToken('authorization_code', [
				'code' => $this->getRequest()->getQuery('code')
			]);
			$userDetails = $client->getUserDetails($token);

			$container = new Container('auth');
			$container->email = $userDetails->email;
			$container->accessToken = $token->accessToken;
			$container->urls = $userDetails->urls;
			$container->imageUrl = $userDetails->imageUrl;
			$container->location = $userDetails->location;
			$container->name = $userDetails->name;

			$this->authentication();
		}else{
			$this->destroyAuth();
		}
	}

	public function authentication(){
		$provider = $this->getSession();
		$container = new Container('auth');
		$password = $this->getServiceLocator()->get('password')->getPassword();

		$em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		$user = new \LedsOAuth2\Entity\OAuth2User();

		$validator = new \DoctrineModule\Validator\ObjectExists(array(
			'object_repository' => $em->getRepository('LedsOAuth2\Entity\OAuth2User'),
			'fields' => 'email'
		));
		if($validator->isValid($_SESSION['auth']['email'])){
			echo "Sorry field already exists";
			return $this->redirect()->toRoute('home');
		}

		$user->setEmail($_SESSION['auth']['email']);
		$user->setPassword($password);
		$em->persist($user);
		$em->flush();

		$container->id = $user->getId();
		return $this->redirect()->toRoute('authorized', array('action' => 'index'), array('query' => array('provider' => $provider)));
	}

	public function destroyAuth(){
		$em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		$user = $em->find('LedsOAuth2\Entity\OAuth2User', $_SESSION['auth']['id']);
		$em->remove($user);
		$em->flush();
		$this->clearSession();
		return $this->redirect()->toRoute('authorized');
	}
}




























