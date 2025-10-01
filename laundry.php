<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Program Layanan Laundry</title>
    <style>
        body {
            background: linear-gradient(to right, #9b59b6, #2980b9);
            font-family: Arial, sans-serif;
            color: #fff;
            padding: 20px;
        }
        .container {
            background-color: rgba(0,0,0,0.75);
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
            background-color: #8e44ad;
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
            color: #f1c40f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Program Layanan Laundry</h2>
        <form method="POST">
            <label>Nama Pelanggan:</label>
            <input type="text" name="nama" required>

            <label>Jenis Layanan:</label>
            <select name="layanan" required>
                <option value="Kiloan">Laundry Kiloan (Rp 7.000/kg)</option>
                <option value="Express">Laundry Express (Rp 10.000/kg)</option>
                <option value="Satuan">Laundry Satuan (Rp 5.000/pcs)</option>
            </select>

            <label>Jumlah (kg/pcs):</label>
            <input type="number" name="jumlah" min="1" required>

            <input type="submit" value="Proses Laundry">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = $_POST['nama'];
            $layanan = $_POST['layanan'];
            $jumlah = (int) $_POST['jumlah'];

            // Tarif per jenis layanan
            if ($layanan == "Kiloan") {
                $tarif = 7000;
            } elseif ($layanan == "Express") {
                $tarif = 10000;
            } elseif ($layanan == "Satuan") {
                $tarif = 5000;
            } else {
                $tarif = 0;
            }

            $total = $tarif * $jumlah;
            $diskon = 0;

            // Hanya laundry kiloan dan express dapat diskon
            if ($layanan != "Satuan") {
                if ($jumlah >= 10) {
                    $diskon = 0.2 * $total;
                } elseif ($jumlah >= 5) {
                    $diskon = 0.1 * $total;
                }
            }

            $total_bayar = $total - $diskon;

            echo "<div class='result'>";
            echo "<h3>Struk Laundry</h3>";
            echo "Nama Pelanggan: <b>$nama</b><br>";
            echo "Jenis Layanan: $layanan<br>";
            echo "Jumlah: $jumlah " . ($layanan == "Satuan" ? "pcs" : "kg") . "<br>";
            echo "Tarif per " . ($layanan == "Satuan" ? "pcs" : "kg") . ": Rp " . number_format($tarif, 0, ',', '.') . "<br>";
            echo "Subtotal: Rp " . number_format($total, 0, ',', '.') . "<br>";
            echo "Diskon: Rp " . number_format($diskon, 0, ',', '.') . "<br>";
            echo "<b>Total Bayar: Rp " . number_format($total_bayar, 0, ',', '.') . "</b>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
