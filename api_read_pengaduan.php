<?php
include "koneksi.php";

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

$query = "SELECT
            p.id,
            p.id_pengadu,
            pd.nama,
            p.tanggal,
            p.kategori,
            p.deskripsi,
            p.status
          FROM pengaduan p
          INNER JOIN pengadu pd
          ON p.id_pengadu = pd.id
          ORDER BY p.id DESC";

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