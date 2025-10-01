<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sewa Lapangan Olahraga</title>
    <style>
        body {
            background: linear-gradient(to right, #e67e22, #2c3e50);
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
            background-color: #d35400;
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
        <h2>Sewa Lapangan Olahraga</h2>
        <form method="POST">
            <label>Nama Penyewa:</label>
            <input type="text" name="nama" required>

            <label>Jenis Lapangan:</label>
            <select name="lapangan" required>
                <option value="Futsal">Futsal (Rp 100.000/jam)</option>
                <option value="Basket">Basket (Rp 80.000/jam)</option>
                <option value="Badminton">Badminton (Rp 50.000/jam)</option>
            </select>

            <label>Lama Sewa (jam):</label>
            <input type="number" name="lama" min="1" required>

            <input type="submit" value="Hitung Biaya Sewa">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = $_POST['nama'];
            $lapangan = $_POST['lapangan'];
            $lama = (int) $_POST['lama'];

            // Tarif per jam
            if ($lapangan == "Futsal") $tarif = 100000;
            elseif ($lapangan == "Basket") $tarif = 80000;
            elseif ($lapangan == "Badminton") $tarif = 50000;
            else $tarif = 0;

            $total = $tarif * $lama;
            $diskon = 0;

            if ($lama >= 5) {
                $diskon = 0.2 * $total;
            } elseif ($lama >= 3) {
                $diskon = 0.1 * $total;
            }

            $total_bayar = $total - $diskon;

            echo "<div class='result'>";
            echo "<h3>Nota Sewa Lapangan</h3>";
            echo "Nama Penyewa: <b>$nama</b><br>";
            echo "Jenis Lapangan: $lapangan<br>";
            echo "Lama Sewa: $lama jam<br>";
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
