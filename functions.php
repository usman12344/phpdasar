<?php 

// connect ke db
$conn = mysqli_connect('localhost','root','','jualan');


function query($query){
    global $conn;
    $result = mysqli_query($conn,$query);
    $rows = [];
    while($data = mysqli_fetch_assoc($result)){
         $rows[] = $data;
    }
    return $rows;
}

function tambah($data){
    global $conn;
    // ambil data dari tiap elemen form
    $namabarang = htmlspecialchars($data['namabarang']);
    $harga = htmlspecialchars($data['harga']);
    $stok = htmlspecialchars($data['stok']);
    $id_supplier = htmlspecialchars($data['id_supplier']);
  

    //upload gambar
    $gambar = upload();
    if(!$gambar){
        return false;
    }

    // insert query ke db
    $query = "INSERT INTO produk VALUES('','$namabarang','$harga','$stok','$id_supplier','$gambar')";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);

}

function upload(){

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ektensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ektensiGambar));

    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "
            <script>
                alert('yang anda upload bukan gambar!');
            </script>
        ";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000){
        echo "
        <script>
            alert('ukuran terlalau besar');
        </script>
    ";
    return false;
    }

    //lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName,'img/' . $namaFileBaru);

    return $namaFileBaru;


}

function hapus($id){
    global $conn;

    mysqli_query($conn,"DELETE from produk WHERE id_barang = $id");

    return mysqli_affected_rows($conn);
}

function edit($data){
    global $conn;
    // ambil data dari tiap elemen form
    $id_barang = $data['id_barang'];
    $nama_barang = htmlspecialchars($data['nama_barang']);
    $harga = htmlspecialchars($data['harga']);
    $stok = htmlspecialchars($data['stok']);
    $id_supplier = htmlspecialchars($data['id_supplier']);
    
    $gambarLama = htmlspecialchars($data['gambarLama']);
    
    // cek apakah user pilih gambar baru atau tidak
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    var_dump($gambar);

    // insert query ke db
    $query = "UPDATE produk SET
        nama_barang = '$nama_barang',
        harga = '$harga',
        stok = '$stok',
        id_supplier ='$id_supplier',
        gambar = '$gambar'
        WHERE id_barang = '$id_barang'
        ";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

    function ubah($keyword){
        $query = "SELECT * FROM produk WHERE
         nama_barang LIKE '%$keyword%' OR 
         harga LIKE '%$keyword%' OR 
         stok LIKE '%$keyword%' OR 
         id_supplier LIKE '%$keyword%'
         ";

        return query($query);
    }

    function registrasi($data){
        global $conn;

        $username = strtolower(stripslashes($data['username']));
        $password = mysqli_real_escape_string($conn,$data['password']);
        $password2 = mysqli_real_escape_string($conn,$data['password2']);

        //cek username sudah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

        if(mysqli_fetch_assoc($result)){
            echo "<script>
                alert('username sudah terdaftar');
            </script>";
            var_dump($result);
                return false;
        }

        if($password !== $password2){
            echo "<script>
                alert('password tidak sama');
            </script>";
                return false;
        }

        // emkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        // var_dump($password);die;
        
        //tambahkan userbaru ke database
        mysqli_query($conn,"INSERT INTO user VALUES(
            '',
            '$username',
            '$password'
        )");

        return mysqli_affected_rows($conn);
    }

?>