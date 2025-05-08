<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
require 'db.php';

$result = $conn->query("SELECT * FROM guestbook ORDER BY timestamp DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard Buku Tamu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Buku Tamu</h2>
    <form id="guestbookForm">
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="message" placeholder="Pesan" required></textarea>
        <button type="submit">Kirim</button>
    </form>

    <h3>Daftar Tamu</h3>
    <ul id="guestList">
        <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <strong><?= htmlspecialchars($row['email']) ?>:</strong>
                <?= htmlspecialchars($row['message']) ?><br>
                <small><?= $row['timestamp'] ?></small>
            </li>
        <?php endwhile; ?>
    </ul>

    <a href="logout.php">Logout</a>
</div>

<script>
document.getElementById("guestbookForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch("process.php", {
        method: "POST",
        body: formData
    }).then(res => res.json()).then(data => {
        if (data.success) {
            const ul = document.getElementById("guestList");
            const li = document.createElement("li");
            li.innerHTML = `<strong>${data.entry.email}:</strong> ${data.entry.message}<br><small>${data.entry.timestamp}</small>`;
            ul.prepend(li);
            this.reset();
        } else {
            alert("Gagal mengirim pesan.");
        }
    });
});
</script>
</body>
</html>
