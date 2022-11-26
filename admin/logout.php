<?php

/**
 * @Author: SUPERMAN
 * @Date:   2022-09-10 00:15:10
 * @Last Modified by:   SUPERMAN
 * @Last Modified time: 2022-10-20 00:18:52
 */
session_start();
unset($_SESSION['Admin_Login']);
unset($_SESSION['id']);
unset($_SESSION['f_name']);
header("location: login.php");
die();