<?php


class Validation{
	
    private $passed = false;
    private $errors = [];
    private $connection;

   
     public function __construct(){
        global $conn;
        $this->connection = $conn;
    }

    
    public function check($source,$items = []){
        foreach($items as $item => $rules){
          
			$item = Input::sanitize($item);
				
            foreach($rules as $rule => $rule_value){
                $value = trim($source[$item]);
                if($rule === 'required' && empty($value) && !isset($this->errors[$item])){
                    $this->addError("{$item} is required",$item);
                }
				elseif(!empty($value)){
                    switch ($rule){
                        case 'min':
                            if (strlen($value) < $rule_value && !isset($this->errors[$item])){
                                $this->addError("{$item} must be a minimum of {$rule_value} characters",$item);
                            }
                            break;
                       
                        case 'unique':

                            $check = $this->connection->prepare("SELECT {$item} FROM {$rule_value} WHERE {$item} = '{$value}';");
							 $checking = $check->resultSet();

                            if (count($checking) > 0 && !isset($this->errors[$item])){
                                $this->addError("{$item} already exists",$item);
                            }
                            break;
                    }
                }

            }
        }
       
        if(empty($this->errors)){
            $this->passed = true;
        }
        return $this;
    }

    private function addError($error,$key=null){
        $this->errors[$key] = $error;
    }

   
    public function errors(){
        return $this->errors;
    }

        public function passed(){
        return $this->passed;
    }


}

