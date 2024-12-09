<?php

if (empty($_SESSION['username_decafe'])) {
    header('location:login');
    exit();
}

include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_decafe]'");
$hasil = mysqli_fetch_array($query);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant-Website Pemesanan Makanan, Minuman Dan Desert</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-image: url(''); background-position: center; background-size: cover; height: 100vh;">

    <!-- Header -->
    <?php include "header.php"; ?>
    <!-- End Header -->

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-3 col-sm-4 p-0">
                <?php include "sidebar.php"; ?>
            </div>

            <!-- Main Content -->
            <div class="col-lg-10 col-md-9 col-sm-8" style="margin-left: 250px;">
                <div class="container-lg py-4">
                    <div class="row mb-5">
                        <!-- Content -->
                        <?php include $page; ?>
                        <!-- End Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
