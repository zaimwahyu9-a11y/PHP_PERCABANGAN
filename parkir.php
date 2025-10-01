<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Program Parkir Kendaraan</title>
    <style>
        body {
            background: linear-gradient(to right, #1abc9c, #2c3e50);
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
            background-color: #16a085;
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
        <h2>Program Parkir Kendaraan</h2>
        <form method="POST">
            <label>Plat Nomor Kendaraan:</label>
            <input type="text" name="plat" required>

            <label>Jenis Kendaraan:</label>
            <select name="jenis" required>
                <option value="Motor">Motor (Rp 2.000/jam)</option>
                <option value="Mobil">Mobil (Rp 5.000/jam)</option>
                <option value="Bus">Bus (Rp 10.000/jam)</option>
            </select>

            <label>Lama Parkir (jam):</label>
            <input type="number" name="lama" min="1" required>

            <input type="submit" value="Hitung Biaya Parkir">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $plat = $_POST['plat'];
            $jenis = $_POST['jenis'];
            $lama = (int) $_POST['lama'];

            // Tarif per jam
            switch ($jenis) {
                case "Motor": $tarif = 2000; break;
                case "Mobil": $tarif = 5000; break;
                case "Bus": $tarif = 10000; break;
                default: $tarif = 0;
            }

            $total = $tarif * $lama;
            $diskon = 0;

            if ($lama > 10) {
                $diskon = 0.1 * $total;
            }

            $total_bayar = $total - $diskon;

            echo "<div class='result'>";
            echo "<h3>Karcis Parkir</h3>";
            echo "Plat Nomor: <b>$plat</b><br>";
            echo "Jenis Kendaraan: $jenis<br>";
            echo "Lama Parkir: $lama jam<br>";
            echo "Tarif per Jam: Rp " . number_format($tarif, 0, ',', '.') . "<br>";
            echo "Subtotal: Rp " . number_format($total, 0, ',', '.') . "<br>";
            echo "Diskon: Rp " . number_format($diskon, 0, ',', '.') . "<br>";
            echo "<b>Total Bayar: Rp " . number_format($total_bayar, 0, ',', '.') . "</b>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
