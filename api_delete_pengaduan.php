<?php
include "koneksi.php";

$id = $_POST['id'] ?? '';

if ($id == '') {
    echo json_encode([
        "status" => false,
        "message" => "ID wajib diisi"
    ]);
    exit;
}

$query = "DELETE FROM pengaduan WHERE id=?";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => true,
        "message" => "Data pengaduan berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => mysqli_error($conn)
    ]);
}
?>