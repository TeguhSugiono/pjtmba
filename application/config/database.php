<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$ipaddress = '127.0.0.1' ;
$portaddress = '3306' ;
$usernya = "teguh" ;
$passnya = "teguh" ;

$db['default'] = array(
    'dsn' => '',
    'hostname' => $ipaddress,
    'port'     => $portaddress ,
    'username' => $usernya,
    'password' => $passnya,
    'database' => 'db_pjt',    
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
    'hostname' => $ipaddress,
    'port'     => $portaddress ,
    'username' => $usernya,
    'password' => $passnya,
    'database' => 'db_login_tpp',
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
    'hostname' => $ipaddress,
    'port'     => $portaddress ,
    'username' => $usernya,
    'password' => $passnya,
    'database' => 'db_pjt',
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
    'hostname' => $ipaddress,
    'port'     => $portaddress ,
    'username' => $usernya,
    'password' => $passnya,
    'database' => 'db_pjt',
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

$db['db_pjt'] = array(
    'dsn' => '',
    'hostname' => $ipaddress,
    'port'     => $portaddress ,
    'username' => $usernya,
    'password' => $passnya,
    'database' => 'db_pjt',
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

