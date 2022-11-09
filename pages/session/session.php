<?php
include_once '../../components/gLibraries/gjson.php';
session_start();
echo 'let permisos = ' . json_encode(gJSON::flatten($_SESSION['rol']['permisos'])) . ';';
