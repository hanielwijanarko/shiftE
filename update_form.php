<?php
require_once 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_peserta = $_POST['id_peserta'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $nama_program = $_POST['nama_program'];

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $sql = "SELECT password FROM peserta WHERE id_peserta = $id_peserta";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
    }

    $sql = "UPDATE peserta SET nama='$nama', password='$hashed_password', nama_program='$nama_program' WHERE id_peserta=$id_peserta";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id_peserta = $_GET['id'];

    $sql = "SELECT * FROM peserta WHERE id_peserta = $id_peserta";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
        $password = $row['password'];
        $nama_program = $row['nama_program'];
    } else {
        echo "Peserta tidak ditemukan.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Data Peserta</title>
</head>
<body>
    <h2>Update Data Peserta</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id_peserta" value="<?php echo $id_peserta; ?>">
        Nama: <input type="text" name="nama" value="<?php echo $nama; ?>"><br>
        Password baru: <input type="password" name="password"><br>
        Nama_Program: <input type="text" name="nama_program" value="<?php echo $nama_program; ?>"><br>
        <input type="submit" value="Simpan">
    </form>
</body>
</html>