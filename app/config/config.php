<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'test',
        'password'    => 'test123',
        'dbname'      => 'test',
        'charset'     => 'utf8',
    ),
    'application' => array(
        'controllersDir' => APP_PATH . '/app/controllers/',
        'modelsDir'      => APP_PATH . '/app/models/',
        'migrationsDir'  => APP_PATH . '/app/migrations/',
        'viewsDir'       => APP_PATH . '/app/views/',
        'pluginsDir'     => APP_PATH . '/app/plugins/',
        'libraryDir'     => APP_PATH . '/app/library/',
        'cacheDir'       => APP_PATH . '/app/cache/',
        'baseUri'        => '/',
    ),
	'table_1' => array(
		'db_tablename'	=> 'customers',
		'primary_column'=> 'customers.id',
		'align_center'	=> '[1,6]',
		'align_right'	=> '[0,5]',
		'columns'		=> array(
			array('id'=>0, 'label'=>'ID',			'db_field'=>'customers.id',			'align'=>'center'),
			array('id'=>1, 'label'=>'Username',		'db_field'=>'customers.username',	'align'=>'center'),
			array('id'=>2, 'label'=>'First name',	'db_field'=>'customers.first_name',	'align'=>'center'),
			array('id'=>3, 'label'=>'Second name',	'db_field'=>'customers.second_name','align'=>'center'),
			array('id'=>4, 'label'=>'Email',		'db_field'=>'customers.email',		'align'=>'center'),
			array('id'=>5, 'label'=>'Credits',		'db_field'=>'customers.credits',	'align'=>'center'),
			array('id'=>6, 'label'=>'Registered',	'db_field'=>'customers.registered',	'align'=>'center'),
		),
	),
));
