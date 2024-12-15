<?php
session_start();
include("koneksi.php");
    
$id_peserta = $_GET['id_peserta'];
    $stmt=mysqli_query($conn, "DELETE FROM peserta WHERE id_peserta=$id_peserta");
    header("Location: index_form.php");
?>