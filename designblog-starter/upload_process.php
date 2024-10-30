<?php
$conn = new mysqli('localhost', 'username', 'password', 'database');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $image = $_FILES['image'];

    // Cek jika file diunggah
    if ($image['name']) {
        $targetDir = "uploads/"; // Folder penyimpanan
        $imageName = time() . '_' . basename($image['name']); // Nama unik
        $targetFilePath = $targetDir . $imageName;

        // Pindahkan file ke folder target
        if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            // Simpan data ke database, termasuk nama gambar
            $sql = "INSERT INTO articles (category_id, title, content, image) VALUES ('$category_id', '$title', '$content', '$imageName')";
            if ($conn->query($sql) === TRUE) {
                echo "Artikel berhasil disimpan!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Gagal mengunggah gambar.";
        }
    } else {
        echo "Silakan unggah gambar.";
    }
}

$conn->close();
?>
    