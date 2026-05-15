<?php
//ambil data dari form
$nama = $_POST['nama_produk'];
$harga = $_POST ['harga_produk'];
$deskripsi = $_POST ['deskripsi'];


//1. validasi: cek kalau kosong
if (empty($nama) || empty($harga)) {
    echo "gagal, nama dan harga harus diisi";
} else {
    //2. tampilkan hasil
    echo "produk: " . $nama . "<br>";
    echo "harga: " . $harga . "<br>";

    //3. logika harga 
    if ($harga > 100000) {
        echo "kategori mahal";
    } else {
        echo "kategori murah";
    }
}
?>