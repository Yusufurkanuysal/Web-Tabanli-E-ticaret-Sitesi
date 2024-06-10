<?php
require_once "db.php";
session_start();

if (isset($_POST['id'])) {
    $ürün_id = $_POST['id'];
    $stmt = $db->prepare("SELECT * FROM ürünler WHERE id = ?");
    $stmt->execute([$ürün_id]);
    $ürün = $stmt->fetch(PDO::FETCH_OBJ);

    if ($ürün) {
        if (!isset($_SESSION['kart'])) {
            $_SESSION['kart'] = [];
        }

        $found = false;
        foreach ($_SESSION['kart'] as &$item) {
            if ($item->id == $ürün->id) {
                $item->quantity += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $ürün->quantity = 1;
            $_SESSION['kart'][] = $ürün;
        }
    }
}

if (isset($_POST['remove_id'])) {
    $remove_id = $_POST['remove_id'];
    foreach ($_SESSION['kart'] as $key => $item) {
        if ($item->id == $remove_id) {
            unset($_SESSION['kart'][$key]);
            break;
        }
    }
}

if (isset($_POST['decrease_id'])) {
    $decrease_id = $_POST['decrease_id'];
    foreach ($_SESSION['kart'] as &$item) {
        if ($item->id == $decrease_id) {
            $item->quantity -= 1;
            if ($item->quantity < 1) {
                $item->quantity = 1; 
            }
            break;
        }
    }
}

if (isset($_POST['increase_id'])) {
    $increase_id = $_POST['increase_id'];
    foreach ($_SESSION['kart'] as &$item) {
        if ($item->id == $increase_id) {
            $item->quantity += 1;
            break;
        }
    }
}

if (isset($_POST['siparisonay'])) {
    $stmt = $db->prepare("INSERT INTO sepet (ürün_resmi, ürün_adi, ürün_aciklama, ürün_fiyati) VALUES (?, ?, ?, ?)");
    foreach ($_SESSION['kart'] as $item) {
        $stmt->execute([$item->ürün_resmi, $item->ürün_adi, $item->ürün_aciklama, $item->ürün_fiyati]);
    }

    unset($_SESSION['kart']); 
    
    header("Location: odeme.php"); 
    exit;
}

$cart_items = isset($_SESSION['kart']) ? $_SESSION['kart'] : [];
$total_quantity = array_sum(array_column($cart_items, 'quantity'));
$total_price = 0;
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Sepetim</title>
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
            <h2 class="text-center mt-5">Sepetinizde <strong class="text-danger"><?php echo $total_quantity; ?></strong> adet ürün bulunmaktadır.</h2>
            <hr>
            <div class="row">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Ürün Resmi</th>
                            <th class="text-center">Ürün Adı</th>
                            <th class="text-center">Ürün Açıklaması</th>
                            <th class="text-center">Ürün Fiyatı</th>
                            <th class="text-center">Miktar</th>
                            <th class="text-center">Sepetten Çıkar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cart_items as $item) { ?>
    <tr>
        <td class="text-center">
            <img src="<?php echo htmlspecialchars($item->ürün_resmi); ?>" alt="" width="60">
        </td>
        <td class="text-center pt-4"><strong><?php echo htmlspecialchars($item->ürün_adi); ?></strong></td>
        <td class="text-center pt-4"><?php echo htmlspecialchars($item->ürün_aciklama); ?></td>
        <td class="text-center pt-4"><strong><?php echo htmlspecialchars($item->ürün_fiyati); ?> TL</strong></td>
        <td class="text-center pt-4" style="width: 150px;">
            <form action="sepet.php" method="POST" class="d-inline">
                <input type="hidden" name="decrease_id" value="<?php echo htmlspecialchars($item->id); ?>">
                <button type="submit" class="btn btn-warning btn-sm mx-1">-</button>
            </form>
            <span><?php echo htmlspecialchars($item->quantity); ?></span>
            <form action="sepet.php" method="POST" class="d-inline">
                <input type="hidden" name="increase_id" value="<?php echo htmlspecialchars($item->id); ?>">
                <button type="submit" class="btn btn-success btn-sm mx-1">+</button>
            </form>
        </td>
        <td class="text-center pt-4">
            <form action="sepet.php" method="POST">
                <input type="hidden" name="remove_id" value="<?php echo htmlspecialchars($item->id); ?>">
                <button type="submit" class="btn bg-danger text-white">Sepetten Çıkar</button>
            </form>
        </td>
    </tr>
<?php 
    $total_price += $item->ürün_fiyati * $item->quantity;
} ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-right">Toplam Ürün : <span class="text-danger"><?php echo $total_quantity; ?> Adet</span></th>
                            <th colspan="4" class="text-right">Toplam Tutar : <span class="text-danger"><?php echo $total_price; ?> TL</span></th>
                        </tr>
                    </tfoot>
                </table>

                <form action="sepet.php" method="POST">
                    <button type="submit" name="siparisonay" class="btn btn-primary">Siparişi Onayla</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
