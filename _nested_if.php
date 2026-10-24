<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<?php
declare(strict_types=1);
$sudahLogin = true;
$peran = 'admin';
if ($sudahLogin) {
if ($peran === 'admin') {
echo "Selamat datang, Admin. Akses penuh.\n";
} elseif ($peran === 'operator') {
echo "Selamat datang, Operator. Akses terbatas.\n";
} else {
echo "Peran tidak dikenal.\n";
}
} else {
echo "Silakan login terlebih dahulu.\n";
}
// Alternatif datar dengan &&
$terverifikasi = true;
$saldo = 120000;
if ($sudahLogin && $terverifikasi && $saldo >= 100000) {
echo "Transaksi besar diizinkan.\n";
}, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>