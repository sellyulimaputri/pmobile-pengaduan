<?php
include "koneksi.php";

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

$query = "SELECT
            tl.id,
            tl.id_pengaduan,
            p.kategori,
            p.status AS status_pengaduan,
            tl.tanggal,
            tl.deskripsi,
            tl.status
          FROM tindak_lanjut tl
          INNER JOIN pengaduan p
          ON tl.id_pengaduan = p.id
          ORDER BY tl.id DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode([
        "status" => false,
        "message" => mysqli_error($conn)
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode([
    "status" => true,
    "total" => count($data),
    "data" => $data
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>