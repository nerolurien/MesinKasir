<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MESIN KASIR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container form-container d-flex justify-content-center mt-5">
        <div class="col-md-6">
            <h1 class="text-center">KASIR</h1>
            <form  method="POST" action="">
                <div class="table-responsive">
                    <table class="table table-striped table-hover text-center">
                    <tr>
                       <td><label for ="name">Nama Barang:</label><br>
                        <td><input type="text" name="name[]" placeholder="Nama" class="form-control"></td>
                    </tr>

                        <tr>
                        <td><label for ="harga">Harga:</label><br>
                        <td><input type="number" name="harga[]" placeholder="Harga" class="form-control"></td>
                    </tr>

                        <tr>
                        <td><label for ="barang">Berapa:</label><br>
                        <td><input type="text" name="barang[]" placeholder="Barang" class="form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="kirim" value="Tambah" class="btn btn-primary"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="reset" value="Reset" class="btn btn-danger"></td>
                    </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <?php
    session_start();

    if(isset($_POST['kirim'])){
        if(@$_POST['name'][0] && @$_POST['harga'][0] && @$_POST['barang'][0]){
            foreach($_POST['name'] as $key => $value){
                $exist = false;
                foreach($_SESSION['keranjang'] as $item){
                    if($item['name'] == $_POST['name'][$key]){
                        $exist = true;
                    }
                }
                if($exist){
                    echo "<script>alert('Barang Sudah Ada')</script>";
                }else{
                    $data = [
                        'name' => $_POST['name'][$key],
                        'harga' => $_POST['harga'][$key],
                        'barang' => $_POST['barang'][$key],
                    ];
                    array_push($_SESSION['keranjang'], $data);
                }
            }
            header('Location: kasir.php');
        }else {
            echo "<p class='text-danger text-center mt- 3'>lengkapi data</p>";
        }
    }

    
    if(!isset($_SESSION['keranjang'])){
        $_SESSION['keranjang'] = array();
    }
    
    //untuk tombol reset
    if(isset($_POST['reset'])){
        session_unset();
    }

    if(isset($_GET['hapus'])){ 
        $index = $_GET['hapus'];
        unset($_SESSION['keranjang'][$index]);
    }

    
    // var_dump($_SESSION);
    if(!empty($_SESSION['keranjang'])){
        echo "<table border align=center class='table table-striped table-hover'>";
        echo  "<tr>";
        echo "<th>Nama</th>";
        echo "<th>Harga</th>";
        echo "<th>Barang</th>";
        echo "<th>Aksi</th>";
        echo "</tr>";
    
    foreach($_SESSION['keranjang'] as $index => $value){
        echo "<tr>";
        echo "<td>".$value['name']."</td>";
        echo "<td>"."Rp.".number_format($value['harga'])."</td>";
        echo "<td>".$value['barang']."</td>";
        echo '<td> <a href="?hapus=' . $index .'" class="btn btn-danger">Hapus</a></td>';
        echo "</tr>";
       
    }
    echo '<td> <a class = "btn btn-primary mt-3 " href="checkout.php">Checkout</a></td>';

}