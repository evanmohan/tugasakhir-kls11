<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";

if (!empty($_POST['siapsaji_validate'])) {
        $query = mysqli_query($conn, "UPDATE tb_list_order SET catatan='$catatan', status=2 WHERE id_list_order='$id'");
        if ($query) {
            $message =  '<script>alert("Order Siap Di Sajikan");
                            window.location="../dapur"</script>';
        } else {
            $message = '<script>alert("Order Gagal Di Sajikan")
                        window.location="../dapur"</script>';
        }
    }

echo $message;
?>