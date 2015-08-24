<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'LedsOAuth2\Controller\Index' => 'LedsOAuth2\Controller\IndexController',
			'LedsOAuth2\Controller\Authorized' => 'LedsOAuth2\Controller\AuthorizedController'
		)
	),
	'session' => array(
		'name' => 'auth',
		'save_path' => __DIR__ . '/../../../data/session'
	),
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                'LedsOAuth2' => __DIR__ . '/../public',
            ),
        ),
    ),
	'router' => array(
		'routes' => array(
			'oauth' => array(
				'type' => 'segment',
				'options' => array(
					'route' => '/oauth[/:action][/:id]',
					'defaults' => array(
						'controller' => 'LedsOAuth2\Controller\Index',
						'action' => 'index',
					),
					'constaints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+',
					),
				),
			),
			'authorized' => array(
				'type' => 'segment',
				'options' => array(
					'route' => '/oauth/account[/:api]',
					'defaults' => array(
						'controller' => 'LedsOAuth2\Controller\Authorized',
						'action' => 'index',
						'api' => '(coop|github|google|twitter|facebook|linkedin)',
					),
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
				),
			),
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
	'doctrine' => array(
		'driver' => array(
			'auth_user_entities' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/LedsOAuth2/Entity'),
			),
			'orm_default' => array(
				'drivers' => array(
					'LedsOAuth2\Entity' => 'auth_user_entities'
				)
			)
		),
		'authentication' => array(
			'orm_default' => array(
				'object_manager' => 'Doctrine\ORM\EntityManager',
				'identity_class' => 'LedsOAuth2\Entity\OAuth2User',
				'identity_property' => 'email',
				'credential_property' => 'password',
				'credential_callable' => function(\LedsOAuth2\Entity\OAuth2User $user, $passwordGiven){
					return \LedsOAuth2\Service\OAuth2Service::Oauth2Verify($user, 'test');
				}
			)
		)
	)
);
