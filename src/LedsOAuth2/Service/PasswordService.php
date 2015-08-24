<?php
namespace LedsOAuth2\Service;

use Zend\Crypt\Password\Bcrypt;

class PasswordService{

	protected $password = 'test';

	public function getPassword(){
		$crypt = new Bcrypt();
		return $crypt->create($this->password);
	}

}
