<?php
include("baglanti.php");

$sql = "SELECT * FROM kayitol";
$sonuc = mysqli_query($baglanti, $sql);

mysqli_close($baglanti);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Admin Paneli</title>
</head>
<body>

<h3 class="text-center mt-5"><strong>Hoşgeldin Patron</strong></h3>

<div class="container mt-5">
    <h4><strong>Kayıt Olan Kişiler :</strong></h4>
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">İsim</th>
            <th scope="col">Soyisim</th>
            <th scope="col">Email</th>
            <th scope="col">Telefon</th>
            <th scope="col">Şifre</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include("baglanti.php");

        $sql = "SELECT * FROM kayitol";
        $sonuc = mysqli_query($baglanti, $sql);

        if (mysqli_num_rows($sonuc) > 0) {
            while($sıra = mysqli_fetch_assoc($sonuc)) {
                echo "<tr>";
                echo "<th scope='row'>" . $sıra['id'] . "</th>";
                echo "<td>" . $sıra['ad'] . "</td>";
                echo "<td>" . $sıra['soyad'] . "</td>";
                echo "<td>" . $sıra['email'] . "</td>";
                echo "<td>" . $sıra['telefon'] . "</td>";
                echo "<td>" . $sıra['sifre'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tabloda hiç kayıt yok.</td></tr>";
        }

        mysqli_close($baglanti);
        ?>
        </tbody>
    </table>

    <hr>
    <h4 class="mt-5"><strong>Sipariş Verilen Ürünler</strong></h4>
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Ürün Resmi</th>
            <th scope="col">Ürün Adı</th>
            <th scope="col">Ürün Açıklama</th>
            <th scope="col">Ürün Fiyatı</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include("baglanti.php");

        $sql = "SELECT * FROM sepet";
        $sonuc = mysqli_query($baglanti, $sql);

        if (mysqli_num_rows($sonuc) > 0) {
            while($sıra = mysqli_fetch_assoc($sonuc)) {
                echo "<tr>";
                echo "<th scope='row'>" . $sıra['id'] . "</th>";
                echo "<td>" . $sıra['ürün_resmi'] . "</td>";
                echo "<td>" . $sıra['ürün_adi'] . "</td>";
                echo "<td>" . $sıra['ürün_aciklama'] . "</td>";
                echo "<td>" . $sıra['ürün_fiyati']. " TL</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tabloda hiç kayıt yok.</td></tr>";
        }

        mysqli_close($baglanti);
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
