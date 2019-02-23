<?php

class Users extends Controller {

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    
    public function index(){

         if (Input::exists()){
            $validation = new Validation();
            $validate = $validation->check($_POST,[
                'name'=>[
                    'required'=>true,
					'min'=>3,
                    'unique'=>'user',
                ],
				 'password'=>[
                    'required'=>true,
                ],
               
            ]);
				
			if ($validate->passed()){
				
					
				$hashed = password_hash(Input::get('password'),PASSWORD_DEFAULT);
							
				$user = $this->userModel->create([
						'name'=>Input::get('name'),
						'password'=>$hashed,
						
				]);
				
				Session::put('registered','You have been registered and can login');
				redirect('users/login');
    }
			
			else{
				Session::put('validation_err',$validate->errors());
                redirect('users/register');

            }
	
	}
			
        $this->view('users/register');
    }
	
	
	
	////////////////////////////////////////////////////////////////////////
	
	 public function login(){
        if (Input::exists()){
            $validation = new Validation();
            $validate = $validation->check($_POST,[

                 'name'=>[
                    'required'=>true,
                    'min'=>3
                ],
				
                'password'=>[
                    'required'=>true,
                                       
                ]

            ]);
			
            if ($validate->passed()){
                
                $name = Input::get('name');
                $password = Input::get('password');
               
                $users = $this->userModel->all();

                foreach($users as $person){
					
                    if ($person->name == $name){
						
                        $hashPassword = $person->password;
						
                        if (password_verify($password,$hashPassword)) {
							$id = $person->id;
							$name = $person->name;
                            Session::put('id',$id);
                            Session::put('name',$name);
                            Session::put('loggedin','You have been loggedin!');
																					
                            redirect('posts/index');
                        }
                    }
                }


            }
            else{
                Session::put('validation_err',$validate->errors());
                redirect('users/login');
            }
        }
        $this->view('users/login');
    }

	/////////////////////////////////////////////////////////////
	//unistava sesije i redirektuje na pocetnu stranu

    public function logout(){
        Session::delete('name');
        Session::delete('id');
        session_destroy();
        redirect('pages/index');

        }



}