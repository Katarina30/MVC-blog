<?php

include_once APPROOT.'/libraries/query_builders/interfaces/QueryBuilderInterface.php';



class QueryBuilder implements QueryBuilderInterface {
	
	private $conn;
    private $select='*';
    private $table = '';
    private $primaryKey = '';
    private $conditional = '';
    private $limit = '';
    private $orderBy = '';

    protected $attributes = [];
	
	
	public function __construct(Database $db){	
	
	if(!$this->conn)
		$this->conn = $db;
	         
    }
	
	/* proveravamo prosledjena polja da li su niz ili string
      ako su niz spajamo u string sa zarezom kao delimiterom
     */
    public function select($fields){
		
        if(is_array($fields))
            $this->select = implode(',', $fields);
        elseif(is_string($fields))
            $this->select = $fields;

        return $this;

    }
	
	/**
     * proveravamo prosledjene parametre kolonu, vrednost i znak
     * ako nije setovan uslov iniciramo ga sa kljucnom reci WHERE i kolonom, znakom i vrednoscu
     * u suprotnom dodajemo na postojeci uslov kljucnu rec AND i kolonom, znakom i vrednoscu
     * vracamo objekat
     */
    public function where($column, $value, $sign = "="){
		
        $value = is_string($value) ? "'{$value}'" : $value;
        if(!$this->conditional)
            $this->conditional = "  WHERE {$column} {$sign} {$value}";
        else
            $this->conditional .= " AND  {$column} {$sign} {$value}";

        return $this;
    }
	
	public function whereOr($column, $value, $sign = "="){
		
        $value = is_string($value) ? "'{$value}'" : $value;
        if(!$this->conditional)
            $this->conditional = "  WHERE {$column} {$sign} {$value}";
        else
            $this->conditional .= " OR  {$column} {$sign} {$value}";

        return $this;
    }
		
	public function join($column,$tableId1,$sign="=",$tableId2){
		
		$this->join = " LEFT JOIN {$column} ON {$tableId1} {$sign} {$tableId2}";
		
			return $this;	
	}

	  public function orderBy($column, $type = "asc"){
		  
            $this->orderBy = " ORDER BY {$column} {$type}";

        return $this;
    }

   
    public function limit($limit, $offset = 0){
		
            $this->limit = " LIMIT {$offset}, {$limit}";

        return $this;
    }

    
    public function prepare($query){
			
        return $this->conn->prepare($query);
    }

   
    public function table($table){
		
        $this->table = $table;

        return $this;
    }

    public function primaryKey($key = 'id'){
		
        $this->primaryKey = $key;

        return $this;
    }

   
    public function conditional($str){
		
        $this->conditional = $str;

        return $this;
    }

    
    public function getPrimaryKey(){
		
        return $this->primaryKey;
    }

   
    public function getTable(){
		
        return $this->table;
    }


    public function get(){
		
        $sql = "SELECT {$this->select} FROM {$this->table} {$this->join} {$this->conditional} {$this->orderBy} {$this->limit}";
        $res = $this->prepare($sql);
       	$results = $res->resultSet();
		$this->resetParams();
        return $results;
		
    }
	 public function getSingle(){
		 
        $sql = "SELECT {$this->select} FROM {$this->table}  {$this->join} {$this->conditional} {$this->orderBy} {$this->limit}";
        $res = $this->prepare($sql);
       	$results = $res->single();
		$this->resetParams();
        return $results;
		
    }

    public function insert($fields){
		
        $value = [];
        $field = [];
        $counter = 0;
        foreach ($fields as $key => $val){
            $value[$counter] = "'".$val."'";
            $field[$counter] = $key;
            $counter++;
        }
		
		$sql = "INSERT INTO {$this->table} (".implode(',',$field).") VALUES (".implode(',',$value).");";
		
        $res = $this->prepare($sql);
		
        $res->execute();

        return $res;

    }
	
    public function update($fields){
		
        $field = [];
        foreach($fields as $key => $val){
            $field[] = $key. "="."'".$val."'";
        }
        $cond = "";

        if ($this->conditional)
            $cond = " {$this->conditional}";
        elseif (isset($this->attributes[$this->primaryKey]))
            $cond = " {$this->primaryKey} = {$this->attributes[$this->primaryKey]}";

        $sql = "UPDATE {$this->table} SET ".implode(',',$field)."{$cond};";

        $result = $this->prepare($sql);

        $result->execute();

        $this->resetParams();
        return $result;

    }

    public function delete(){
        $cond = "";
        if ($this->conditional)
            $cond = " {$this->conditional}";
        elseif (isset($this->attributes[$this->primaryKey]))
            $cond = " {$this->primaryKey} = {$this->attributes[$this->primaryKey]}";

        $sql = "DELETE FROM {$this->table} {$cond};";

        $res = $this->prepare($sql);

        $res->execute();

        $this->resetParams();
        return $res;
    }
   
    private function resetParams(){
        $this->conditional = '';
        $this->select = '*';
        $this->orderBy = '';
        $this->limit = '';
    }

	
	
}