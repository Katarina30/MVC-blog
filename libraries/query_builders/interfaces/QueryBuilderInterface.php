<?php

	interface QueryBuilderInterface{
	
		public function select($fields);

		public function where($column,$value,$sign="=");

		public function whereOr($column,$value,$sign="=");
		
		public function join($column,$tableId1,$sign="=",$tableId2);

		public function orderBy($column,$type="asc");

		public function limit($limit,$offset=0);

		public function prepare($query);

		public function table($table);

		public function primaryKey($key='id');

		public function get();

		public function insert($fields);

		public function update($fields);

		public function delete();

		public function conditional($str);

		public function getPrimaryKey();

		public function getTable();
		
	
	
}