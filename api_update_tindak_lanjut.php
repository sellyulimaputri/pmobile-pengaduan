<?php
include "koneksi.php";

$id            = $_POST['id'] ?? '';
$id_pengaduan  = $_POST['id_pengaduan'] ?? '';
$tanggal       = $_POST['tanggal'] ?? '';
$deskripsi     = $_POST['deskripsi'] ?? '';
$status        = $_POST['status'] ?? '';

if (
    $id == '' ||
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

$query = "UPDATE tindak_lanjut
          SET
              id_pengaduan=?,
              tanggal=?,
              deskripsi=?,
              status=?
          WHERE id=?";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param(
    $stmt,
    "isssi",
    $id_pengaduan,
    $tanggal,
    $deskripsi,
    $status,
    $id
);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => true,
        "message" => "Data tindak lanjut berhasil diupdate"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => mysqli_error($conn)
    ]);
}
?>