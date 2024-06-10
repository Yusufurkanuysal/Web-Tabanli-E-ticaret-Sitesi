<?php
session_start();
$email = "";
$sifre = "";

if(isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
    $sifre = $_SESSION["sifre"];
}

// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$database = "proje";

// Bağlantı oluştur
$bagla = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol et
if ($bagla->connect_error) {
  die("Veritabanına bağlanılamadı: " . $bagla->connect_error);
}

$sql = "SELECT * FROM kayitol WHERE email='$email'";
$sonuc = $bagla->query($sql);

if ($sonuc->num_rows > 0) {
  // Satır satır sonuçları al
  while($sıra = $sonuc->fetch_assoc()) {
    $ad = $sıra["ad"];
    $soyad = $sıra["soyad"];
    $telefon = $sıra["telefon"];
    $sifre = $sıra["sifre"];
  }
} else {
  echo "Veritabanında kayıt bulunamadı";
}
$bagla->close();
?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Profil</title>
  </head>
  <body>

    <div class="container">
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Başarılı Giriş</h1>
          <p class="lead">Profilinize Hoşgeldiniz.</p>
          <?php if(isset($_SESSION["email"])): ?>
            <table class="table">
              <tbody>
                <tr>
                  <th scope="row">Ad:</th>
                  <td><?php echo $ad; ?></td>
                </tr>
                <tr>
                  <th scope="row">Soyad:</th>
                  <td><?php echo $soyad; ?></td>
                </tr>
                <tr>
                  <th scope="row">Telefon:</th>
                  <td><?php echo $telefon; ?></td>
                </tr>
                <tr>
                  <th scope="row">Şifre:</th>
                  <td><?php echo $sifre; ?></td>
                </tr>
              </tbody>
            </table>

            













            <a href="cikis.php" class="btn btn-danger">ÇIKIŞ YAP</a>
          <?php else: ?>
            <p class="text-danger">Bu sayfayı görüntüleme yetkiniz yoktur.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </body>
</html>
