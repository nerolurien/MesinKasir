<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <style>
      body{
        display: flex;
        text-align: center;
        justify-content: center;
      }
    </style>
    <header>
      <!-- place navbar here -->
    </header>
    <main></main>
    <footer>
      <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

<?php
session_start();

$total_price = 0;
foreach ($_SESSION['keranjang'] as $item) {
  $total_price += $item['harga'] * $item['barang'];
}

$payment = $_SESSION['payment'];
$kembalian = $_SESSION['kembalian'];


echo '<div class="container">
<h2 class="fs-2">STRUK</h2>
<h3 class="fs-4">BARANG YANG DIBELI:</h3>
<ul class="list-group">';
foreach($_SESSION['keranjang'] as $item) {
  echo '<li class="list-group-item">'."•" . $item['name'] . ' x ' . $item['barang'] . ' = Rp.' . number_format($item['harga'] * $item['barang']) . '</li>';
}
echo '</ul>
<p class="fs-4">Total: Rp.' . number_format($total_price) . '</p>
<p class="fs-4">bayar: Rp.' . number_format($payment) . '</p>
<p class="fs-4">kembalian: Rp.' . number_format($kembalian) . '</p>

<form action="kasir.php" method="post" class="d-grid gap-2">
<button type="submit" class="btn btn-danger btn-sm ms-2 me-1" style="width:60px">Reset</button>
</form>
</form>';

if (isset($_POST['reset'])) {
  session_unset();  
}

?>

