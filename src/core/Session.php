<?php
namespace Core;


class Session implements SessionInterface {
   
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Static method to set a session variable
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    // Static method to get a session variable
    public static function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Static method to check if a session variable is set
    public static function isset($key) {
        return isset($_SESSION[$key]);
    }

    // Static method to remove a session variable
    public static function remove($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    // Static method to close the session
    public static function close() {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
}
// Session::start();
// Session::set('username', 'JohnDoe');
// echo Session::get('username'); // Outputs: JohnDoe
// Session::remove('username');
// Session::close();