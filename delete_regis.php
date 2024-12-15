<?php
require_once 'koneksi.php';
session_start();

$id = $_POST['id'];
if (isset($_POST['hapus'])) {
    
    $sql = "DELETE FROM akun WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Data pengguna berhasil dihapus.";
        header("Location: index_regis.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus Akun</title>
</head>
<body>
    <h2>Apakah Anda yakin ingin menghapus akun ini?</h2>
    <p>Data yang akan dihapus:</p>
    <ul>
        </ul>
    <form method="POST" action="delete_regis.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="hapus" value="Hapus">
        <a href="index_regis.php">Batal</a>
    </form>
</body>
</html>

<?php
}