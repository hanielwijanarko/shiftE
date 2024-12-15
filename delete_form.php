<?php
require_once 'koneksi.php';
session_start();


$id_peserta = $_POST['id_peserta'];
if (isset($_POST['hapus'])) {
    
    $sql = "DELETE FROM peserta WHERE id_peserta = $id_peserta";
    if ($conn->query($sql) === TRUE) {
        echo "Data peserta berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus Data Peserta</title>
</head>
<body>
    <h2>Apakah Anda yakin ingin menghapus data peserta ini?</h2>
    <p>Data yang akan dihapus:</p>
    <form method="POST" action="">
        <input type="hidden" name="id_peserta" value="<?php echo $id_peserta; ?>">
        <input type="submit" name="hapus" value="Hapus">
        <a href="index_form.php">Batal</a>
    </form>
</body>
</html>

<?php
}