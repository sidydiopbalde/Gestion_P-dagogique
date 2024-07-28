<?php
namespace Core;

interface SessionInterface {
    public static function start();
    public static function set($key, $value);
    public static function get($key);
    public static function isset($key);
    public static function remove($key);
    public static function close();
}