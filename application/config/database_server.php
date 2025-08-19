<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn' => '',
    //'hostname' => '127.0.0.1',
    //'username' => 'root',
    //'password' => 'root',
	
	'hostname' => '192.168.0.1',
    'username' => 'teguh',
    'password' => 'teguhs12345',
	
    'database' => 'ptmsa_dbo',
    //'port' => 3303,    
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

$db['db_login_tpp'] = array(
    'dsn' => '',
	
	'hostname' => '192.168.0.1',
    'username' => 'teguh',
    'password' => 'teguhs12345',
	
    //'hostname' => '127.0.0.1',
    //'username' => 'root',
    //'password' => 'root',
    'database' => 'db_login_tpp',
    //'port' => 3303,   
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

$db['db_ptmsagate'] = array(
    'dsn' => '',
    'hostname' => '192.168.0.1',
    'username' => 'teguh',
    'password' => 'teguhs12345',
    //'port'     => $host_port ,
    'database' => 'ptmsa_gate',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
$db['db_acct_msa'] = array(
    'dsn' => '',
    'hostname' => '192.168.0.1',
    'username' => 'teguh',
    'password' => 'teguhs12345',
    'database' => 'ptmsa_acct',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);