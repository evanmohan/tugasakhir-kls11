<?php
include "proses/connect.php";
// Ambil data menu
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu");
if ($query) {
    while ($row = mysqli_fetch_array($query)) {
        $result[] = $row;
    }
} else {
    $result = [];  // Inisialisasi $result sebagai array kosong jika query gagal
}

// Inisialisasi variabel result_chart jika belum didefinisikan
$result_chart = array();

$query_chart = mysqli_query($conn, "SELECT nama_menu, tb_daftar_menu.id, SUM(tb_list_order.jumlah) AS total_jumlah FROM tb_daftar_menu
LEFT JOIN tb_list_order ON tb_daftar_menu.id = tb_list_order.menu
GROUP BY tb_daftar_menu.id
ORDER BY tb_daftar_menu.id ASC");

// Cek jika query berhasil
if ($query_chart) {
    while ($record_chart = mysqli_fetch_array($query_chart)) {
        $result_chart[] = $record_chart;
    }
}

// Proses data untuk chart
$array_menu = array_column($result_chart, 'nama_menu');
$array_menu_qoute = array_map(function ($menu) {
    return "'".$menu."'";
}, $array_menu);
$string_menu = implode(',', $array_menu_qoute);

$array_jumlah_pesanan = array_column($result_chart, 'total_jumlah');
$string_jumlah_pesanan = implode(',', $array_jumlah_pesanan);
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="col-lg-10 mt-2 mx-auto mt-3">
    <!-- Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            $slide = 0;
            $firstSlideButton = true;
            // Pastikan $result diisi sebelum loop
            if (!empty($result)) {
                foreach ($result as $datatombol) {
                    ($firstSlideButton) ? $aktif = "active" : $aktif = "";
                    $firstSlideButton = false;
            ?>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $slide ?>" class="<?php echo $aktif ?>" aria-current="true" aria-label="Slide <?php echo $slide + 1 ?>"></button>
                <?php
                    $slide++;
                }
            } else {
                echo "Data tidak tersedia.";
            }
            ?>
        </div>
        <div class="carousel-inner rounded">
            <?php
            $yanto = true;
            if (!empty($result)) {
                foreach ($result as $data) {
                    ($yanto) ? $yanti = "active" : $yanti = "";
                    $yanto = false;
            ?>
                    <div class="carousel-item <?php echo $yanti ?>">
                        <img src="assets/img/<?php echo $data['foto'] ?>" class="img-fluid" style="height: 250px; width: 1000px; object-fit:cover;" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo $data['nama_menu'] ?></h5>
                            <p><?php echo $data['keterangan'] ?></p>
                        </div>
                    </div>
                <?php
                }
            } else {
                echo "Carousel tidak tersedia.";
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Akhir Carousel -->

    <!-- Judul -->
    <div class="card mt-4 border-0 bg-light">
        <div class="card-body text-center">
            <h5 class="card-title">BEROKS - NIKMATI DARI RESTAURANT BEROKS YANG LEZAT DAN HALAL 100%</h5>
            <p class="card-text">Aplikasi restaurant pemesanan makanan dan minuman yang sehat dan bergizi bagi tubuh anda. nikmati  semua menu dari restaurant kami yang enak enak dan lezat. Selama anda pesan di sini, anda akan ketagihan untuk kembali kesini lagi. Selamat menikmati menu di restaurant kami</p>
            <a href="order" class="btn btn-success">Buat Order</a>
        </div>
    </div>
    <!-- Akhir Judul -->

    <!-- Chart -->
    <div class="card mt-4 border-0 bg-light">
    <div class="card-body text-center">
        <div>
            <canvas id="myChart"></canvas>
        </div>
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php echo $string_menu ?>],
                    datasets: [{
                        label: 'Jumlah Porsi Terjual',
                        data: [<?php echo $string_jumlah_pesanan ?>],
                        borderWidth: 1,
                        backgroundColor:[ 
                            'rgba(245, 39, 102, 0.45)',
                            'rgba(0, 67, 255, 0.62)',
                            'rgba(239, 255, 76, 0.62)',
                            'rgba(30, 255, 60, 0.62)',
                            'rgba(122, 32, 255, 0.62)',
                            'rgba(255, 134, 28, 0.76)'
                        ]
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        </div>
    </div>
    <!-- Akhir Chart -->
</div>
