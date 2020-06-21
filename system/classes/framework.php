<?php
    
    class framework{
       
       
        public function view($viewName,$data = []){
            if(file_exists("../application/views/".$viewName.".php")){
                require_once "../application/views/".$viewName.".php";
            }else{
                echo "<div style='background-color:gray;margin:0px;padding:20px'>view not found.</div>";
            
            }
        }


        public function model($modelName){
           
            if(file_exists("../application/models/".$modelName.".php")){
                require_once "../application/models/".$modelName.".php";
                return new $modelName;
            }else{
                echo "<div style='background-color:gray;margin:0px;padding:20px'>models not found.</div>";
            
            }
        }

        public function helper($helperName){
            if(file_exists('../application/helpers/'.$helperName.'.php')){
                require_once '../application/helpers/'.$helperName.'.php';
            }else{
                echo "<div style='background-color:gray;margin:0px;padding:20px'>sorry helper $helperName not found.</div>";
            
            }

        }

        public function input($inputName){

            
            if($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == 'post'){
      
               return trim(strip_tags($_POST[$inputName]));
      
            } else if($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'get'){
      
               return trim(strip_tags($_GET[$inputName]));
      
            }
      
         }

        // Set session
        public function setSession($sessionName, $sessionValue){


            if(!empty($sessionName) && !empty($sessionValue)){
                $_SESSION[$sessionName] = $sessionValue;
            }

        }

        // Get session
        public function getSession($sessionName){

            if(!empty($sessionName)){
                return $_SESSION[$sessionName];
            }

        }

        // Unset session
        public function unsetSession($sessionName){

            if(!empty($sessionName)){
                
                unset($_SESSION[$sessionName]);

            }

        }

        // Destroy whole sessions
        public function destroy(){

            session_destroy();

        }
    }

?>