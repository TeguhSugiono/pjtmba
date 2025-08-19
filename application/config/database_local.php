<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$ipaddress = '127.0.0.1' ;
$portaddress = '3308' ;

$db['default'] = array(
    'dsn' => '',
    'hostname' => $ipaddress,
    'port'     => $portaddress ,
    'username' => 'teguh',
    'password' => 'teguh',
    'database' => 'ptmsa_dbo',    
    
//    'hostname' => '202.158.62.10',
//    'username' => 'tpp',
//    'password' => '12345678',
//    'database' => 'ptmsa_dbo',
//    'port' => 6033,
//    'hostname' => '192.168.10.15',
//    'username' => 'tpp',
//    'password' => '12345678',
//    'database' => 'ptmsa_dbo',
    
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
    'username' => 'teguh',
    'password' => 'teguh',
    'database' => 'db_login_tpp',
    
//    'hostname' => '202.158.62.10',
//    'username' => 'tpp',
//    'password' => '12345678',
//    'database' => 'db_login_tpp',
//    'port' => 6033,

//    'hostname' => '192.168.10.15',
//    'username' => 'tpp',
//    'password' => '12345678',
//    'database' => 'db_login_tpp',
    
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
    'username' => 'teguh',
    'password' => 'teguh',
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
    'hostname' => $ipaddress,
    'port'     => $portaddress ,
    'username' => 'teguh',
    'password' => 'teguh',
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

