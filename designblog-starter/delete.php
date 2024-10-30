<?php
// Database connection
$conn = new mysqli('localhost', 'articles', '', 'designblog-starter'); // Memastikan password kosong

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete the article
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM articles WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect to dashboard after deletion
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
