<?php
include_once("koneksi.php");

$stmt = $conn->prepare("SELECT id_peserta, nama, password, nama_program FROM peserta");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head><title>Pelatihan</title></head>
<body>
    <h1>Daftar Program Pelatihan</h1>
    <a href="daftar.php">Tambah</a> | <a href="backend.html">Kembali ke Daftar</a>
    <br/><br/>

    <table border="1">
        <tr>
            <th>id_peserta</th>
            <th>Nama</th>
            <th>Password</th>
            <th>Nama_Program</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id_peserta']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo '***' . substr($row['password'], -4); ?></td>  <td><?php echo $row['nama_program']; ?></td>
                <td>
                    <a href="update_form.php?id=<?php echo $row['id_peserta']; ?>">Edit</a> |
                    <a href="delete_form.php?id=<?php echo $row['id_peserta']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>