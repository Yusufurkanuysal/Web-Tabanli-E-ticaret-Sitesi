<?php

include("baglanti.php");


$email_hata= "";
$parola_hata= "";

if(isset($_POST["giris"])) {


if(empty($_POST["sifre"])) {
  $parola_hata = "Parola Boş Geçilemez.";
} else {
  $parola = $_POST["sifre"];
}

$mailname = $_POST["email"];
$password = $_POST["sifre"]; 

// Veritabanı sorgusu
$secim = "SELECT * FROM kayitol WHERE email = '$mailname'";
$calistir = mysqli_query($baglanti, $secim);
$kayitsayisi = mysqli_num_rows($calistir); // burası 1 ya da 0 olmalıdır.

if($kayitsayisi > 0) {
  $ilgilikayit = mysqli_fetch_assoc($calistir);
  $hashed_password = $ilgilikayit["sifre"];

  if(password_verify($password, $hashed_password)) {
      session_start();
      $_SESSION["sifre"] = $ilgilikayit["sifre"];
      $_SESSION["email"] = $ilgilikayit["email"];
      
      header("location:profile.php");
     
  } else {
      echo '<div class="alert alert-danger" role="alert">
      Parola Yanlış.
      </div>';
  }
} else {
  echo '<div class="alert alert-danger" role="alert">
  E mail Yanlış.
  </div>';
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
    <title>Giriş Yap</title>
  </head>
  <body>

    <!------------------------------------------------- Header ------------------------------------------------------------------------>
  
    <head class="">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Si Bemol</a>
            <button class="navbar-toggler" type="button"  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link " href="kayitol.php">Kayıt Ol</a>
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
    </head>

        <!------------------------------------------------- #Header ------------------------------------------------------------------------>


    
    <div class="container mt-5">
        <div class="container">
            <p class="text-center baslik text-secondary"><strong> Giriş Yap</strong></p>
        </div>
        <hr>
        <form action="girisyap.php" method="post">
            <div class="form-group">
              <input type="email" class="form-control 
                  <?php  if(!empty($email_hata)) {
                        echo "is-invalid";
                      } ?>  
               " placeholder="örnek123@gmail.com" name="email">
              <div id="validationServer03Feedback" class="invalid-feedback">
                  <?php echo $email_hata ?>
              </div>
            </div>
            <div class="form-group">
              <input type="password" class="form-control 
              <?php  if(!empty($parola_hata)) {
                    echo "is-invalid";
                  } ?>     
              " placeholder="Şifrenizi Giriniz." name="sifre">
              <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php echo $parola_hata; ?>
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary" name ="giris">Giriş Yap</button>
          </form>
    </div>
   
  </body>

</html>



