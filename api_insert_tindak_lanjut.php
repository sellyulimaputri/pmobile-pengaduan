<?php
include "koneksi.php";

$id_pengaduan = $_POST['id_pengaduan'] ?? '';
$tanggal      = $_POST['tanggal'] ?? '';
$deskripsi    = $_POST['deskripsi'] ?? '';
$status       = $_POST['status'] ?? '';

if (
    $id_pengaduan == '' ||
    $tanggal == '' ||
    $deskripsi == '' ||
    $status == ''
) {
    echo json_encode([
        "status" => false,
        "message" => "Semua data wajib diisi"
    ]);
    exit;
}

$query = "INSERT INTO tindak_lanjut
          (id_pengaduan, tanggal, deskripsi, status)
          VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param(
    $stmt,
    "isss",
    $id_pengaduan,
    $tanggal,
    $deskripsi,
    $status
);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => true,
        "message" => "Data tindak lanjut berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => mysqli_error($conn)
    ]);
}
?>