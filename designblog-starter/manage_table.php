<!-- manage_table.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tabel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            margin-left: 250px; /* Offset to leave space for sidebar */
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 6px 12px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            margin-right: 5px;
        }
        .btn-add {
            background-color: #4CAF50;
            margin-bottom: 10px;
        }
        .btn-edit {
            background-color: #4CAF50;
        }
        .btn-delete {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <h1>Kelola Tabel</h1>
    <a href="add_table.php" class="btn btn-add">Tambah Tabel</a> <!-- Button untuk menambah tabel baru -->

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Tabel</th>
                <th>Deskripsi</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Contoh data; ganti dengan data dari database -->
            <tr>
                <td>1</td>
                <td>Kategori Artikel</td>
                <td>Daftar kategori untuk artikel</td>
                <td>
                    <a href="edit_table.php?id=1" class="btn btn-edit">Edit</a>
                    <a href="delete_table.php?id=1" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus tabel ini?');">Delete</a>
                </td>
            </tr>
            <!-- Tambahkan lebih banyak baris dari database sesuai kebutuhan -->
        </tbody>
    </table>
</body>
</html>
