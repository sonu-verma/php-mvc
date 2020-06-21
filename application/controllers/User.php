<?php 

class User extends framework{
     
    public function __construct(){
        $this->data = $this->model('userModel');
        $this->helper("custom");

    }
    public function index(){
        echo "users controllers";
    }

    public function userMethod(){
        
        if($this->data->getData()){
            $result =$this->data->fetchAll();
        }else{
            echo "Oops something went wrong.";
            exit;
        }
        $this->view("userView",$result);
    }

    public function register(){
    
        $userData = [
           'username' =>  'rahul',
           'password' =>  'sonttuverma',
           'email' =>  'sonuvettrma@gmail.com',
           'contact' =>  '95455077850',
           'usernameError' =>  '',
           'passwordError' =>  '',
           'emailError' =>  '',
           'contactError' =>  ''
           
        ];

        if(empty($userData['username'])){
            $userData['usernameError'] = "Username is required";
        }else{
            if(!$this->data->checkUnique('username',$userData['username'])){
                $userData['usernameError'] = "Username should be unique";
            }
        }

        if(empty($userData['password'])){
            $userData['passwordError'] = "password is required";
        }


        if(empty($userData['email'])){
            $userData['emailError'] = "email is required";
        }else{
            if(!$this->data->checkUnique('email',$userData['email'])){
                $userData['emailError'] = "email should be unique";
            }
        }

        if(empty($userData['contact'])){
            $userData['contactError'] = "contact is required";
        }else{
            if(!$this->data->checkUnique('contact',$userData['contact'])){
                $userData['contactError'] = "contact should be unique";
            }
        }

        if(empty($userData['usernameError']) && empty($userData['passwordError']) && empty($userData['emailError']) && empty($userData['contactError'])){
            echo 'form submit';
            $this->data->insert($userData);
        }else{
            echo 'error';
        }
        
    }

    public function login(){
    
        $username = ' sonuverma ';
        $password = 'sonuverma';
        if($this->data->checkUser($username,$password)){
            echo "found";
        }else{
            echo "not found";
        }
    }

    public function profile($id){
    
        if($this->data->getById($id)){
            print_r($this->data->getById($id));
         }else{
             echo "No data found.";
         }
    }
}
?>