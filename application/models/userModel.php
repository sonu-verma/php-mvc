<?php 

    class userModel extends database {
        public function getData(){
            $username = 'sonuverma';
            $password = 'sonuverma';
            $email = 'sonuverma@gmail.com'; 
            $contact = '9545577850';
            // if($this->query("INSERT INTO users(username, password, email, contact) VALUES(?, ?, ?, ?)",[$username,$password,$email,$contact])){
            if($this->query("select * from users")){
                return $this->fetch();
            }else{
                return false;
            }
        }

        public function insert($data){
            if($this->query("INSERT INTO users(username, password, email, contact) VALUES(?, ?, ?, ?)",[ $data['username'],$data['password'],$data['email'],$data['contact']])){
                return true;
            }else{
                return false;
            }
        }

        public function getById($id){
            if($this->query("select * from users where id=$id")){
                return $this->fetch();
            }else{
                return false;
            }
        }

        public function checkUser($username,$password){
           if($this->query("select * from users where username= '".$username."' and password= '".$password."'")){
               if($this->rowCount()  > 0){
                   return true;
               }else{
                   return false;
               }
            }else{
                return false;
            }
        }

        public function checkUnique($filedName,$value){
            if($this->query("select * from users where $filedName=?",[$value])){
                if($this->rowCount() > 0){
                    return false;
                }else{
                    return true;
                }
            }else{
                return false;
            }
        }
    }
?>