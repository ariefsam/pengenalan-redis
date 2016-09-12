<?php
/**
 * Created by PhpStorm.
 * User: Arief Hidayatulloh
 * Date: 11/09/16
 * Time: 23:02
 */
ini_set('display_errors',1);
require 'config.php';

$jumlah_perulangan=100000;


$redis = new Redis();
$redis->connect($config_redis['host'],$config_redis['port'],$config_redis['timeout']);
$redis->set('artikel.1','Artikel ini berisi konten yang dibutuhkan untuk pengenalan redis. Redis adalah sesuatu yang dapat dilakukan.');

$start=microtime(true);
for($i=0;$i<=$jumlah_perulangan;$i++) {
    $result = $redis->get('artikel.1');
}
$end=microtime(true);
$durasi=$end-$start;
$waktu_rata2=$jumlah_perulangan/$durasi;
echo "Waktu Pengerjaan: $durasi untuk $jumlah_perulangan kali. Waktu rata2 redis adalah " . $waktu_rata2 . " transaksi per detik\n\n<br><br><br>";


$mysql=mysqli_connect($config_mysql['host'],$config_mysql['username'],$config_mysql['password'],$config_mysql['database']);
$start=microtime(true);
for($i=0;$i<=$jumlah_perulangan;$i++) {
    $result = $mysql->query('select * from artikel where id=1');
    $data = $result->fetch_array();
}
$end=microtime(true);
$durasi=$end-$start;
$waktu_rata2=$jumlah_perulangan/$durasi;
echo "Waktu Pengerjaan: $durasi untuk $jumlah_perulangan kali. Waktu rata2 mysql adalah " . $waktu_rata2 . " transaksi per detik\n\n<br><br><br>";
