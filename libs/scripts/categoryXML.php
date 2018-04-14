<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 11-Apr-18
 * Time: 8:31 PM
 */

class categoryXML
{
 public static function getCategoryXML($fileName, $option = null){
  if($option == null){
      $file = PUBLIC_FILE. 'xml'. DS. $fileName;
      $fileXML = simplexml_load_file($file);
      return $fileXML;
  }
 }

    public static function setCategoryXML($arrValue,$fileName, $option = null){
     $file =  PUBLIC_FILE. 'xml'. DS. $fileName;
        if($option == null){
            $xmlContent = '';
            $xmlContent = '<bookstore>';
            foreach ($arrValue as $key => $value) {
                $xmlContent .= '<category>
                                   <id>'.$value['id'].'</id>
                                   <name>'.$value['name'].'</name>
                                   <picture>'.trim($value['picture']).'</picture>                  
                                </category>';
            }
            $xmlContent .= '</bookstore>';
            file_put_contents($file, $xmlContent);
        }
    }

}