<?php 

function isNullOrEmptyString($str){
    return ($str === NULL || trim($str) === '');
}

?>