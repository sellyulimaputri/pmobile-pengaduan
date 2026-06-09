<?php
include "koneksi.php";

$id     = $_POST['id'] ?? '';
$nama   = $_POST['nama'] ?? '';
$nik    = $_POST['nik'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$telp   = $_POST['telp'] ?? '';
$email  = $_POST['email'] ?? '';

if ($id == '' || $nama == '' || $nik == '' || $alamat == '' || $telp == '' || $email == '') {
    echo json_encode([
        "status" => false,
        "message" => "Semua data wajib diisi"
    ]);
    exit;
}

$query = "UPDATE pengadu
          SET nama=?, nik=?, alamat=?, telp=?, email=?
          WHERE id=?";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param(
    $stmt,
    "sssssi",
    $nama,
    $nik,
    $alamat,
    $telp,
    $email,
    $id
);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => true,
        "message" => "Data pengadu berhasil diupdate"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => mysqli_error($conn)
    ]);
}
?>