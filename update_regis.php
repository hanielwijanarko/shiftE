<?php
require_once 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_id'];
    $nama = $_POST['nama'];
    $newPassword = $_POST['new_password'];

    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    } else {
        $sql = "SELECT password FROM users WHERE id = $userId";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
    }

    $sql = "UPDATE users SET nama='$nama', password='$hashedPassword' WHERE id=$userId";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profil</title>
</head>
<body>
    <h2>Update Profil</h2>
    <form method="post">
        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
        Nama: <input type="nama" name="nama" value="<?php echo $nama; ?>"><br>
        Password baru (opsional): <input type="password" name="new_password"><br>
        <input type="submit" value="Simpan">
    </form>
</body>
</html>