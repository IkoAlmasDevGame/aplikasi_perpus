<?php 
require_once("../../../database/koneksi.php");
$table = "anggota";
$cache_file = "api_anggota.json";        
$result = $config->prepare("SELECT * FROM $table");
$result->execute();
$data = $result->fetchAll(PDO::FETCH_ASSOC);
$json_data = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents($cache_file, $json_data, FILE_USE_INCLUDE_PATH);
file_get_contents($cache_file);
move_uploaded_file($_FILES[$cache_file]['tmp_name'], '../anggota/'.$cache_file);
echo $json_data;
?>