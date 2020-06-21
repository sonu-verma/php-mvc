<?php 

    function sanitize($inputValue){
        $inputValue = str_replace(array('(',')','*','%','~','/','\'','[',']','{','}','!','#','$','%','^','`','&',':','+','|','"','?','>','<','='), array(''), $inputValue);
        return trim(strip_tags($inputValue));
    }


    function encode_decode($input, $flag){
        //1 is encode for flag and 0 is decode
      $len = strlen($input);
      $output = '';
      for($i=0; $i < $len; $i++){
          $ascii = ord($input[$i]);
          if($flag){
              $output.= chr($ascii+$len);
           }
          else{
             $output.= chr($ascii-$len);
           }
                   
         }
      return $output;
      }
?>