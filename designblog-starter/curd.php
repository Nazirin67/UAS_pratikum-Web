<?php
// Konfigurasi koneksi ke database
$host = "localhost";
$username = "article"; // ganti sesuai username database Anda
$password = ""; // ganti sesuai password database Anda
$dbname = "designblog-starter";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menambah data
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO items (name, description) VALUES ('$name', '$description')";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menghapus data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM items WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Mengupdate data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "UPDATE items SET name='$name', description='$description' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Menampilkan data
$result = $conn->query("SELECT * FROM items");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Sederhana</title>
</head>
<body>
    <h2>CRUD Sederhana</h2>

    <!-- Form Tambah Data -->
    <form action="crud.php" method="POST">
        <input type="text" name="name" placeholder="Nama" required>
        <input type="text" name="description" placeholder="Deskripsi" required>
        <button type="submit" name="add">Tambah</button>
    </form>

    <!-- Menampilkan Data -->
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['description'] ?></td>
            <td>
                <a href="crud.php?edit=<?= $row['id'] ?>">Edit</a>
                <a href="crud.php?delete=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Form Edit Data -->
    <?php if (isset($_GET['edit'])):
        $id = $_GET['edit'];
        $editResult = $conn->query("SELECT * FROM items WHERE id=$id");
        $row = $editResult->fetch_assoc();
    ?>
    <form action="crud.php" method="POST">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <input type="text" name="name" value="<?= $row['name'] ?>" required>
        <input type="text" name="description" value="<?= $row['description'] ?>" required>
        <button type="submit" name="update">Perbarui</button>
    </form>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>
</html>
