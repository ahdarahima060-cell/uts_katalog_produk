<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");


$host = "db";  //ini disesuaikan dengan nama service database di docker-compose.yml
$user = "root"; //ini disesuaikan dengan username database
$password = "secretpassword"; // ini disesuaikan dengan password database
$db_name = "db_toko";  // ini disesuaikan dengan nama database

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM produk");
    $stmt->execute();
    $produk = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    http_response_code(200);
    echo json_encode([
        "status" => "success",
        "code" => 200,
        "data" => $produk,
        "message" => "Data produk berhasil diambil"
    ], JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "code" => 500,
        "message" => "Koneksi Gagal : " . $e->getMessage()
    ], JSON_PRETTY_PRINT);
}
?>