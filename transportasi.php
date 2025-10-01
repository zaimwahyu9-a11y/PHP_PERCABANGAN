<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pemesanan Tiket Transportasi</title>
    <style>
        body {
            background: linear-gradient(to right, #34495e, #2ecc71);
            font-family: Arial, sans-serif;
            color: #fff;
            padding: 20px;
        }
        .container {
            background-color: rgba(0,0,0,0.7);
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
        h2, h3 {
            text-align: center;
            color: #f39c12;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pemesanan Tiket Transportasi</h2>
        <form method="POST">
            <label>Nama Penumpang:</label>
            <input type="text" name="nama" required>

            <label>Jenis Transportasi:</label>
            <select name="jenis" required>
                <option value="Kereta">Kereta (Rp 75.000)</option>
                <option value="Pesawat">Pesawat (Rp 300.000)</option>
                <option value="Kapal">Kapal (Rp 120.000)</option>
                <option value="Bus">Bus (Rp 50.000)</option>
            </select>

            <label>Jumlah Tiket:</label>
            <input type="number" name="jumlah" min="1" required>

            <input type="submit" value="Pesan Tiket">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = $_POST['nama'];
            $jenis = $_POST['jenis'];
            $jumlah = (int) $_POST['jumlah'];

            // Harga tiket berdasarkan jenis
            if ($jenis == "Kereta") $harga = 75000;
            elseif ($jenis == "Pesawat") $harga = 300000;
            elseif ($jenis == "Kapal") $harga = 120000;
            elseif ($jenis == "Bus") $harga = 50000;
            else $harga = 0;

            $total = $harga * $jumlah;
            $diskon = 0;

            if ($jumlah >= 3) {
                $diskon = 0.15 * $total;
            }

            $total_bayar = $total - $diskon;

            echo "<div class='result'>";
            echo "<h3>Tiket Perjalanan</h3>";
            echo "Nama: <b>$nama</b><br>";
            echo "Jenis Transportasi: $jenis<br>";
            echo "Jumlah Tiket: $jumlah<br>";
            echo "Harga per Tiket: Rp " . number_format($harga, 0, ',', '.') . "<br>";
            echo "Subtotal: Rp " . number_format($total, 0, ',', '.') . "<br>";
            echo "Diskon: Rp " . number_format($diskon, 0, ',', '.') . "<br>";
            echo "<b>Total Bayar: Rp " . number_format($total_bayar, 0, ',', '.') . "</b>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
