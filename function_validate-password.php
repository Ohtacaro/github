<?php

function validate_password($password)
{
    return preg_match('/(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $password);
}

?>