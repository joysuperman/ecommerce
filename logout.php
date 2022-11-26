<?php

/**
 * @Author: SUPERMAN
 * @Date:   2022-09-26 18:38:50
 * @Last Modified by:   SUPERMAN
 * @Last Modified time: 2022-09-26 18:47:32
 */
require_once "inc/connection.php";
require_once "inc/functions.php";

unset($_SESSION['user_login']);
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);

header('location: login.php');
die();