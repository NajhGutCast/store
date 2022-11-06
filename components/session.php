<?php
session_start();

$session = $_SESSION;
unset($session['auth_token']);

?>