-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 09 Haz 2024, 18:27:13
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `proje`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kayitol`
--

CREATE TABLE `kayitol` (
  `id` int(1) NOT NULL,
  `ad` varchar(25) NOT NULL,
  `soyad` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `telefon` varchar(11) NOT NULL,
  `sifre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kayitol`
--

INSERT INTO `kayitol` (`id`, `ad`, `soyad`, `email`, `telefon`, `sifre`) VALUES
(144, 'Yusuf Furkan ', 'Uysal', 'yusufurkanuysal@gmail.com', '05380514066', '$2y$10$XMmeSiHmMPPEhQnd8UG3Yu1T0hyLzHkoD/ICjGJgimnJcgsdMT/FO'),
(145, 'Yusuf Furkan ', 'Uysal', 'yusufurkanuysal@gmail.com', '05380514066', '$2y$10$2.tVWFOfyoGQdbFnF0F8jOWHfEqXrTOUxRH2qOk5.rErELRpTgSKe'),
(146, 'berat', 'yaşa', 'beratyasa@gmail.com', '05438766543', '$2y$10$F5NIjBtWtp0NPBpQ3dtYUe/IRTt6YrKSy3CYaRyfrzAguChJbxYq6');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

CREATE TABLE `sepet` (
  `id` int(50) NOT NULL,
  `ürün_resmi` varchar(25) NOT NULL,
  `ürün_adi` varchar(45) NOT NULL,
  `ürün_aciklama` varchar(155) NOT NULL,
  `ürün_fiyati` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `sepet`
--

INSERT INTO `sepet` (`id`, `ürün_resmi`, `ürün_adi`, `ürün_aciklama`, `ürün_fiyati`) VALUES
(20, 'resim/keman.jpg', 'Stentor Keman', 'Orta seviye kişiler için uygundur. Yeni başlayanlar için tavsiye edilmez', 6.335),
(21, 'resim/klarnet.jpg', 'Jinbao JBCL-570 Bemol Klarnet', 'Başlangıç kullanımına uygun olup tam bir fiyat performans ürünüdür.', 13.654),
(22, 'resim/klarnet.jpg', 'Jinbao JBCL-570 Bemol Klarnet', 'Başlangıç kullanımına uygun olup tam bir fiyat performans ürünüdür.', 13.654);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ödeme_bilgi`
--

CREATE TABLE `ödeme_bilgi` (
  `id` int(15) NOT NULL,
  `kart_isim` varchar(25) NOT NULL,
  `kart_numarası` int(20) NOT NULL,
  `skt` int(40) NOT NULL,
  `cvv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ödeme_bilgi`
--

INSERT INTO `ödeme_bilgi` (`id`, `kart_isim`, `kart_numarası`, `skt`, `cvv`) VALUES
(14, 'Yusuf Furkan Uysal', 2147483647, 11, 565),
(15, 'Yusuf Furkan Uysal', 2147483647, 11, 123),
(16, 'Yusuf Furkan Uysal', 2147483647, 11, 123);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ürünler`
--

CREATE TABLE `ürünler` (
  `id` int(1) NOT NULL,
  `ürün_aciklama` varchar(150) NOT NULL,
  `ürün_resmi` varchar(45) NOT NULL,
  `ürün_adi` varchar(40) NOT NULL,
  `ürün_fiyati` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ürünler`
--

INSERT INTO `ürünler` (`id`, `ürün_aciklama`, `ürün_resmi`, `ürün_adi`, `ürün_fiyati`) VALUES
(1, 'Çok güzel bir gitar olup başlangıç kullanımına uygundur.', 'resim/gitar.jpg', 'Schecter Elektro Gitar', 12.134),
(2, 'Orta seviye kişiler için uygundur. Yeni başlayanlar için tavsiye edilmez', 'resim/keman.jpg', 'Stentor Keman', 6.335),
(3, 'Başlangıç kullanımına uygun olup tam bir fiyat performans ürünüdür.', 'resim/klarnet.jpg', 'Jinbao JBCL-570 Bemol Klarnet', 13.654);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kayitol`
--
ALTER TABLE `kayitol`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sepet`
--
ALTER TABLE `sepet`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ödeme_bilgi`
--
ALTER TABLE `ödeme_bilgi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ürünler`
--
ALTER TABLE `ürünler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kayitol`
--
ALTER TABLE `kayitol`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- Tablo için AUTO_INCREMENT değeri `sepet`
--
ALTER TABLE `sepet`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `ödeme_bilgi`
--
ALTER TABLE `ödeme_bilgi`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `ürünler`
--
ALTER TABLE `ürünler`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
