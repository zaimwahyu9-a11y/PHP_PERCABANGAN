<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pemesanan Makanan Restoran</title>
    <style>
        body {
            background: linear-gradient(to right, #8e44ad, #3498db);
            font-family: Arial, sans-serif;
            color: #fff;
            padding: 20px;
        }
        .container {
            background-color: rgba(0,0,0,0.6);
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }
        input[type="submit"] {
            background-color: #27ae60;
            color: white;
            cursor: pointer;
        }
        .result {
            margin-top: 20px;
            background-color: rgba(255,255,255,0.1);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pemesanan Makanan Restoran</h2>
        <form method="POST">
            <label>Nama Pelanggan:</label>
            <input type="text" name="nama" required>

            <label>Menu Makanan:</label>
            <select name="menu" required>
                <option value="Nasi Goreng">Nasi Goreng (Rp 20.000)</option>
                <option value="Mie Ayam">Mie Ayam (Rp 15.000)</option>
                <option value="Soto">Soto (Rp 18.000)</option>
                <option value="Bakso">Bakso (Rp 12.000)</option>
            </select>

            <label>Jumlah Porsi:</label>
            <input type="number" name="porsi" min="1" required>

            <input type="submit" value="Pesan Sekarang">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = $_POST['nama'];
            $menu = $_POST['menu'];
            $porsi = $_POST['porsi'];

            $harga_menu = [
                "Nasi Goreng" => 20000,
                "Mie Ayam" => 15000,
                "Soto" => 18000,
                "Bakso" => 12000
            ];

            $harga = $harga_menu[$menu];
            $total = $harga * $porsi;
            $diskon = 0;

            if ($porsi >= 10) {
                $diskon = 0.25 * $total;
            } elseif ($porsi >= 5) {
                $diskon = 0.15 * $total;
            }

            $total_bayar = $total - $diskon;

            echo "<div class='result'>";
            echo "<h3>Nota Pembelian</h3>";
            echo "Nama: <b>$nama</b><br>";
            echo "Menu: $menu<br>";
            echo "Jumlah Porsi: $porsi<br>";
            echo "Harga per Porsi: Rp " . number_format($harga, 0, ',', '.') . "<br>";
            echo "Subtotal: Rp " . number_format($total, 0, ',', '.') . "<br>";
            echo "Diskon: Rp " . number_format($diskon, 0, ',', '.') . "<br>";
            echo "<b>Total Bayar: Rp " . number_format($total_bayar, 0, ',', '.') . "</b>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
