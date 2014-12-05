<?php
require 'Functions.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$user = $_POST["login"];
$pwd = $_POST["password"];
$conexion = new Functions();
$conexion->login_user($user, $pwd);