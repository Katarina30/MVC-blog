<?php

class Post extends ORM {

		
    public function __construct(){
		parent::__construct();
        $this->table('post');
        $this->primaryKey('id');
        
    }
	
	public function getSearchedPosts($search){
		$search = "%$search%";
	
        $posts = $this->select("*,P.id as idPost,U.id as idUser")->table('post P')->join("user U","P.user_id","=","U.id")
		->orderBy("created_at","DESC")->whereOr("title",$search,"LIKE")->whereOr("text",$search,"LIKE")->get();
		
		return $posts;
	
		
    }
	
	public function getAllPosts(){
        $posts = $this->select("*,P.id as idPost,U.id as idUser")->table('post P')->join("user U","P.user_id","=","U.id")
		->orderBy("created_at","DESC")->all();
        return $posts;
    }
	
    public function getPostById($id){
        $res = $this->where("id",$id,"=")->getSingle();
		return $res;
    }
		
}
 	
   
   
	

	
	
   
   
   
    
