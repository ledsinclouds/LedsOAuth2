<?php
namespace LedsOAuth2\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oauth_user")
 * @ORM\Entity
*/
class OAuth2User{

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
   	protected $id;

	/**
	 * @Orm\Column(type="string")
	 */
	protected $email;

	/**
	 * @Orm\Column(type="string")
	 */
	protected $password;

	/**
	 * @Orm\Column(type="string")
	 */
	protected $role = 'member';

	/**
	 * @Orm\Column(type="string", nullable=true)
	 */
	protected $displayname;

	/**
	 * @Orm\Column(type="string", nullable=true)
	 */
	protected $firstname;

	/**
	 * @Orm\Column(type="string", nullable=true)
	 */
	protected $lastname;

	public function getId(){
		return $this->id;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getRole(){
		return $this->role;
	}

	public function setRole($role){
		$this->role = $role;
	}

	public function getDisplayname(){
		return $this->displayname;
	}

	public function setDisplayname($displayname){
		$this->displayname = $displayname;
	}

	public function getFirstname(){
		return $this->firstname;
	}

	public function setFirstname($firstname){
		$this->firstname = $firstname;
	}

	public function getLastname(){
		return $this->lastname;
	}

	public function setLastname($lastname){
		$this->lastname = $lastname;
	}

}
