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
      //cek session

      session_start();
      if(!isset($_SESSION['login'])){
          header('Location: login.php');
          exit;
      }
      
    $conn = mysqli_connect('localhost','root','','jualan'); 

    require 'functions.php';

    ?>

    <?php 
    if(isset($_POST["submit"])){
        // var_dump($_FILES); die;
        // cek paakah data berhasil masuk atau tidak
        // var_dump(mysqli_affected_rows($conn));

        if(tambah($_POST) > 0){
            echo "
                <script>
                    alert('data berhasil masuk');
                    document.location.href='index.php';
                </script>
            ";
        } else {
            echo "<script>
            alert('data tidak berhasil masuk');
            document.location.href='index.php';
        </script>";
            echo mysqli_error($conn);
        }

    }
    ?>
    
<h1>tambah data mahasiswa</h1>
<form action="" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="namabarang">namabarang :</label>
            <input type="text" name="namabarang" id="namabarang" required>
        </li>
        <li>
            <label for="harga">harga :</label>
            <input type="text" name="harga" id="harga" required>
        </li>
        <li>
            <label for="stok">stok :</label>
            <input type="text" name="stok" id="stok" required>
        </li>
        <li>
            <label for="id_supplier">id supplier :</label>
            <input type="text" name="id_supplier" id="id_supplier" required>
        </li>
        <li>
            <label for="gambar">gambar :</label>
            <input type="file" name="gambar">
        </li>
        <button type="submit" name="submit">Tambah Data</button>
    </ul>
</form>
</body>
</html>