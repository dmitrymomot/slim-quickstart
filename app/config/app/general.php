<?php

return array(
	// Application
	'mode' => 'development', // development, production

	// Debugging
	'debug' => true,

	// Logging
	'log.writer' 	=> null,
	'log.level' 	=> \Slim\Log::DEBUG,
	'log.enabled' 	=> true,

	// View
	'templates.path' 	=> APPPATH.'views',
	'view' 				=> '\Slim\Extension\View',

	// Cookies
	'cookies.encrypt' 	=> true,
	'cookies.lifetime' 	=> '20 minutes',
	'cookies.path' 		=> '/',
	'cookies.domain' 	=> null,
	'cookies.secure' 	=> true,
	'cookies.httponly' 	=> false,

	// Encryption
	'cookies.secret_key' 	=> 'CHANGE_ME',
	'cookies.cipher' 		=> MCRYPT_RIJNDAEL_256,
	'cookies.cipher_mode' 	=> MCRYPT_MODE_CBC,

	// HTTP
	'http.version' => '1.1',

	// Routing
	'routes.case_sensitive' => false
);
