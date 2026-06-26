<?php
require_once 'config/koneksi.php';
require_once 'classes/MahasiswaMandiri.php';
require_once 'classes/MahasiswaBidikmisi.php';
require_once 'classes/MahasiswaPrestasi.php';

// Inisialisasi koneksi OOP
$database = new Database();
$pdo = $database->getConnection();

// Ambil parameter dari URL untuk navigasi (default: dashboard)
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Ambil data untuk tiap kategori menggunakan static method yang sudah dibuat
$dataMandiri   = MahasiswaMandiri::getMahasiswaMandiri($pdo);
$dataBidikmisi = MahasiswaBidikmisi::getMahasiswaBidikmisi($pdo);
$dataPrestasi  = MahasiswaPrestasi::getMahasiswaPrestasi($pdo);

// Hitung jumlah data
$jmlMandiri   = count($dataMandiri);
$jmlBidikmisi = count($dataBidikmisi);
$jmlPrestasi  = count($dataPrestasi);
$totalData    = $jmlMandiri + $jmlBidikmisi + $jmlPrestasi;

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Registrasi Pembayaran Kuliah</title>
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f4f8fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Sidebar Styles (Tema Biru Cerah) */
        .sidebar {
            background: linear-gradient(180deg, #0d6efd 0%, #0dcaf0 100%);
            min-height: 100vh;
            color: #fff;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            margin-bottom: 5px;
            border-radius: 5px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #0d6efd;
            background-color: #fff;
        }
        .sidebar .sidebar-heading {
            font-size: 1.2rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 20px;
        }
        /* Content area */
        .content-area {
            padding: 30px;
        }
        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .card-custom:hover {
            transform: translateY(-5px);
        }
        .table-responsive {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .table thead th {
            background-color: #e9ecef;
            color: #495057;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky pt-3">
                <div class="sidebar-heading text-center">
                    <i class="fas fa-university mb-2 fa-2x"></i><br>
                    Sistem Akademik
                </div>
                <ul class="nav flex-column px-2">
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == 'dashboard') ? 'active' : '' ?>" href="?page=dashboard">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="sidebar-heading text-white-50 px-3 mt-4 mb-1" style="font-size: 0.8rem; border-bottom: none;">Kategori Mahasiswa</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == 'mandiri') ? 'active' : '' ?>" href="?page=mandiri">
                            <i class="fas fa-user me-2"></i> Mandiri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == 'bidikmisi') ? 'active' : '' ?>" href="?page=bidikmisi">
                            <i class="fas fa-user-graduate me-2"></i> Bidikmisi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == 'prestasi') ? 'active' : '' ?>" href="?page=prestasi">
                            <i class="fas fa-medal me-2"></i> Prestasi
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content-area">
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h1 class="h2 text-primary fw-bold">
                    <?php
                    if($page == 'dashboard') echo "Dashboard Rekapitulasi Data";
                    elseif($page == 'mandiri') echo "Daftar Registrasi - Mahasiswa Mandiri";
                    elseif($page == 'bidikmisi') echo "Daftar Registrasi - Mahasiswa Bidikmisi";
                    elseif($page == 'prestasi') echo "Daftar Registrasi - Mahasiswa Prestasi";
                    ?>
                </h1>
            </div>

            <?php if($page == 'dashboard'): ?>
            <!-- Dashboard Cards -->
            <div class="row mb-5">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-custom bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-white-50 small text-uppercase fw-bold">Total Mahasiswa</div>
                                    <div class="h2 mb-0 fw-bold"><?= $totalData ?></div>
                                </div>
                                <i class="fas fa-users fa-3x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-custom bg-info text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-white-50 small text-uppercase fw-bold">Jalur Mandiri</div>
                                    <div class="h2 mb-0 fw-bold"><?= $jmlMandiri ?></div>
                                </div>
                                <i class="fas fa-user fa-3x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-custom bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-white-50 small text-uppercase fw-bold">Jalur Bidikmisi</div>
                                    <div class="h2 mb-0 fw-bold"><?= $jmlBidikmisi ?></div>
                                </div>
                                <i class="fas fa-user-graduate fa-3x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-custom bg-warning text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-white-50 small text-uppercase fw-bold">Jalur Prestasi</div>
                                    <div class="h2 mb-0 fw-bold"><?= $jmlPrestasi ?></div>
                                </div>
                                <i class="fas fa-medal fa-3x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- All Data Table for Dashboard -->
            <div class="table-responsive">
                <h4 class="mb-3 text-secondary">Seluruh Data Mahasiswa</h4>
                <table class="table table-hover table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Semester</th>
                            <th>Jalur (Polymorphism)</th>
                            <th>Spesifikasi Akademik</th>
                            <th>Total Tagihan (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1; 
                        // Gabungkan semua data array menjadi satu untuk ditampilkan di dashboard
                        $allData = array_merge($dataMandiri, $dataBidikmisi, $dataPrestasi);
                        
                        foreach($allData as $mhs): 
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $mhs->getNim() ?></td>
                            <td><?= $mhs->getNamaMahasiswa() ?></td>
                            <td><?= $mhs->getSemester() ?></td>
                            <td>
                                <?php 
                                    if($mhs instanceof MahasiswaMandiri) echo '<span class="badge bg-info">Mandiri</span>';
                                    elseif($mhs instanceof MahasiswaBidikmisi) echo '<span class="badge bg-success">Bidikmisi</span>';
                                    elseif($mhs instanceof MahasiswaPrestasi) echo '<span class="badge bg-warning text-dark">Prestasi</span>';
                                ?>
                            </td>
                            <td class="small"><?= $mhs->tampilkanSpesifikasiAkademik() ?></td>
                            <td class="text-end fw-bold"><?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php else: // Kategori Spesifik (Mandiri, Bidikmisi, atau Prestasi) ?>
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Semester</th>
                            <th>Tarif UKT Asli (Rp)</th>
                            <th>Spesifikasi Tambahan</th>
                            <th>Total Tagihan Semester (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $dataTampil = [];
                        if($page == 'mandiri') $dataTampil = $dataMandiri;
                        elseif($page == 'bidikmisi') $dataTampil = $dataBidikmisi;
                        elseif($page == 'prestasi') $dataTampil = $dataPrestasi;

                        if(count($dataTampil) > 0):
                            foreach($dataTampil as $mhs): 
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $mhs->getNim() ?></td>
                            <td><?= $mhs->getNamaMahasiswa() ?></td>
                            <td><?= $mhs->getSemester() ?></td>
                            <td class="text-end"><?= number_format($mhs->getTarifUktNominal(), 0, ',', '.') ?></td>
                            <td class="small"><?= $mhs->tampilkanSpesifikasiAkademik() ?></td>
                            <td class="text-end text-primary fw-bold fs-5"><?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></td>
                        </tr>
                        <?php 
                            endforeach; 
                        else:
                        ?>
                        <tr><td colspan="7" class="text-center text-muted">Belum ada data.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
