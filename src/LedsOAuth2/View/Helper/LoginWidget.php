<?php
namespace LedsOAuth2\View\Helper;

use Zend\View\Helper\AbstractHtmlElement;

class LoginWidget extends AbstractHtmlElement{

    protected $config;
    protected $options = array(
        'icons_attribs' => array(),
        'containerClass' => array(
			'class' => 'social-widget'
        )
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
		echo '<h4 style="text-align: center; text-decoration: underline">Login with your social Account</h4>';
		$attributes = $this->htmlAttribs($this->options['containerClass']);
        return sprintf('<div%s><p>', $attributes) . PHP_EOL;
	}

	public function  getIcons(){

		$markup = '';
		foreach($this->config as $names => $keys){

			$attribs['href'] = 'oauth/redirect?provider=' . $names;
			//$attribs['class'] = 'socicon socicon-' . $names;
			$attribs = array_merge($attribs, $this->options['icons_attribs']);

				//$format = '<a%s>' . $names . '</a>';
				$format = '<a%s><span class="socicon socicon-' . $names . '"></span></a>';
				$args = array(
					$this->htmlAttribs($attribs)
				);
				$markup .= vsprintf($format, $args) . PHP_EOL;

		}
		return $markup;
	}

    public function closeTag(){
        return '</p></div>';
    }

    public function __toString(){
        return $this->openTag() . $this->getIcons() . $this->closeTag();
    }
}
