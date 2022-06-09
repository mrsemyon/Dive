<?php

function checkPassword($inputPassword, $dbPassword)
{
    return password_verify($inputPassword, $dbPassword);
}
