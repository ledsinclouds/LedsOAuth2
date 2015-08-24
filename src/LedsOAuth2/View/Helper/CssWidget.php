<?php
namespace LedsOAuth2\View\Helper;

use Zend\View\Helper\AbstractHtmlElement;
use Zend\Session\Container;

class CssWidget extends AbstractHtmlElement{

    protected $config;
    protected $options = array(
        'image_attributes' => array(),
        'link_attributes' => array(),
        'mail_attributes' => array(),
    );

	public function __construct($config){
		$this->config = $config;
	}

    public function __invoke($options = array()){
        $this->options = array_merge_recursive($this->options, $options);
		return $this;
	}

	public function openTag(){
        $this->getView()->headLink()
            ->appendStylesheet($this->getView()->basePath('/css/cssBox.css'));

        $array = array();
        foreach($this->config as $names) $array[] = $names;
		return '<div class="' . $array[0] . '">
					<div class="' . $array[1] . '">
						<div class="' . $array[2] . '">
							<div class="' . $array[3] . '">'. PHP_EOL;
	}

	public function getBox(){
		$container = new Container('auth');
		$markup = '';
		$array = array();

		if(isset($_SESSION['auth'])){

			$imageLink = $_SESSION['auth']['imageUrl'];
			$providerName = $_SESSION['auth']['provider'];
			$name = $_SESSION['auth']['name'];
			$link = $_SESSION['auth']['urls'];
			$email = $_SESSION['auth']['email'];

			$link_attributes = $this->options['link_attributes'];
			$link_attributes['href'] = $link;

			$imageAttribs['src'] = $imageLink;
			$imageAttribs['alt'] = $name . ' image';

			$imageAttribs = array_merge($imageAttribs, $this->options['image_attributes']);

			$format = '<p><img id="imageUrl"%s></p>';
			$format .= '<h3>Logged In as: <span id="name-account">' . $name . '</span></h3>';
			$format .= '<h4>Email: <span id="mail-account">' . $email . '</span></h4>';
			$formatLink = '<p>Link To My: <a id="link-provider"%s>' . ucfirst($_SESSION['auth']['provider']) . ' Account</a></p>';
			$logout = '<hr><p><a class="btn btn-default" href="/oauth/handle"><span id="btn-text">Logout</span></a></p>';

			$args = array(
				$this->htmlAttribs($imageAttribs)
			);

			if(!empty($link_attributes['href'])){
				$format = $format . $formatLink . $logout;
				$args[] = $this->htmlAttribs($link_attributes);
			}else{
				$format = $format . $logout;
			}

			$markup .= vsprintf($format, $args) . PHP_EOL;
				//echo '<pre>';
				//print_r($_SESSION['auth']);
				//echo '</pre>';
		}else{
			$message = 'There is no Session';
			$markup .= sprintf("<p>%s</p>", $message) . PHP_EOL;

		}
		return $markup;
	}

    public function closeTag(){
        return '</div></div></div></div>';
    }

    public function __toString(){
        return $this->openTag() . $this->getBox() . $this->closeTag();
    }
}
