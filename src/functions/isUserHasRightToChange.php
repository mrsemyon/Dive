<?php

function isUserHasRightToChange($user)
{
    return isset($_SESSION) &&
        (($_SESSION['role'] == 'admin') ||
        ($_SESSION['email'] == $user));
}
