<?php

class Controller {
    // Ucitavanje modela
    public function model($model){
        require_once 'models/' . $model . '.php';
        return new $model();
    }

    // Ucitavanje view-a
    public function view($view, $data = []){
        if(file_exists('views/' . $view . '.php')){
			if($data)
				extract($data);
			
            require_once 'views/' . $view . '.php';
			
			
        } else {
            die('View does not exist');
        }
    }
}