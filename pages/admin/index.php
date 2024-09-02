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

if ($akses != 'admin') {
  echo "<meta http-equiv='refresh' content='0; url=../..'>";
  die();
}

$totalPatientsQuery = "SELECT COUNT(*) as total FROM pasien";
$totalPatientsResult = mysqli_query($conn, $totalPatientsQuery);
$totalPatients = mysqli_fetch_assoc($totalPatientsResult)['total'];

$totalDoctorQuery = "SELECT COUNT(*) as total FROM dokter";
$totalDoctorResult = mysqli_query($conn, $totalDoctorQuery);
$totalDoctor = mysqli_fetch_assoc($totalDoctorResult)['total'];

$totalObatQuery = "SELECT COUNT(*) as total FROM obat";
$totalObatResult = mysqli_query($conn, $totalObatQuery);
$totalObat = mysqli_fetch_assoc($totalObatResult)['total'];
?>
<?php
$title = 'Poliklinik | Dashboard';
ob_start();

$content = ob_get_clean();
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
  .summary-box {
    background-color: #0a6b4a;
    border-radius: 10px;
    box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    transition: margin-top 0.3s ease;
    padding: 20px;
    color: white;
    margin-right: 15px;
    width: 30%;
  }

  .summary-box:hover {
    margin-top: 12px;
  }

  .summary-box h3 {
    margin-bottom: 10px;
  }

  .summary-container {
    display: flex;
    justify-content: space-between;
  }

  .no-decoration {
    text-decoration: none;
  }

  .no-decoration:hover {
    opacity: 50%;
    transition: 0.5s;
    text-decoration: none;
  }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php include "../../layouts/header.php" ?>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard <?= ucwords($_SESSION['akses']) ?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="summary-container">
          <div class="summary-box">
            <h3>Total Dokter</h3>
            <p><?php echo $totalDoctor; ?> Dokter</p>
          </div>
          <div class="summary-box">
            <h3>Total Obat</h3>
            <p><?php echo $totalObat; ?> Obat</p>
          </div>
          <div class="summary-box">
            <h3>Total Pasien</h3>
            <p><?php echo $totalPatients; ?> Pasien</p>
          </div>
        </div>
      </div>
    </div>

    <?php include "../../layouts/footer.php"; ?>
  </div>

  <?php include "../../layouts/pluginsexport.php"; ?>
</body>

</html>

<?php include '../../layouts/index.php'; ?>