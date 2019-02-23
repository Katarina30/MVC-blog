<?php

class Session{
   
   //da li postoji
    public static function exists($name){
        return (isset($_SESSION[$name])) ? true : false;
    }

	// kreiranje sesije
    public static function put($name,$value){
        return $_SESSION[$name] = $value;
    }

	//dobijanje sesije
    public static function get($name){
        return $_SESSION[$name];
    }

    //brisanje sesije
    public static function delete($name){
        if (self::exists($name)){
            unset($_SESSION[$name]);
        }
    }

    public static function flash($name,$string = ''){
        if (self::exists($name)){
            $session = self::get($name);
            self::delete($name);
            return $session;
        }
    }


}