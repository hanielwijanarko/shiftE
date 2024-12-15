<?php
include_once("koneksi.php");

$stmt = $conn->prepare("SELECT id, nama, password FROM akun");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head><title>Registrasi</title></head>
<body>
    <h1>Registrasi</h1>
    <a href="regis.php">Tambah</a> | <a href="backend.html">Kembali ke Daftar</a>
    <br/><br/>

    <table border="1">
        <tr>
            <th>id</th>
            <th>Nama</th>
            <th>Password</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo '***' . substr($row['password'], -4); ?></td>  
                <td>
                    <a href="update_regis.php?id=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="delete_regis.php?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>