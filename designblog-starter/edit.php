<?php
// Koneksi database
$conn = new mysqli('localhost', 'articles', '', 'designblog-starter'); // Pastikan password kosong

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data artikel
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM articles WHERE id = ?";
    
    // Menggunakan prepared statement untuk menghindari SQL Injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // Binding parameter
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();
    $stmt->close(); // Menutup statement setelah selesai
}

// Memperbarui data artikel
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = intval($_POST['category_id']);
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    
    $update_sql = "UPDATE articles SET category_id = ?, title = ?, content = ? WHERE id = ?";
    
    // Menggunakan prepared statement untuk update
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("issi", $category_id, $title, $content, $id); // Binding parameter
    if ($update_stmt->execute()) {
        header("Location: index.php"); // Redirect ke dashboard setelah pembaruan
        exit;
    } else {
        echo "Error updating record: " . $update_stmt->error;
    }
    $update_stmt->close(); // Menutup statement setelah selesai
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
</head>
<body>
    <h1>Edit Article</h1>
    <form method="POST">
        <label for="category_id">Category ID:</label>
        <input type="number" name="category_id" value="<?php echo htmlspecialchars($article['category_id']); ?>" required><br>

        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required><br>

        <label for="content">Content:</label>
        <textarea name="content" required><?php echo htmlspecialchars($article['content']); ?></textarea><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
