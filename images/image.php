<?php

if (extension_loaded("gd") && function_exists("gd_info")) {
    echo "Ok. GD cargada";
} else {
    echo "GD no instalada. Si quieres puedes probar instalarla en Linux: https://parzibyte.me/blog/2019/06/24/instalar-libreria-gd-php-linux-ubuntu/";
}

// $rutaImagenOriginal = "car.jpg";
// # La abrimos como un recurso. Nota: uso imagecreatefromjpeg porque es una JPEG, si fuera
// # una PNG, usa imagecreatefrompng
// $imagenOriginal = imagecreatefromjpeg($rutaImagenOriginal);

// $calidad = 20; // Valor entre 0 y 100. Mayor calidad, mayor peso
// header("Content-Type: image/jpeg");
// imagejpeg($imagenOriginal, null, $calidad);






// $filename = "Test";
// $file = "logo.svg";
// $handle = fopen($file, "r");
// $binary = fread($handle, filesize($file));

// $base64 = base64_encode($binary);



// echo base64_decode(stripcslashes($base64));



// exit;

// header('Content-Type: image/jpeg');
?>