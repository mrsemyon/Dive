<?php

function displayFlashMessage($key)
{
    echo $_SESSION[$key];
    unset ($_SESSION[$key]);
}
