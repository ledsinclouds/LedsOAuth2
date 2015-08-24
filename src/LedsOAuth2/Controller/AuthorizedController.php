<?php

namespace LedsOAuth2\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use Auth\Entity\AuthUser;
use Zend\Session\Container;

class AuthorizedController extends AbstractActionController{

    public function indexAction(){
		$provider = $this->getSession();

		if(isset($_SESSION['auth']['email'])){
			$email = $_SESSION['auth']['email'];
			//$token = $_SESSION['auth']['accessToken'];
			$urls = $_SESSION['auth']['urls'];		
			$imageUrl = $_SESSION['auth']['imageUrl'];
			
			$location = $_SESSION['auth']['location'];
			$name = $_SESSION['auth']['name'];			
							
			return new ViewModel(array(
				'email' => $email,
				'imageUrl' => $imageUrl,
				'urls' => $urls,
				
				'location' => $location,
				'name' => $name,
				//'urls' => $urls				
			));
			
		}else{
			$this->clearSession();
			$this->redirect()->toRoute('oauth');
		}
    }

}

