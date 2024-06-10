<?php
require_once "db.php";
session_start();

$ürünler = $db->query("SELECT * FROM ürünler", PDO::FETCH_OBJ)->fetchAll();
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Ürünler</title>
</head>
<body>
<head class="">
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
</head>

<main class="ürünüm">
    <div class="">
        <div class="row gitar">
            <?php foreach ($ürünler as $ürün) { ?>
                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo $ürün->ürün_resmi; ?>" class="card-img-top" alt="Ürün Resmi">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $ürün->ürün_adi; ?></h5>
                            <p class="card-text"><?php echo $ürün->ürün_aciklama; ?></p>
                            <p><strong><?php echo $ürün->ürün_fiyati; ?> TL</strong></p>
                            <form action="sepet.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $ürün->id; ?>">
                                <button type="submit" class="btn btn-primary w-100">Sepete Ekle</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
</body>
</html>
