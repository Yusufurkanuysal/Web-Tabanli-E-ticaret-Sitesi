<?php

include("baglanti.php");

$username_hata = "";
$soyad_hata = "";
$email_hata = "";
$parola_hata = "";
$tel_hata = "";
$parolatkr_hata = "";

if (isset($_POST["kaydet"])) {
    $gizli_error = false;

    if (empty($_POST["isim"])) {
        $username_hata = "İsim alanı boş geçilemez.";
        $gizli_error = true;
    } elseif (strlen($_POST["isim"]) < 3) {
        $username_hata = "İsim en az 3 karakterden oluşmalıdır.";
        $gizli_error = true;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["isim"])) {
        $username_hata = "Hatalı isim";
        $gizli_error = true;
    } else {
        $username = $_POST["isim"];
    }

    if (empty($_POST["soyisim"])) {
        $soyad_hata = "Bu alan boş geçilemez.";
        $gizli_error = true;
    } else {
        $surname = $_POST["soyisim"];
    }

    if (empty($_POST["email"])) {
        $email_hata = "Email alanı boş geçilemez.";
        $gizli_error = true;
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_hata = "Hatalı e-mail";
        $gizli_error = true;
    } else {
        $email = $_POST["email"];
    }

    if (empty($_POST["telefon"])) {
        $tel_hata = "Telefon kısmı boş geçilemez.";
        $gizli_error = true;
    } elseif (strlen($_POST["telefon"]) < 11) {
        $tel_hata = "Lütfen doğru bir telefon numarası giriniz.";
        $gizli_error = true;
    } else {
        $telefon = $_POST["telefon"];
    }

    if (empty($_POST["sifre"])) {
        $parola_hata = "Parola boş geçilemez.";
        $gizli_error = true;
    } else {
        $parola = $_POST["sifre"];
    }

    if (empty($_POST["sifretkr"])) {
        $parolatkr_hata = "Şifre tekrarı boş geçilemez.";
        $gizli_error = true;
    } elseif ($_POST["sifre"] != $_POST["sifretkr"]) {
        $parolatkr_hata = "Parolalar eşleşmiyor.";
        $gizli_error = true;
    } else {
        $parolatkr = $_POST["sifretkr"];
    }

    if (!$gizli_error) {
        $password = password_hash($parola, PASSWORD_DEFAULT);

        $ekle = "INSERT INTO kayitol (ad, soyad, email, telefon, sifre) 
                 VALUES ('$username', '$surname', '$email', '$telefon', '$password')";

        $calistirekle = mysqli_query($baglanti, $ekle);

        if ($calistirekle) {
            echo '<div class="alert alert-success" role="alert">
                    Kayıt Başarılı.
                  </div>';
            header("Location: girisyap.php?tekrar=1");
            exit;
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Kayıt Başarısız.
                  </div>';
        }

        mysqli_close($baglanti);
    }
}

if (isset($_GET["tekrar"])) {
    echo '<div class="alert alert-success" role="alert">
            Kayıt Başarılı.
          </div>';
}

?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Kayıt Ol</title>
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

    <div class="container mt-5">
        <div class="container">
            <p class="text-center baslik text-secondary"><strong>Hesap Oluşturun</strong></p>
        </div>
        <hr>
        <form action="kayitol.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control <?php if (!empty($username_hata)) echo "is-invalid"; ?>" placeholder="İsminizi Giriniz." name="isim">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php echo $username_hata; ?>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control <?php if (!empty($soyad_hata)) echo "is-invalid"; ?>" placeholder="Soyisminizi Giriniz." name="soyisim">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php echo $soyad_hata; ?>
                </div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control <?php if (!empty($email_hata)) echo "is-invalid"; ?>" placeholder="örnek123@gmail.com" name="email">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php echo $email_hata ?>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control <?php if (!empty($tel_hata)) echo "is-invalid"; ?>" placeholder="Cep Telefon Numaranızı Giriniz" name="telefon">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php echo $tel_hata; ?>
                </div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control <?php if (!empty($parola_hata)) echo "is-invalid"; ?>" placeholder="Şifrenizi Giriniz." name="sifre">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php echo $parola_hata; ?>
                </div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control <?php if (!empty($parolatkr_hata)) echo "is-invalid"; ?>" placeholder="Şifrenizi Tekrar Giriniz." name="sifretkr">
                <div id="validationServer03Feedback" class="invalid-feedback">
                    <?php echo $parolatkr_hata; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="kaydet">Kayıt Ol</button>
        </form>
    </div>
</body>
</html>
