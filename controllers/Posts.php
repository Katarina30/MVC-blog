<?php
class Posts extends Controller{
	
	
    public function __construct(){
		
      $this->postModel = $this->model('Post');
     
    }
	/////////////////////////////////////////////////////
		
	public function index(){
        if(Input::exists()){
			$search = Input::get('search');
			$posts = $this->postModel->getSearchedPosts($search);
			$this->view('posts/index',['posts'=>$posts]);
			          
        }
		else {
			$posts = $this->postModel->getAllPosts();
			$this->view('posts/index',['posts'=>$posts]);
		}
	}
	//////////////////////////////////////////////////
	public function add(){
		
		if (Input::exists()){
            $validation = new Validation();
            $validate = $validation->check($_POST,[
                'title'=>[
                    'required'=>true,
				
                ],
				 'text'=>[
                    'required'=>true,
                    
                ],
               'user_id'=>[
                   
                ],
            ]);
			
		if ($validate->passed()){
				
				$post = $this->postModel->create([
						'title'=>Input::get('title'),
						'text'=>Input::get('text'),
						'user_id'=>Session::get('id'),
						
				]);
				
				redirect('posts/index');
    }
		else{
				
                redirect('posts/index');
            }
		}
		$this->view('posts/add');
    }
	///////////////////////////////////////////////////////////////////	
	public function edit($id){
	
		if (Input::exists()){
            $validation = new Validation();
            $validate = $validation->check($_POST,[
				'title'=>[
                    'required'=>true,
				
                ],
				 'text'=>[
                    'required'=>true,
                    
                ],
              
            ]);
			if ($validate->passed()){
				
				$post = $this->postModel->where('id',$id,'=')->update([
						'id'=>$id,
						'title'=>Input::get('title'),
						'text'=>Input::get('text'),
						'user_id'=>Session::get('id'),
						
				]);
				
				redirect('posts/index');
    }
		
		else{
             $this->view('posts/index');
            }
			
	}
		else{
			$post = $this->postModel->getPostById($id);

			if($post->user_id != Session::get('id')){
			  redirect('posts');
			}
					
			 $this->view('posts/edit',['post'=>$post]);
		}
	
		}
		////////////////////////////////////////////////
		 public function show($id){
			  
		  $post = $this->postModel->getPostById($id);
		 
		  $this->view('posts/show',['post'=>$post]);
		 
		}
		////////////////////////////////////////////////////////////
		public function delete($id){

              $post = $this->postModel->getPostById($id);

			
              if($post->user_id != Session::get('id')){
                  redirect('posts');
              }

			if($this->postModel->where('id',$id,'=')->delete()){
			
			  redirect('posts');
			  
			} 
			
			else {
			  die('Something went wrong');
			}

		}


}