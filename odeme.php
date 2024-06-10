<?php
require_once "baglanti.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kart_isim = $_POST['kart_isim'];
    $kart_numarasi = $_POST['kart_numarası'];
    $son_kullanma = $_POST['skt'];
    $cvv = $_POST['cvv'];

    $sql = "INSERT INTO ödeme_bilgi (kart_isim, kart_numarası, skt, cvv)
     VALUES ('$kart_isim', '$kart_numarasi', '$son_kullanma', '$cvv')";

    if(mysqli_query($baglanti, $sql)){
        echo '<div class="alert alert-success" role="alert">
        Ödeme Bilgileri Başarıyla Kaydedildi. Siparişiniz Kargoaya Verilmek Üzere Hazırlanıyor
      </div>';
    } else{
        echo "Hata: " . mysqli_error($baglanti);
    }

    mysqli_close($baglanti);
}
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Ödeme Bilgileri</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Si Bemol</a>
        <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Anasayfa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ürünler.php">Ürünler</a>
                </li>
                <li class="nav-item kayit">
                    <a class="nav-link" href="kayitol.php">Kayıt Ol</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="girisyap.php">Giriş Yap</a>
                </li>
                <li class="nav-item sepetim">
                    <a class="nav-link" href="sepet.php"><img src="resim/sepet.png" alt=""></a>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="container">
            <h2 class="text-center mt-5">Ödeme Bilgileri</h2>
            <hr>
            <form action="odeme.php" method="POST">
                <div class="form-group">
                    <label for="kart_isim">Kart Üzerindeki İsim</label>
                    <input type="text" class="form-control" id="kart_isim" name="kart_isim" required>
                </div>
                <div class="form-group">
                    <label for="kart_numarası">Kart Numarası</label>
                    <input type="text" class="form-control" id="kart_numarası" name="kart_numarası" required>
                </div>
                <div class="form-group">
                    <label for="son_kullanma">Son Kullanma Tarihi</label>
                    <input type="text" class="form-control" id="skt" name="skt" placeholder="MM/YY" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" required>
                </div>
                <button type="submit" class="btn btn-primary" name="ödemetamamla">Ödemeyi Tamamla</button>
            </form>
        </div>
    </main>
</body>
</html>
