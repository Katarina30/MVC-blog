<?php
class Route{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];


    public function __construct(){

        $url = $this->getUrl();

        // Proveravamo da li postoji controller, ako postoji setujemo vrednost
        if(file_exists('./controllers/' . ucwords($url[0]). '.php')){
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        // ucitavamo controller
        require_once './controllers/'. $this->currentController . '.php';

        $this->currentController = new $this->currentController;

        // Proveravamo da li postoji metod, ako postoji setujemo vrednost
        if(isset($url[1])){
              if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        // dobijamo parametre
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
	//preuzimamo URL
    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}