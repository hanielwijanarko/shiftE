<?php
require_once 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['name']; // Menggunakan 'name' dari form HTML
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $nama_program = $_POST['tipe_training']; // Menggunakan 'tipe_training' dari form HTML

    $sql = "INSERT INTO peserta (nama, password, nama_program) VALUES ('$nama', '$hashed_password', '$nama_program')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan.";
        // Redirect ke halaman login atau halaman lain jika diperlukan
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Daftar - Tactical Edge</title>
</head>
<body>
    <div class="registration-container">
        <div class="registration-box">
            <div class="header">
                <a href="index.html" class="back-btn">← Kembali</a>
                <h2>Registration</h2>
            </div>
            <form id="registrasi-form" action="daftar.php" method="POST">
                <div class="form-group">
                    <input type="text" id="name" name="name" placeholder="Masukkan nama anda" required>
                </div>
                
                <div class="form-group">
                    <input type="text" id="tipe_training" name="tipe_training" 
                           placeholder="physical training / tactical training / leadership training" required>
                </div>
                
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Buat password" required>
                </div>
                
                <div class="form-group">
                    <input type="password" id="konfirm-password" name="konfirm-password" placeholder="Konfirmasi password" required>
                </div>

                <button type="submit" class="register-btn">Daftar Sekarang</button>
            </form>
            
            <p id="error-message" style="color: red;"></p>
        </div>
    </div>

    <script>
        document.getElementById('registrasi-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const tipe_training = document.getElementById('tipe_training').value.toLowerCase();
            const password = document.getElementById('password').value;
            const konfirmPassword = document.getElementById('konfirm-password').value;
            const validtipe_trainings = ['physical training', 'tactical training', 'leadership training'];

            if (!validtipe_trainings.includes(tipe_training)) {
                document.getElementById('error-message').innerText = 'Jenis pelatihan tidak valid! Harus memilih diantara physical training / tactical training / leadership training';
                return;
            }

            if (password !== konfirmPassword) {
                document.getElementById('error-message').innerText = 'Password dan konfirmasi password tidak cocok!';
                return;
            }

            document.getElementById('error-message').innerText = '';
            this.submit(); // Mengirim form jika semua validasi berhasil
        });
    </script>
</body>
</html> 