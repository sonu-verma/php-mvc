<?php

    class database {
        public $host = HOST;
        public $user = USER;
        public $password = PASSWORD;
        public $database = DATABASE;
        public $con;
        public $result;



        public function __construct(){
            try{
                return $this->con = new PDO("mysql:host=".$this->host.";dbname=".$this->database,$this->user,$this->password);
            }catch(PDOException $e){
                echo "Database connection error".$e->getMessage();
            }
        }

        public function query($query, $params=[]){
            if(empty($params)){
                $this->result = $this->con->prepare($query);
                return $this->result->execute();
            }else{
                $this->result = $this->con->prepare($query);
                return $this->result->execute($params);
            }
        }

        public function rowCount(){
            return $this->result->rowCount();
        }

        public function fetchAll(){
            return $this->result->fetchAll(PDO::FETCH_OBJ);
        } 
        
        
        public function fetch(){
            return $this->result->fetch(PDO::FETCH_OBJ);
        }  
    }
?>