<?php
include "koneksi.php";

$id         = $_POST['id'] ?? '';
$id_pengadu = $_POST['id_pengadu'] ?? '';
$tanggal    = $_POST['tanggal'] ?? '';
$kategori   = $_POST['kategori'] ?? '';
$deskripsi  = $_POST['deskripsi'] ?? '';
$status     = $_POST['status'] ?? '';

if (
    $id == '' ||
    $id_pengadu == '' ||
    $tanggal == '' ||
    $kategori == '' ||
    $deskripsi == '' ||
    $status == ''
) {
    echo json_encode([
        "status" => false,
        "message" => "Semua data wajib diisi"
    ]);
    exit;
}

$query = "UPDATE pengaduan
          SET
              id_pengadu=?,
              tanggal=?,
              kategori=?,
              deskripsi=?,
              status=?
          WHERE id=?";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param(
    $stmt,
    "issssi",
    $id_pengadu,
    $tanggal,
    $kategori,
    $deskripsi,
    $status,
    $id
);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => true,
        "message" => "Data pengaduan berhasil diupdate"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => mysqli_error($conn)
    ]);
}
?>