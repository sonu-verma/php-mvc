<?php 

    function sanitize($inputValue){
        $inputValue = str_replace(array('(',')','*','%','~','/','\'','[',']','{','}','!','#','$','%','^','`','&',':','+','|','"','?','>','<','='), array(''), $inputValue);
        return trim(strip_tags($inputValue));
    }
?>