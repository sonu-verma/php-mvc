<?php 

class User extends framework{
     
    public function __construct(){
        header("Access-Control-Allow-Origin: *");

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
    
        $username = encode_decode($this->input('username'),1);
        $password = encode_decode($this->input('password'),1);
        
        if($this->data->checkUser($username,$password)){
            $userData = $this->data->fetch();
            $user_id  = $userData->id;
            $token_id = md5(uniqid()); // random value
            $expires_at = time() + (60 * 60 * 24 ); // 1 day
            $created_at = time();
            $updated_at = time();
            $sesssionData =  [
                'user_id' => $user_id ,
                'token_id' => $token_id,
                'expiry' => $expires_at,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ];

            $returnType = $this->data->insertToken($sesssionData);
            if($returnType){
                $output  = array('status'=>true,'msg'=>"match.",'token_id'=>$token_id);
            }else{
                $output  = array('status'=>false,'msg'=>"something went wrong.",'token_id'=>'');
            }
            
           
        }else{
            $output  = array('status'=>false,'msg'=>"data not found.",'token_id'=>'');
        }
        echo json_encode($output);
    }

    public function profile($id){
        $values = [];
        
        $userInfo = $this->data->getById($id);
        if($userInfo){
            $values['username']  = encode_decode($userInfo->username,0);
            $values['email']  = encode_decode($userInfo->email,0);
            $values['contact']  = encode_decode($userInfo->contact,0);
        
            $output  = array('status'=>true,'msg'=>"match.",'data'=>$values);
        }else{
            $output  = array('status'=>false,'msg'=>"data not found.",'data'=>'');
        }
        echo json_encode($output);
    }
}
?>