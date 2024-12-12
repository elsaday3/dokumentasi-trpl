
<?php
// index.php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Online</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<style>
    /* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    display: flex;
    font-family: Arial, sans-serif;
    height: 100vh;
    background-color: #f4f4f4;
}

/* Sidebar Styling */
.sidebar {
    width: 200px;
    background-color: #2c3e50;
    color: white;
    height: 100%;
    padding: 20px 0;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
}

.sidebar ul {
    list-style-type: none;
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

/* Content Styling */
.content {
    flex-grow: 1;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

</style>
<body>
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
    <div class="content">
        <?php
        // Menyertakan file halaman sesuai pilihan menu
        switch ($page) {
            case 'dasbor':
                include 'dasbor.php';
                break;
            case 'transaksi':
                include 'transaksi.php';
                break;
            case 'laporan':
                include 'laporan.php';
                break;
            case 'paket';
            include 'paket';
            break;
        }
        ?>
    </div>
</body>
</html>
