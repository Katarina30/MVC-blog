<?php


class ORM extends QueryBuilder{

    protected $attributes = [];

   
    public function __construct(){
        global $conn;
        parent::__construct($conn);

    }
	
	public function find($id){
        $this->conditional('');
        $result = $this->where($this->getPrimaryKey(),$id)->limit(1)->get();
        if($result){
            $this->setAttributes($result[0]);
            return $this;
        }else{
            return null;
        }
    }
	
	public function create($fields){
        
		$db = $this->insert($fields);
			
    }
	
	 public function all(){
        $this->conditional('');
        $items = $this->get();
        return $items;
    }
	
	 private function setAttributes($data){
        foreach($data as $key => $val)
            $this->attributes[$key] = $val;
    }
	
	public function __get($key){
		
        if(isset($this->attributes[$key])){
            return $this->attributes[$key];
        }
		else{
            return null;
        }
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}