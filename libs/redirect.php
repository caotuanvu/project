<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 21-Jan-18
 * Time: 3:14 PM
 */

class redirect
{
 public static function locationHeader($module,$controller,$action,$option=null,$router = null){
 	 $link = URL::setURL($module,$controller,$action,$option,$router);
     header('location: '. $link);
     exit();
 }
}