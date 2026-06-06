<?php
class Session {
    public static function start(){
        if(session_status()=== PHP_SESSION_NONE){
            session_start();
        }
    }
    public static function set ($key, $value){
        $_SESSION [$key] = $value;
    }
    public static function get ($key){
        return $_SESSION[$key]??null;
    }
    public static function isLoggedIn(){
        return isset($_SESSION['korisnik_id']);
    }
    public static function logout(){
        session_destroy();
        header("Location: ../login.php");
        exit();
    }
     public static function requireLogin() {
        if (!self::isLoggedIn()) {
            header("Location: login.php");
            exit();
        }
    }
}
