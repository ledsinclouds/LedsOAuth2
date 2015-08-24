ZF2 OAuth2 Connect Module
=========================

Introduction
------------
This is a social login module using http://oauth2.thephpleague.com/ library and Doctine2 for database setup. 

Installation
------------

Using Composer (recommended)
----------------------------
The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies:

    curl -s https://getcomposer.org/installer | php --

You would then invoke `composer` to install dependencies. Add to your composer.json

	"ledsinclouds/leds-oauth2": "dev-master"

Configuration
-------------

Once module installed, you could declare the module into your "config/application.config.php" by adding "LedsOAuth2". 
	
        'Application',
		'AkrabatSession',	
        'DoctrineModule',
		'DoctrineORMModule',
		'AssetManager',
        'LedsOAuth2',

Copy/Paste the configuration file and change configuration options according to your social accounts.
Note: You must create applications for that...

    cp vendor/ledsinclouds/leds-oauth2/config/oaut.local.php.dist config/autoload/oauth.local.php

This module is shipped with 2 ViewHelpers - cssWidget(Account detal view when logged) & oauthWidget(Social Icons for login)

    <?php echo cssWidget() ?>
    <?php echo oauthWidget() ?>
	
Setup Session Handling
----------------------

Create a directory "session" in data directory with read/write access to your web server

    $ mkdir www/{approot}/data/session 
    $ chown -R apache:apache www/{approot}/data/session 
    $ chmod -R 0770 apache:apache www/{approot}/data/session 

	return array(
		'session' => array(
			'name' => 'auth',
			'save_path' => __DIR__ . '/../../../data/session'
		),
	);	

Database Setup
--------------
copy "doctrine.local.php.dist" to "config/autoload/doctrine.local.php"

	./vendor/bin/doctrine-module orm:validate-schema
	./vendor/bin/doctrine-module orm:schema-tool:update --force
