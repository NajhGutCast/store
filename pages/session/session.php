<?php
include_once '../../components/gLibraries/gjson.php';
session_start();
echo 'let permissions = ' . json_encode(gJSON::flatten($_SESSION['role']['permissions'])) . ';';
