<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 14-Jan-18
 * Time: 3:48 PM
 */
require_once 'define.php';
function __autoload($className){
    require_once LIBRATY_PATH. "{$className}.php";
}

$boostrap = new Boostrap();


Session::init();
$boostrap->init();
