<?php

function isAuthorized()
{
    return isset($_SESSION['email']);
}
