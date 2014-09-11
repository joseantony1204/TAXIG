<?php
exec("C:/wamp/www/TAXIG/F.bat", $output);
print_r($output);

/*
$path = "C:/wamp/www/TAXIG/Factura.txt";
$file = basename($path);
$type = '';

if (is_file($path)) {
 $size = filesize($path);
 if (function_exists('mime_content_type')) {
 $type = mime_content_type($path);
 } else if (function_exists('finfo_file')) {
 $info = finfo_open(FILEINFO_MIME);
 $type = finfo_file($info, $path);
 finfo_close($info);
 }
 if ($type == '') {
 $type = "application/force-download";
 }
 // Definir headers
 header("Content-Type: $type");
 header("Content-Disposition: attachment; filename=$file");
 header("Content-Transfer-Encoding: binary");
 header("Content-Length: " . $size);
 // Descargar archivo
 readfile($path);
} else {
 die("El archivo no existe.");
}

?>

<?php /*
    $computername = "DDS";
    $ip = gethostbyname($computername);
    //exec("ping ".$ip." -n 1 -w 90 && exit", $output);
    exec("C:/wamp/www/TAXIG/F.bat", $output);
	
    print_r($output);
//999006792139*/
?>