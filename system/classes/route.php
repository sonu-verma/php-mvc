<?php

class route {

    // Default controller, method and param

    public $controller = "Welcome";
    public $method = "index";
    public $params = [];
    public function __construct(){
       
        $url = $this->url();
        //print_r($url);
        if(!empty($url)){

            // controller check
            if(file_exists("../application/controllers/".ucfirst($url[0]).".php")){
                $this->controller = ucfirst($url[0]);
                unset($url[0]);
                
            }else{
                echo "<div style='background-color:gray;margin:0px;padding:20px'>request controller ".ucfirst($url[0])."  not found.</div>";
            }
        }  
           
            // include controller
            require_once "../application/controllers/".$this->controller.".php";
            // Instantiate controller
            $this->controller = new $this->controller;

            if(isset($url[1]) && !empty($url[1])){
                 // controller's method check
                if(method_exists($this->controller,$url[1])){
                    $this->method = $url[1];
                     unset($url[1]);
                }else{
                    echo "<div style='background-color:gray;margin:0px;padding:20px'>request method ".$url[1]."  not found.</div>";
                }
            }    


            if(isset($url)){
                $this->params = $url;
            }else{
                $this->params = [];
            }

            //Call a callback with an array of parameters
            call_user_func_array([$this->controller,$this->method],$this->params);
        
    }
    public function url(){   // get url
        if(isset($_GET['url'])){
            $url  = $_GET['url'];
            $url = rtrim($url);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/",$url);
            return $url;
        }    
    }
}
?>