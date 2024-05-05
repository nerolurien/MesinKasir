<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Checkout</title>
</head>
<body>
<?php
session_start();

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

if (isset($_POST['name']) && isset($_POST['harga']) && isset($_POST['barang'])) {
    $name = $_POST['name'];
    $harga = $_POST['harga'];
    $barang = $_POST['barang'];
}

$total_price = 0;
foreach ($_SESSION['keranjang'] as $item) {
  $total_price += $item['harga'] * $item['barang'];
}

if (isset($_POST['payment'])) {
  $_SESSION['payment'] = $_POST['payment'];
  if ($_SESSION['payment'] < $total_price) {
    echo "<div class='alert alert-danger' role='alert'>Uang anda kurang.</div>";
  } else {
    $_SESSION['kembalian'] = ($_SESSION['payment'] - $total_price) ;
    header('Location: struk.php');
    exit;
}
}
  // Display keranjang
  echo "<h2>keranjang:</h2>";
  if (count($_SESSION['keranjang']) > 0) {
    echo "<ul class='list-group'>";
    foreach ($_SESSION['keranjang'] as $item) {
      echo "<li class='list-group-item'>$item[name] x $item[barang] = Rp. " . number_format($item['harga'] * $item['barang']) . "</li>";
    }
    echo "<li class='list-group-item list-group-item-primary'>Total Price: Rp. " . number_format($total_price) . "</li>";
    echo "</ul>";
    echo "<form action='' method='post' class='mt-3'>
    <label for='payment' class='form-label'>Payment:</label>
    <input type='number' class='form-control' id='payment' name='payment' required><br>
    <button type='submit' class='btn btn-primary'>Checkout</button>
  ";
  } else {
    echo "<p>keranjang is empty.</p>";
  }


