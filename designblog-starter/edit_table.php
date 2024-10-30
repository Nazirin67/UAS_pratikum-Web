<?php
// Koneksi database
$conn = new mysqli('localhost', 'article', '', 'designblog-starter');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data artikel
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM articles WHERE id = $id";
    $result = $conn->query($sql);
    $article = $result->fetch_assoc();
}

// Proses pembaruan data artikel dan unggah gambar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = intval($_POST['category_id']);
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $image = $_FILES['image'];

    // Cek jika ada file yang diunggah
    if ($image['name']) {
        $imageName = time() . '_' . basename($image['name']); // Nama unik untuk gambar
        $targetDirectory = 'uploads/'; // Direktori penyimpanan gambar
        $targetFile = $targetDirectory . $imageName;

        // Pindahkan file gambar ke folder target
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            // Perbarui data artikel termasuk gambar
            $update_sql = "UPDATE articles SET category_id = $category_id, title = '$title', content = '$content', image = '$imageName' WHERE id = $id";
        } else {
            echo "Gagal mengunggah gambar.";
            exit;
        }
    } else {
        // Jika tidak ada gambar yang diunggah, hanya perbarui data lain
        $update_sql = "UPDATE articles SET category_id = $category_id, title = '$title', content = '$content' WHERE id = $id";
    }

    // Eksekusi query
    if ($conn->query($update_sql) === TRUE) {
        header("Location: index.php"); // Redirect setelah pembaruan berhasil
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>


<form action="upload_process.php" method="POST" enctype="multipart/form-data">
    <label for="category_id">Category ID:</label>
    <input type="number" name="category_id" required><br>

    <label for="title">Title:</label>
    <input type="text" name="title" required><br>

    <label for="content">Content:</label>
    <textarea name="content" required></textarea><br>

    <label for="image">Upload Image:</label>
    <input type="file" name="image" accept="image/*"><br>

    <input type="submit" value="Submit">
</form>
