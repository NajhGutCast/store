<?php
session_start();
error_reporting(0);
$request = json_decode(file_get_contents('php://input'), true);
$response = null;
$status = 500;
$content_type = 'text/plain';

try {

    $headers = [
        'Content-Type: application/json'
    ];

    if (
        $_SERVER['HTTP_SODE_AUTH_REQUIRED'] &&
        $_SERVER['HTTP_SODE_AUTH_REQUIRED'] == 'Yes'
    ) {

        if (!$_SESSION['auth_token'] || !$_SESSION['username']) {
            $status = 401;
            session_unset();
            session_destroy();
            throw new Exception('No tienes una sesión activa');
        }
        $headers[] = 'SoDe-Auth-Token: ' . $_SESSION['auth_token'];
        $headers[] = 'SoDe-Auth-User: ' . $_SESSION['username'];
    }

    $path = $_GET['path'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://backactivity.sode.me/api/$path",
        // CURLOPT_URL => "http://localhost:8000/api/$path",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $_SERVER['REQUEST_METHOD'],
        CURLOPT_POSTFIELDS => json_encode($request, JSON_PRETTY_PRINT),
        CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);
    $content_type = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
    $status = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
    curl_close($curl);

    // Guardando consulta de sesión
    if (
        in_array($path, ['session/verify', 'session/login'])
    ) {
        if ($status == 200) {
            $response = json_decode($response, true);
            $_SESSION = $response['data'];
            unset($response['data']['auth_token']);
            $response = json_encode($response);
        } else {
            session_unset();
            session_destroy();
        }
    } else if (str_contains($path, 'session/logout')) {
        session_unset();
        session_destroy();
    }
} catch (\Throwable $th) {
    $response = json_encode([
        'status' => $status,
        'message' => $th->getMessage()
    ], JSON_PRETTY_PRINT);
    $content_type = 'application/json';
} finally {
    http_response_code($status);
    header("Content-Type: $content_type");
    echo $response;
}
