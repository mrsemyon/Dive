<?php

function setFlashMessage($key, $message)
{
    $_SESSION[$key] = $message;
}
