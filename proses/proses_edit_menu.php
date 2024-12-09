<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$keterangan = (isset($_POST['keterangan'])) ? htmlentities($_POST['keterangan']) : "";
$kat_menu = (isset($_POST['kat_menu'])) ? htmlentities($_POST['kat_menu']) : "";
$harga = (isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
$stok = (isset($_POST['stok'])) ? htmlentities($_POST['stok']) : "";


$kode_rand = rand(10000,99999)."-";
$target_dir = "../assets/img/".$kode_rand;
$target_file = $target_dir . basename($_FILES['foto']['name']);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!empty($_POST['input_menu_validate'])) {
    // cek apakah gambar atau bukan
    if (!empty($_FILES['foto']['tmp_name'])) {
        $cek = getimagesize($_FILES['foto']['tmp_name']);
        if ($cek === false) {
            $message = "Ini Bukan File Gambar";
            $statusUpload = 0;
        } else {
            $statusUpload = 1;
            if (file_exists($target_file)) {
                $message = "Maaf File Yang Dimasukkan Sudah Ada";
                $statusUpload = 0;
            } else {
                if ($_FILES['foto']['size'] > 500000) {
                    //500Kb
                    $message = "File Yang Diupload Terlalu Besar";
                    $statusUpload = 0;
                } else {
                    if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
                        $message = "Maaf, hanya diperbolehkan gambar yang memiliki format JPG, JPEG, PNG dan GIF";
                        $statusUpload = 0;
                    }
                }
            }
        }
    } else {
        // Handle the case where no file was uploaded
        $statusUpload = 1; // Set to 1 if you don't want to block the update when no image is provided.
    }

    if ($statusUpload == 0) {
        $message = '<script>alert("' . $message . ', Gambar Tidak Dapat Di Upload");
                    window.location="../menu"</script>';
    } else {
        $select = mysqli_query($conn, "SELECT * FROM tb_daftar_menu WHERE nama_menu = '$nama_menu'");
        if (mysqli_num_rows($select) > 0) {
            $message = '<script>alert("Data Berhasil Di edit");
            window.location="../menu"</script>';
        } else {
            if (!empty($_FILES['foto']['tmp_name']) && move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                // If there is a file, update the foto field
                $query = mysqli_query($conn, "UPDATE tb_daftar_menu SET foto='" . $kode_rand . $_FILES['foto']['name'] . "', nama_menu='$nama_menu', keterangan='$keterangan', kategori='$kat_menu', harga='$harga', stok='$stok' WHERE id='$id'");
            } else {
                // If no file was uploaded, just update the other fields
                $query = mysqli_query($conn, "UPDATE tb_daftar_menu SET nama_menu='$nama_menu', keterangan='$keterangan', kategori='$kat_menu', harga='$harga', stok='$stok' WHERE id='$id'");
            }

            if ($query) {
                $message = '<script>alert("Data Berhasil Di edit");
                             window.location="../menu"</script>';
            } else {
                $message = '<script>alert("Data Gagal Dimasukkan");
                             window.location="../menu"</script>';
            }
        }
    }
}

echo $message;