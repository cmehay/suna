<?php
include_once('functions.php');
if (!$_POST)
{
    print html5_admin_adduser('fr', null, 'adduser.php');
}
else
{
    $test = add_user($_POST['usr_email'], $_POST['username'], 'admin');
    if ($test[0] === true)
    {
        send_register_mail($_POST['usr_email'], $_POST['username'], $test[1], 'fr');
        echo 'ok';
    }
    else
    {
        echo $test[1];
    }
}
?>