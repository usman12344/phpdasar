<?php 
  //cek session

  session_start();
  if(!isset($_SESSION['login'])){
      header('Location: login.php');
      exit;
  }
  
    require 'functions.php';

    $id = $_GET['id_barang'];

   if( hapus($id) > 0 ){
    echo "
    <script>
        alert('data berhasil dihapus');
        document.location.href='index.php';
    </script>
        ";
        } else {
        echo "<script>
        alert('data tidak berhasil dihapus');
        document.location.href='index.php';
        </script>";
        echo mysqli_error($conn);
        }

?>