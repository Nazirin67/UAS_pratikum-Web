<!-- add_table.php -->
<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'article', '', 'designblog-starter');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table_name = $conn->real_escape_string($_POST['table_name']);
    $description = $conn->real_escape_string($_POST['description']);
    
    $sql = "INSERT INTO tables (table_name, description) VALUES ('$table_name', '$description')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: manage_table.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tabel</title>
</head>
<body>
    <h1>Tambah Tabel Baru</h1>
    <form method="POST">
        <label for="table_name">Nama Tabel:</label>
        <input type="text" name="table_name" required><br>

        <label for="description">Deskripsi:</label>
        <textarea name="description" required></textarea><br>

        <input type="submit" value="Simpan">
    </form>
</body>
</html>
