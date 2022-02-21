<?php 

function isNullOrEmptyString($str){
    return ($str === null || trim($str) === '');
}

?>