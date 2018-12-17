<?php
/**
 * Created by PhpStorm.
 * User: ZK-PC
 * Date: 03/12/2018
 * Time: 11:37 AM
 */
require "vendor/autoload.php";

use Medoo\Medoo;

$pdo = new PDO('mysql:dbname=vialogik_dscic;host=localhost','root','');

function db(){
    return new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'vialogik_dscic',
        'server' => 'localhost',
        'username' => 'root',
        'password' => ''
    ]);
}
?>