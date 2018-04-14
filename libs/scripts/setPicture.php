<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 25-Mar-18
 * Time: 7:45 PM
 */

class setPicture
{
    public function fetchNamePicture($file,$folder){
        if($file != ''){
            $fileName           = $this->random(5) . '.'. (pathinfo($file['name'],PATHINFO_EXTENSION));
            $destination        = PUBLIC_FILE.$folder.DS. $fileName;
            @move_uploaded_file($file['tmp_name'],$destination);
            return $fileName ;
        }


           // croup hình ảnh -> save lại
    }
   static public function deletePicture($folder,$file){
            $fileName = PUBLIC_FILE.$folder.DS. $file;
            @unlink($fileName);

    }

    private function random($length = 5){
        $arrCharacter = array_merge(range("A", "Z"),range("a", "z"),range(0,9));
        $arrCharacter = implode($arrCharacter, '');
        $arrCharacter = str_shuffle($arrCharacter);
        $result       = substr($arrCharacter,0 ,$length);
        return $result;
    }
}