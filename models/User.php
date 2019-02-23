<?php

class User extends ORM {


    public function __construct(){
       parent::__construct();
	   $this->table('user');
	   $this->primaryKey('id');
    }
	
	 public function getUserById($id){
       $res = $this->where("id",$id,"=")->getSingle();
		return $res;
	
    }

}