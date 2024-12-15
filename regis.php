<?php
require_once 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO akun (nama, password) VALUES ('$nama', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan.";
        header("Location: index_regis.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
</head>
<body>
    <h2>Registrasi</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Nama: <input type="nama" name="nama" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Daftar">
        <a href="index_regis.php">Kembali ke Index Registrasi</a>
    </form>
</body>
</html>