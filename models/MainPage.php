<?php

class MainPage{
    public static function isLogged(){
        if (isset($_SESSION['id'])){
            return $_SESSION['id'];
        }
        return false;
    }
}