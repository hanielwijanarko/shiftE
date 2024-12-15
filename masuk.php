<?php
require_once 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['name'];
    $password = $_POST['password'];

    // Cek apakah nama dan password ada di database
    $sql = "SELECT * FROM akun WHERE nama='$nama'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Redirect ke halaman yang berisi link
            header("Location: backend.html");
            exit();
        } else {
            // Menampilkan pesan kesalahan
            echo "<div class='error-box'><p>Password salah.</p></div>";
        }
    } else {
        // Menampilkan pesan kesalahan
        echo "<div class='error-box'><p>Nama tidak ditemukan.</p></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Masuk - Tactical Edge</title>
    <style>
        .error-box {
            background-color: #f8d7da; /* Warna latar belakang merah muda */
            border: 1px solid #f5c6cb; /* Warna border merah */
            color: #721c24; /* Warna teks merah gelap */
            padding: 10px;
            margin-top: 10px;
            display: none; /* Sembunyikan box secara default */
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <div class="registration-box">
            <div class="header">
                <a href="index.html" class="back-btn">← Kembali</a>
                <h2>Login</h2>
            </div>
            <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <input type="text" id="name" name="name" placeholder="Masukkan nama anda" required>
                </div>
                
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="register-btn">Masuk Sekarang</button>
                <br>
                <!-- Pesan kesalahan akan ditampilkan di sini -->
                <div class="error-box" style="display: none;">
                    <p id="error-message" style="color: red;"></p>
                </div>
            </form>
            
            
        </div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const name = document.getElementById('name').value;
            const password = document.getElementById('password').value;

            if (!name || !password) {
                document.getElementById('error-message').innerText = 'Semua field harus diisi!';
                return;
            }

            document.getElementById('error-message').innerText = '';
            this.submit();
        });
    </script>
</body>
</html> 