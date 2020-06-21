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
           'username' => encode_decode($this->input('username'), 1),
           'password' =>  encode_decode($this->input('password'),1),
           'email' =>   encode_decode($this->input('email'),1),
           'contact' =>   encode_decode($this->input('contact'),1),
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
            $this->data->insert($userData);
            $output  = array('status'=>true,'msg'=>"successfully inseted in db.",'error' => '');
        
        }else{
           $output  = array('status'=>false,'msg'=>"something went wrong",'errors' => $userData);
        }
        echo json_encode($output);
    }

    public function login(){
    
        $username = ' sonuverma ';
        $password = 'sonuverma';
        if($this->data->checkUser($username,$password)){
            $output  = array('status'=>true,'msg'=>"match.");
        }else{
            $output  = array('status'=>false,'msg'=>"data not found.");
        }
        return json_encode($output);
    }

    public function profile($id){
    
        if($this->data->getById($id)){
            $output  = array('status'=>true,'msg'=>"match.",'data'=>$this->data->getById($id));
        }else{
            $output  = array('status'=>false,'msg'=>"data not found.",'data'=>'');
        }
        return json_encode($output);
    }
}
?>