<?php
require_once 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = htmlspecialchars($_POST['nama']);
    $newPassword = $_POST['new_password'];

    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    } else {
        $stmt = $conn->prepare("SELECT password FROM akun WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
    }

    $stmt = $conn->prepare("UPDATE akun SET nama=?, password=? WHERE id=?");
    $stmt->bind_param("ssi", $nama, $hashedPassword, $id);
    if ($stmt->execute()) {
        echo "Data berhasil diperbarui.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM akun WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
    } else {
        echo "akun tidak ditemukan.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profil akun</title>
</head>
<body>
    <h2>Update Profil akun</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        Nama: <input type="text" name="nama" value="<?php echo $nama; ?>"><br>
        Password baru (opsional): <input type="password" name="new_password"><br>
        <input type="submit" value="Simpan">
    </form>
</body>
</html>