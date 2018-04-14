<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 13-Jan-18
 * Time: 7:41 AM
 */

class Session
{
  static public function init(){
     session_start();
  }
  static public function set($key,$value){
      $_SESSION[$key] = $value;
  }
  static public function get($key){
      if(isset($_SESSION[$key])) return $_SESSION[$key];
  }
  static public function detroy(){
      session_destroy();
  }
  static public function delete($key){
      if(isset($_SESSION[$key]))  unset($_SESSION[$key]);
  }
}