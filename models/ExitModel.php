<?php

class ExitModel{
    public static function logOut(){
        unset($_SESSION['id'], $_SESSION['username']);
    }
}