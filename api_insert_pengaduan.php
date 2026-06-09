<?php
include "koneksi.php";

$id_pengadu = $_POST['id_pengadu'] ?? '';
$tanggal    = $_POST['tanggal'] ?? '';
$kategori   = $_POST['kategori'] ?? '';
$deskripsi  = $_POST['deskripsi'] ?? '';
$status     = $_POST['status'] ?? 'pending';

if (
    $id_pengadu == '' ||
    $tanggal == '' ||
    $kategori == '' ||
    $deskripsi == ''
) {
    echo json_encode([
        "status" => false,
        "message" => "Semua data wajib diisi"
    ]);
    exit;
}

$query = "INSERT INTO pengaduan
          (id_pengadu, tanggal, kategori, deskripsi, status)
          VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param(
    $stmt,
    "issss",
    $id_pengadu,
    $tanggal,
    $kategori,
    $deskripsi,
    $status
);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => true,
        "message" => "Data pengaduan berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => mysqli_error($conn)
    ]);
}
?>