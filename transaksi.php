<?php
include('db.php');

// Ambil data transaksi dari database
$query = "SELECT * FROM transaksi";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            display: flex;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 200px;
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding-left: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
        }

        .sidebar ul li a:hover {
            background-color: #2980b9;
        }

        /* Main Content Styling */
        .content {
            width: 100%;
            margin-left: 0px;
            padding: 20px;
        }

        .container {
            width: 100%;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
       
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th, table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #f0f0f0;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn-add {
            display: inline-block;
            padding: 8px 12px;
            margin: 10px 0;
            color: #fff;
            background-color: #28a745;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-edit, .btn-delete {
            padding: 5px 10px;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-edit {
            background-color: #ffc107;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .note {
            margin-top: 20px;
            font-size: 14px;
        }

        .status-table td {
            padding: 5px;
        }

        .label-open {
            color: #28a745;
            font-weight: bold;
        }

        .label-process {
            color: #ffc107;
            font-weight: bold;
        }

        .label-closed {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>LAUNDRI ONLINE</h2>
        <ul>
            <li><a href="dasbor.php?page=home">Home</a></li>
            <li><a href="paket.php?page=laporan">Paket</a></li>
            <li><a href="transaksi.php?page=transaksi">Transaksi</a></li>
            <li><a href="laporan.php?page=laporan">Laporan</a></li>
            <li><a href="logout.php?page=laporan">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container">
            <h1>Data Transaksi</h1>
            <a href="tambah_transaksi.php" class="btn-add">+ Tambah Data</a>
            
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Masuk</th>
                        <th>No Transaksi</th>
                        <th>Nama_Konsumen</th>
                        <th>Paket</th>
                        <th>Berat (KG)</th>
                        <th>Harga/KG</th>
                        <th>Tanggal Ambil</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Menentukan status label
                        $status_label = '';
                        if (isset($row['status']) && $row['status'] == 'Open') {
                            $status_label = "<span class='label-open'>Open</span>";
                        } elseif (isset($row['status']) && $row['status'] == 'On Proses') {
                            $status_label = "<span class='label-process'>On Proses</span>";
                        } elseif (isset($row['status']) && $row['status'] == 'Closed') {
                            $status_label = "<span class='label-closed'>Closed</span>";
                        }

                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . (isset($row['tanggal_masuk']) ? $row['tanggal_masuk'] : '-') . "</td>";
                        echo "<td>" . (isset($row['no_transaksi']) ? $row['no_transaksi'] : '-') . "</td>";
                        echo "<td>" . (isset($row['nama_konsumen']) ? $row['nama_konsumen'] : '-') . "</td>";
                        echo "<td>" . (isset($row['paket']) ? $row['paket'] : '-') . "</td>";
                        echo "<td>" . (isset($row['berat']) ? $row['berat'] : '-') . "</td>";
                        echo "<td>Rp. " . (isset($row['harga_per_kg']) ? number_format($row['harga_per_kg'], 0, ',', '.') : '-') . "</td>";
                        echo "<td>" . (isset($row['tanggal_ambil']) ? $row['tanggal_ambil'] : '-') . "</td>";
                        echo "<td>" . $status_label . "</td>";
                        echo "<td>
                          <a href='edit_transaksi.php?id={$row['id']}' class='btn-edit'>✏️</a>
                    <a href='delete_transaksi.php?id={$row['id']}' class='btn-delete' onclick=\"return confirm('Hapus data ini?');\">✖</a>
                  </td>";
            echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            
            <!-- Keterangan Status -->
            <div class="note">
                <h4>Keterangan Status:</h4>
                <table class="status-table">
                    <tr>
                        <td><span class="label-open">Open</span></td>
                        <td>: Barang belum diproses</td>
                    </tr>
                    <tr>
                        <td><span class="label-process">On Proses</span></td>
                        <td>: Barang dalam proses</td>
                    </tr>
                    <tr>
                        <td><span class="label-closed">Closed</span></td>
                        <td>: Barang sudah diambil</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
