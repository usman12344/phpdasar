<?php 
// sleep(10);
require '../functions.php';
$keyword = $_GET['keyword'];
$query = "SELECT * FROM produk WHERE
            nama_barang LIKE '%$keyword%' OR 
            harga LIKE '%$keyword%' OR 
            stok LIKE '%$keyword%' OR 
            id_supplier LIKE '%$keyword%'
            ";
$produk = query($query);

?>


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
                <?php foreach($produk as $row) : ?>
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