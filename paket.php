<?php
include('db.php');

// Ambil data paket dari database
$query = "SELECT id, kode_paket, nama_paket, harga_paket FROM paket"; // Pastikan kolom 'id' ada di sini
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil
if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Paket</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Layout: Sidebar dan Main Content */
        body {
            display: flex;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            color: white;
            padding-left: 20px;
        }

        .sidebar h2 {
            text-align: center;
            color: white;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            margin: 8px 0;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        /* Konten utama */
        .container {
            margin-left: 270px; /* Menambahkan margin untuk memberi ruang pada sidebar */
            padding: 20px;
            background: #f4f4f4;
            width: calc(100% - 270px); /* Mengatur lebar konten utama */
        }

        /* Header */
        h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        /* Button Styling */
        .btn-add {
            display: inline-block;
            padding: 8px 12px;
            margin-bottom: 10px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-add:hover {
            background: #0056b3;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background: #007bff;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Action Buttons */
        .btn-edit, .btn-delete {
            text-decoration: none;
            font-size: 18px;
            margin: 0 5px;
        }

        .btn-edit {
            color: #28a745;
        }

        .btn-delete {
            color: #dc3545;
        }

        .btn-edit:hover, .btn-delete:hover {
            opacity: 0.8;
        }

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Laundry Express</h2>
        <a href="home.php">home</a>
        <a href="paket.php">Paket</a>
        <a href="transaksi.php">Transaksi</a>
        <a href="laporan.php">Laporan</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Konten Utama -->
    <div class="container">
        <h1>Data Paket</h1>
        <a href="tambah_paket.php" class="btn-add">+ Tambah Paket</a>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Paket</th>
                    <th>Nama Paket</th>
                    <th>Harga Paket</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            // Pastikan 'id' ada di sini
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['kode_paket'] . "</td>";
            echo "<td>" . $row['nama_paket'] . "</td>";
            echo "<td>" . number_format($row['harga_paket'], 0, ',', '.') . "</td>";
            echo "<td>
                    <a href='edit_paket.php?id={$row['id']}' class='btn-edit'>✏️</a>
                    <a href='delete_paket.php?id={$row['id']}' class='btn-delete' onclick=\"return confirm('Hapus data ini?');\">✖</a>
                  </td>";
            echo "</tr>";
        }
        ?>
            </tbody>
        </table>
    </div>

</body>
</html>
