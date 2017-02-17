<?php

namespace app\core;


class Validation
{
    public static function escape($string){
        $returnValue = filter_var($string, FILTER_SANITIZE_STRING);
        $returnValue = htmlentities($returnValue, ENT_QUOTES, 'UTF-8');
        return $returnValue;
    }

    public static function valid ($string){
        if(!empty($string)){
            if(preg_match_all("/([a-zA-Z1-9])/", $string)){
            $string = filter_var($string, FILTER_SANITIZE_STRING);
            $string = htmlentities($string, ENT_QUOTES, 'UTF-8');
            return $string;
        }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function validWithoutEmpty ($string){
        if(preg_match_all("/([a-zA-Z1-9])/", $string)){
            $string = filter_var($string, FILTER_SANITIZE_STRING);
            $string = htmlentities($string, ENT_QUOTES, 'UTF-8');
            return $string;
        }else{
            return false;
        }
    }
}