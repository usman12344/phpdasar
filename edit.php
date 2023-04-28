<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- connect ke db -->
    <?php 
    // $conn = mysqli_connect('localhost','root','','jualan'); 

    require 'functions.php';

    $id_barang = $_GET['id_barang'];

    $prod = query("SELECT * FROM produk WHERE id_barang = $id_barang")[0];
    var_dump($prod);

    ?>

    <?php 
    if(isset($_POST["submit"])){
        
        // cek paakah data berhasil masuk atau tidak
        // var_dump(mysqli_affected_rows($conn));
        // var_dump(edit($_POST));
    
        if(edit($_POST) > 0){
            echo "
                <script>
                    alert('data berhasil diubah');
                    document.location.href='index.php';
                </script>
            ";
        } else {
            echo "<script>
            alert('data tidak berhasil diubah');
            document.location.href='index.php';
        </script>";
            echo mysqli_error($conn);
        }

    }
    ?>
    
<h1>edit data mahasiswa</h1>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_barang" value="<?= $prod['id_barang']; ?>">
    <input type="hidden" name="gambarLama" value="<?= $prod['gambar']; ?>">
    <ul>
        <li>
            <label for="namabarang">namabarang :</label>
            <input type="text" name="nama_barang" id="nama_barang" value="<?= $prod['nama_barang'] ?>">
        </li>
        <li>
            <label for="harga">harga :</label>
            <input type="text" name="harga" id="harga" value="<?= $prod['harga'] ?>">
        </li>
        <li>
            <label for="stok">stok :</label>
            <input type="text" name="stok" id="stok" value="<?= $prod['stok'] ?>">
        </li>
        <li>
            <label for="id_supplier">id supplier :</label>
            <input type="text" name="id_supplier" id="id_supplier" value="<?= $prod['id_supplier'] ?>">
        </li>
        <li>
            <img src="img/<?= $prod['gambar'] ?>" alt="" width="50px">
            <label for="gambar">gambar :</label>
            <input type="file" name="gambar" >
        </li>
        <button type="submit" name="submit">edit Data</button>
    </ul>
</form>
</body>
</html>