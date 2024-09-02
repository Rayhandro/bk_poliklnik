<?php
include_once("../../config/conn.php");
session_start();

if (isset($_SESSION['login'])) {
  $_SESSION['login'] = true;
} else {
  echo "<meta http-equiv='refresh' content='0; url=../auth/login.php'>";
  die();
}

$nama = $_SESSION['username'];
$akses = $_SESSION['akses'];


if ($akses != 'dokter') {
  echo "<meta http-equiv='refresh' content='0; url=../..'>";
  die();
}

$totalPatientsQuery = "SELECT COUNT(*) as total FROM pasien";
$totalPatientsResult = mysqli_query($conn, $totalPatientsQuery);
$totalPatients = mysqli_fetch_assoc($totalPatientsResult)['total'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poliklinik | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/bk_poliklnik/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/bk_poliklnik/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/bk_poliklnik/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/bk_poliklnik/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/bk_poliklnik/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/bk_poliklnik/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/bk_poliklnik/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/bk_poliklnik/plugins/summernote/summernote-bs4.min.css">
</head>

<style>
    .summary-kategori{
        background-color: #0a6b4a;
        border-radius: 10px;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        transition: margin-top 0.3s ease;
    }
    .summary-kategori:hover{
        margin-top: 12px;
    }
    .summary-produk{
        background-color: #0a516b;
        border-radius: 10px;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        transition: margin-top 0.3s ease;
    }
    .summary-produk:hover{
        margin-top: 12px;
    }
    .summary-anggota{
        background-color: #FF9C70;
        border-radius: 10px;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        transition: margin-top 0.3s ease;
    }
    .summary-anggota:hover{
        margin-top: 12px;
    }
    .no-decoration{
        text-decoration: none;
    }
    .no-decoration:hover{
        opacity: 50%;
        transition: 0.5s;
        text-decoration: none;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php include "../../layouts/header.php" ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard <?= ucwords($_SESSION['akses']) ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
                
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
       <div class="container">
        <div class="row">
        <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-kategori p-4">
                        <div class="row">
                            <div class="col-12 text-white">
                                <h3 class="fs-2 text-white">Total Pasien</h3>
                                <p class="fs-4"><?php echo $totalPatients;?> Pasien</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
        </div>
       </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include "../../layouts/footer.php"; ?>
  </div>
  <!-- ./wrapper -->
  <?php include "../../layouts/pluginsexport.php"; ?>
</body>

</html>