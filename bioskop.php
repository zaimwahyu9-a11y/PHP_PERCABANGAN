<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pemesanan Tiket Bioskop</title>
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #3498db);
            font-family: Arial, sans-serif;
            color: #fff;
            padding: 20px;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.6);
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #27ae60;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        h2, h3 {
            text-align: center;
            color: #f1c40f;
        }
        .result {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pemesanan Tiket Bioskop</h2>
        <form method="POST">
            <label>Nama Pembeli:</label>
            <input type="text" name="nama" required>

            <label>Jenis Film:</label>
            <select name="jenis" required>
                <option value="2D">2D (Rp 40.000)</option>
                <option value="3D">3D (Rp 60.000)</option>
                <option value="IMAX">IMAX (Rp 100.000)</option>
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

            switch ($jenis) {
                case "2D": $harga = 40000; break;
                case "3D": $harga = 60000; break;
                case "IMAX": $harga = 100000; break;
                default: $harga = 0;
            }

            $total = $harga * $jumlah;
            $diskon = 0;

            if ($jumlah >= 5) {
                $diskon = 0.2 * $total;
            } elseif ($jumlah >= 3) {
                $diskon = 0.1 * $total;
            }

            $total_bayar = $total - $diskon;

            echo "<div class='result'>";
            echo "<h3>Struk Pemesanan</h3>";
            echo "Nama: <b>$nama</b><br>";
            echo "Jenis Film: <b>$jenis</b><br>";
            echo "Jumlah Tiket: <b>$jumlah</b><br>";
            echo "Harga per Tiket: Rp " . number_format($harga, 0, ',', '.') . "<br>";
            echo "Subtotal: Rp " . number_format($total, 0, ',', '.') . "<br>";
            echo "Diskon: Rp " . number_format($diskon, 0, ',', '.') . "<br>";
            echo "<strong>Total Bayar: Rp " . number_format($total_bayar, 0, ',', '.') . "</strong>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
