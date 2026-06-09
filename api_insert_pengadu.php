<?php
include "koneksi.php";

$nama   = $_POST['nama'] ?? '';
$nik    = $_POST['nik'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$telp   = $_POST['telp'] ?? '';
$email  = $_POST['email'] ?? '';

if ($nama == '' || $nik == '' || $alamat == '' || $telp == '' || $email == '') {
    echo json_encode([
        "status" => false,
        "message" => "Semua data wajib diisi"
    ]);
    exit;
}

$query = "INSERT INTO pengadu (nama, nik, alamat, telp, email)
          VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sssss", $nama, $nik, $alamat, $telp, $email);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => true,
        "message" => "Data pengadu berhasil ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => mysqli_error($conn)
    ]);
}
?>