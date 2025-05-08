<?php
require 'db.php';
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Cek apakah username sudah digunakan
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $check = $stmt->get_result();

    if ($check->num_rows > 0) {
        $error = "Username sudah digunakan.";
    } else {
        // Simpan user baru
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password); // *note: sebaiknya hash password untuk keamanan
        if ($stmt->execute()) {
            $success = "Registrasi berhasil. Silakan login.";
        } else {
            $error = "Terjadi kesalahan saat registrasi.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Registrasi</h2>
    <?php if ($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
    <?php if ($success): ?><p style="color: green;"><?= $success ?></p><?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="index.php">Login di sini</a></p>
</div>
</body>
</html>
