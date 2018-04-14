<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 19-Jan-18
 * Time: 7:05 PM
 */

class URL
{
 public static function setURL($module,$controller,$action,$option = null,$router = null){
     $xhtml     = '';
     $linkParam = '';
     if($router != null){
         return $xhtml = ROOT_URL.$router;
     }

     if(!empty($option)){
         foreach ($option as $key => $value){
             $linkParam .= "&$key=$value";
         }
     }
     //index.php?module=admin&controller=group&action='editStatus'&id=1&status=1;
    $xhtml = 'index.php?module='.$module.'&controller='.$controller.'&action='. $action.$linkParam;
     return $xhtml;
 }

    private function removeSpace($value){
        $value   = trim($value);
        $value   = preg_replace("#(\s)+#imsU",' ', $value);
        $value   = preg_replace("#(\s)+#imsU", '-', $value);
        $value   = preg_replace("#(-)+#", '-', $value);
        return $value;
    }

    private function textConversion($value){
        $value		= mb_strtolower($value,'UTF-8');

        $characterA	= '#(à|ả|ã|á|ạ|ă|ằ|ẳ|ẵ|ắ|ặ|â|ầ|ẩ|ẫ|ấ|ậ)#imsU';
        $replaceA	= 'a';
        $value      = preg_replace($characterA, $replaceA, $value);

        $characterD	= '#(đ|Đ)#imsU';
        $replaceD	= 'd';
        $value = preg_replace($characterD, $replaceD, $value);

        $characterE	= '#(è|ẻ|ẽ|é|ẹ|ê|ề|ể|ễ|ế|ệ)#imsU';
        $replaceE	= 'e';
        $value = preg_replace($characterE, $replaceE, $value);

        $characterI	= '#(ì|ỉ|ĩ|í|ị)#imsU';
        $replaceI	= 'i';
        $value = preg_replace($characterI, $replaceI, $value);

        $charaterO = '#(ò|ỏ|õ|ó|ọ|ô|ồ|ổ|ỗ|ố|ộ|ơ|ờ|ở|ỡ|ớ|ợ)#imsU';
        $replaceCharaterO = 'o';
        $value = preg_replace($charaterO,$replaceCharaterO,$value);

        $charaterU = '#(ù|ủ|ũ|ú|ụ|ư|ừ|ử|ữ|ứ|ự)#imsU';
        $replaceCharaterU = 'u';
        $value = preg_replace($charaterU,$replaceCharaterU,$value);

        $charaterY = '#(ỳ|ỷ|ỹ|ý)#imsU';
        $replaceCharaterY = 'y';
        $value = preg_replace($charaterY,$replaceCharaterY,$value);

        $charaterSpecial = '#(,|$)#imsU';
        $replaceSpecial = '';
        $value = preg_replace($charaterSpecial,$replaceSpecial,$value);

        return $value;

    }

    public static function optimizeText($value){

        $value = URL::removeSpace($value);
        $value = URL::textConversion($value);

        return $value;
    }
}