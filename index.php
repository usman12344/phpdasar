<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .loader {
            width: 100px;
            position: absolute;
            margin-top: -20px;
            margin-left: -15px;
            z-index: -1;
            display: none;
        }
    </style>
</head>
<body>
    <?php
    //cek session

    session_start();
    if(!isset($_SESSION['login'])){
        header('Location: login.php');
        exit;
    }

    // mengubungkan php ke database 
        // $conn = mysqli_connect("localhost","root","","jualan");
    require 'functions.php';

        $jumlahDataPerHalaman = 3;
        $jumlahData = count(query("SELECT * FROM produk"));
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
        $halamanAktif =(isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
        var_dump($awalData);
        // menghubungkan ke tabel
        $result = query("SELECT * FROM produk LIMIT $awalData, $jumlahDataPerHalaman");

        // var_dump($result);
        // if(!$result){
        //    echo mysqli_error($conn);
        // }

        // get data
        // while ($data = mysqli_fetch_assoc($result)){
            
        //     var_dump($data);

        // }

        //cek jika tombol diklik 
        if(isset($_POST['cari'])){
             $result = ubah($_POST['keyword']);

        }

    ?>
    <a href="logout.php">Logout</a> || <br> <br> <a href="cetak.php" target="_blank"> CETAK</a>
    <br>
    <br>
    <a href="tambah.php"> tambah data produk</a><br>
    <h1>Daftar Produk</h1>
            <form action="" method="post" >
                <input type="text" autofocus name="keyword" id="keyword">
                <button type="submit" name="cari" id="tombol-cari">cari</button>
                <img src="img//loader.gif" alt="" class="loader">
            </form>

            <!-- navigasi -->

            <?php if ($halamanAktif > 1) : ?>
            <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
            <?php endif; ?>

            <?php for( $i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if( $i == $halamanAktif) : ?>
                    <a href="?halaman=<?= $i ?>"  style='font-weight:800; color:blue'><?= $i ?></a>
                  <?php else : ?>  
                    <a href="?halaman=<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halamanAktif < $jumlahHalaman) : ?>
            <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
            <?php endif; ?>

    
            <div id="container">
                <table border=1 cellpadding=10 cellspacing=0>
                <tr>
                    <th>No</th>
                    <th>Aksi</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>id Supplier</th>
                    <th>GAMBAR</th>
                </tr>
            
                <?php $i=1; ?>
                <?php foreach($result as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td>
                        <a href="edit.php?id_barang=<?= $row["id_barang"] ?>">Edit</a>
                        <a href="hapus.php?id_barang=<?= $row['id_barang']; ?>" onclick="return confirm('yakin');">Hapus</a>
                    </td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['harga'] ?></td>
                    <td><?= $row['stok'] ?></td>
                    <td><?= $row['id_supplier'] ?></td>
                    <td><img src="img/<?= $row['gambar'] ?>" alt="" width="50px"></td>
                </tr>
                <?php $i++; ?>
                <?php endforeach ?>
                </table>
            </div>
            
    <a href="registrasi.php">Register</a>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>