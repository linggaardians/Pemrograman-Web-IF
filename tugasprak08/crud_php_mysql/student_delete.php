<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

include("connection.php");

if (isset($_GET["nim"])) {
    $nim = mysqli_real_escape_string($connection, $_GET["nim"]);
    $query = "DELETE FROM student WHERE nim='$nim'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $message = "Data mahasiswa dengan NIM $nim telah berhasil dihapus";
        $message = urlencode($message);
        header("Location: student_view.php?message={$message}");
    } else {
        $error_message = "Gagal menghapus data mahasiswa";
    }
} else {
    $error_message = "NIM tidak ditemukan";
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Data Mahasiswa</title>
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div id="header">
        <h1 id="logo">Hapus Data Mahasiswa</h1>
    </div>
    <hr>
    <nav>
        <ul>
            <li><a href="student_view.php">Tampil</a></li>
            <li><a href="student_add.php">Tambah</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <h2>Hapus Data Mahasiswa</h2>
    <?php if (isset($error_message)) {
        echo "<div class='error'>$error_message</div>";
    } ?>
</div>
</body>
</html>