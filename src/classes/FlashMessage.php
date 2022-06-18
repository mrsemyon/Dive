<?php

class FlashMessage
{
    public static function set(string $key, string $message): void
    {
        $_SESSION[$key] = $message;
    }

    public static function display(string $key): void
    {
        echo $_SESSION[$key];
        unset ($_SESSION[$key]);
    }

    public static function isSet(string $key): bool
    {
        return (isset($_SESSION[$key]));
    }
}
