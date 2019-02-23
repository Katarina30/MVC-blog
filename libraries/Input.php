<?php


class Input{

   
    public static function sanitize($clear){
        return htmlentities($clear,ENT_QUOTES,'UTF-8');
    }

  
     // proveramo da li postoji HTTP type
   
    public static function exists($type = 'post'){
        $type = strtolower($type);
        switch ($type){
            case 'post':
                return (!empty($_POST)) ? true : false;
                break;
            case 'get':
                return (!empty($_GET)) ? true : false;
                break;
            default:
                return false;
                break;
        }
    }

      public static function get($input){
		  
        if(isset($_POST[$input])){
            return self::sanitize($_POST[$input]);
        }
		
		elseif (isset($_GET[$input])){
            return self::sanitize($_GET[$input]);
        }
    }
}