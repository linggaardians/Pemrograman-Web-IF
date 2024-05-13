<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

include("connection.php");

$arr_month = [
    "1" => "Januari",
    "2" => "Februari",
    "3" => "Maret",
    "4" => "April",
    "5" => "Mei",
    "6" => "Juni",
    "7" => "Juli",
    "8" => "Agustus",
    "9" => "September",
    "10" => "Oktober",
    "11" => "Nopember",
    "12" => "Desember"
];

if (isset($_POST["submit"])) {
    $nim = htmlentities(strip_tags(trim($_POST["nim"])));
    $name = htmlentities(strip_tags(trim($_POST["name"])));
    $birth_city = htmlentities(strip_tags(trim($_POST["birth_city"])));
    $faculty = htmlentities(strip_tags(trim($_POST["faculty"])));
    $department = htmlentities(strip_tags(trim($_POST["department"])));
    $gpa = htmlentities(strip_tags(trim($_POST["gpa"])));
    $birth_date = htmlentities(strip_tags(trim($_POST["birth_date"])));
    $birth_month = htmlentities(strip_tags(trim($_POST["birth_month"])));
    $birth_year = htmlentities(strip_tags(trim($_POST["birth_year"])));

    $birth_date_full = $birth_year . "-" . $birth_month . "-" . $birth_date;
    $query = "UPDATE student SET name='$name', birth_city='$birth_city', faculty='$faculty', department='$department', gpa=$gpa, birth_date='$birth_date_full' WHERE nim='$nim'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $message = "Data mahasiswa dengan NIM $nim telah berhasil diperbarui";
        $message = urlencode($message);
        header("Location: student_view.php?message={$message}");
    } else {
        $error_message = "Gagal memperbarui data mahasiswa";
    }
} else {
    if (isset($_GET["nim"])) {
        $nim = mysqli_real_escape_string($connection, $_GET["nim"]);

        $query = "SELECT * FROM student WHERE nim='$nim'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $data = mysqli_fetch_assoc($result);

            $name = $data["name"];
            $birth_city = $data["birth_city"];
            $faculty = $data["faculty"];
            $department = $data["department"];
            $gpa = $data["gpa"];
            $birth_date = date("d", strtotime($data["birth_date"]));
            $birth_month = date("m", strtotime($data["birth_date"]));
            $birth_year = date("Y", strtotime($data["birth_date"]));
        } else {
            $error_message = "Data mahasiswa tidak ditemukan";
        }
    } else {
        $error_message = "NIM tidak ditemukan";
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Mahasiswa</title>
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div id="header">
        <h1 id="logo">Edit Data Mahasiswa</h1>
    </div>
    <hr>
    <nav>
        <ul>
            <li><a href="student_view.php">Tampil</a></li>
            <li><a href="student_add.php">Tambah</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <h2>Edit Data Mahasiswa</h2>
    <?php if (isset($error_message)) {
        echo "<div class='error'>$error_message</div>";
    } ?>
    <form id="form_mahasiswa" action="student_edit.php" method="post">
        <input type="hidden" name="nim" value="<?php echo $nim; ?>">
        <fieldset>
            <legend>Data Mahasiswa</legend>
            <p>
                <label for="name">Nama :</label>
                <input type="text" name="name" id="name" value="<?php echo $name; ?>">
            </p>
            <p>
                <label for="birth_city">Tempat Lahir :</label>
                <input type="text" name="birth_city" id="birth_city" value="<?php echo $birth_city; ?>">
            </p>
            <p>
                <label for="birth_date">Tanggal Lahir :</label>
                <select name="birth_date" id="birth_date">
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        if ($i == $birth_date) {
                            echo "<option value='$i' selected>";
                        } else {
                            echo "<option value='$i'>";
                        }
                        echo str_pad($i, 2, "0", STR_PAD_LEFT);
                        echo "</option>";
                    }
                    ?>
                </select>
                <select name="birth_month">
                    <?php
                    foreach ($arr_month as $key => $value) {
                        if ($key == $birth_month) {
                            echo "<option value='$key' selected>$value</option>";
                        } else {
                            echo "<option value='$key'>$value</option>";
                        }
                    }
                    ?>
                </select>
                <select name="birth_year">
                    <?php
                    for ($i = 1990; $i <= 2005; $i++) {
                        if ($i == $birth_year) {
                            echo "<option value='$i' selected>$i</option>";
                        } else {
                            echo "<option value='$i'>$i</option>";
                        }
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="faculty">Fakultas :</label>
                <select name="faculty" id="faculty">
                    <option value="FTIB" <?php if ($faculty == 'FTIB') echo 'selected'; ?>>FTIB</option>
                    <option value="FTEIC" <?php if ($faculty == 'FTEIC') echo 'selected'; ?>>FTEIC</option>
                </select>
            </p>
            <p>
                <label for="department">Jurusan :</label>
                <input type="text" name="department" id="department" value="<?php echo $department; ?>">
            </p>
            <p>
                <label for="gpa">IPK :</label>
                <input type="text" name="gpa" id="gpa" value="<?php echo $gpa; ?>">
            </p>
        </fieldset>
        <br>
        <p>
            <input type="submit" name="submit" value="Simpan Perubahan">
        </p>
    </form>
</div>
</body>
</html>