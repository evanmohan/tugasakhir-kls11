<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$jenismenu = (isset($_POST['jenismenu'])) ? htmlentities($_POST['jenismenu']) : "";
$katmenu = (isset($_POST['katmenu'])) ? htmlentities($_POST['katmenu']) : "";

if (!empty($_POST['input_katmenu_validate'])) {

    $select = mysqli_query($conn, "SELECT kategori_menu FROM tb_kategori_menu WHERE kategori_menu = '$katmenu'");
    if (mysqli_num_rows($select)  > 0) {
        $message =  '<script>alert("kategori menu yang dimasukkan sudah ada");
                        window.location="../katmenu"</script>';
    } else {

        $query = mysqli_query($conn, "UPDATE tb_kategori_menu SET  kategori_menu='$katmenu' WHERE id_kat_menu='$id'");
        if ($query) {
            $message =  '<script>alert("Data Berhasil diupdate");
                            window.location="../katmenu"</script>';
        } else {
            $message = '<script>alert("Data Gagal diupdate")
                            window.location="../katmenu"</script>';
        }
    }
}
echo $message;
?> 