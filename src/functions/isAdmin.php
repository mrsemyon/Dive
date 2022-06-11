<?php

function isAdmin()
{
    return isset($_SESSION) && $_SESSION['role'] == 'admin';

}
