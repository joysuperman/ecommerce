<?php

/**
 * @Author: SUPERMAN
 * @Date:   2022-09-09 20:06:19
 * @Last Modified by:   SUPERMAN
 * @Last Modified time: 2022-09-24 11:11:59
 */
session_start();

define("DB_HOST","localhost");
define("DB_NAME","joymojum_ecomm_#db");
define("DB_USER","joymojum_ecom1337");
define("DB_PASSWORD","?Vf_677#1337@oOXYY");
define("HOST_PATH","mysql");


$con = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)or die('Connection Lost...! Please try Later');
mysqli_set_charset($con,'utf8');



define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/eCommerce/');
define('SITE_PATH','https://www.joymojumder.icu/eCommerce/');

define('PRODUCT_IMG_SERVER_PATH',SERVER_PATH.'img/uploads/');
define('PRODUCT_IMG_SITE_PATH',SITE_PATH.'img/uploads/');