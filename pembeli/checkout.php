<?php 
include('config/connect.php');
include('data.php');
require 'item.php';

// Save new orders
$nama=$data['nama_depan'];
$id_pembeli=$data['id'];
$tanggal=date('Y-m-d');
$status="MENUNGGU VERIFIKASI";
$sql1 = "INSERT INTO orders (`nama`, `tanggal_pembelian`, `status`, `id_pembeli`) VALUES ('$nama','$tanggal','$status','$id_pembeli')";
mysqli_query($con, $sql1);
$ordersid = 1; 
// Save order details for new orders
$cart = unserialize(serialize($_SESSION['cart']));
for($i=0; $i<count($cart);$i++) {
$sql2 = 'INSERT INTO orderdetail (`id_barang`, `order_id`, `harga`, `stok`, `idpenjual`) VALUES ('.$cart[$i]->id.', '.$ordersid.', '.$cart[$i]->harga.', '.$cart[$i]->quantity.','.$cart[$i]->idpenjual.')';
mysqli_query($con, $sql2);
}
// Clear all product in cart
unset($_SESSION['cart']);
 ?>
 Thanks for buying products. Click <a href="index.php">here</a> to continue purchasing products.