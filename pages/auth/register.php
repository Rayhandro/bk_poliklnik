<?php
session_start();
include_once("../../config/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = htmlspecialchars($_POST['nama']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $no_ktp = htmlspecialchars($_POST['no_ktp']);
  $no_hp = htmlspecialchars($_POST['no_hp']);

  // Cek apakah pasien sudah terdaftar berdasarkan nomor KTP menggunakan prepared statements
  $check_pasien = $conn->prepare("SELECT id, nama, no_rm FROM pasien WHERE no_ktp = ?");
  $check_pasien->bind_param("s", $no_ktp);
  $check_pasien->execute();
  $result_check_pasien = $check_pasien->get_result();

  if ($result_check_pasien->num_rows > 0) {
    $row = $result_check_pasien->fetch_assoc();
    if ($row['nama'] != $nama) {
      echo "<script>alert('Nama pasien tidak sesuai dengan nomor KTP yang terdaftar.');</script>";
      echo "<meta http-equiv='refresh' content='0; url=register.php'>";
      die();
    }
    $_SESSION['signup'] = true;
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $nama;
    $_SESSION['no_rm'] = $row['no_rm'];
    $_SESSION['akses'] = 'pasien';

    echo "<meta http-equiv='refresh' content='0; url=../pasien'>";
    die();
  }

  // Mendapatkan nomor pasien terakhir
  $get_rm = $conn->prepare("SELECT MAX(SUBSTRING(no_rm, 8)) AS last_queue_number FROM pasien");
  $get_rm->execute();
  $result_rm = $get_rm->get_result();

  if ($result_rm->num_rows > 0) {
    $row_rm = $result_rm->fetch_assoc();
    $lastQueueNumber = $row_rm['last_queue_number'] ? $row_rm['last_queue_number'] : 0;
  } else {
    $lastQueueNumber = 0;
  }
  $tahun_bulan = date("Ym");
  $newQueueNumber = $lastQueueNumber + 1;
  $no_rm = $tahun_bulan . "-" . str_pad($newQueueNumber, 3, '0', STR_PAD_LEFT);

  $insert = $conn->prepare("INSERT INTO pasien (nama, alamat, no_ktp, no_hp, no_rm) VALUES (?, ?, ?, ?, ?)");
  $insert->bind_param("sssss", $nama, $alamat, $no_ktp, $no_hp, $no_rm);

  if ($insert->execute()) {
    $_SESSION['signup'] = true;
    $_SESSION['id'] = $insert->insert_id;
    $_SESSION['username'] = $nama;
    $_SESSION['no_rm'] = $no_rm;
    $_SESSION['akses'] = 'pasien';

    echo "<meta http-equiv='refresh' content='0; url=../pasien'>";
    die();
  } else {
    echo "Error: " . $insert->error;
  }

  $insert->close();
  $check_pasien->close();
  $get_rm->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poliklinik | Registration Page</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <style>
    .bg-image-vertical {
      position: relative;
      overflow: hidden;
      background-repeat: no-repeat;
      background-position: right center;
      background-size: auto 100%;
    }
    @media (min-width: 1025px) {
      .h-custom-2 {
        height: 100%;
      }
    }
  </style>
</head>
<body>
<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">
        <div class="px-5 ms-xl-4">
          <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
          <span class="h1 fw-bold mb-0">BK-Poliklinik</span>
        </div>
        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
          <form style="width: 23rem;" action="" method="post">
            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register Pasien</h3>

            <div class="form-outline mb-4">
              <input type="text" id="nama" class="form-control form-control-lg" name="nama" required />
              <label class="form-label" for="nama">Full name</label>
            </div>

            <div class="form-outline mb-4">
              <input type="text" id="alamat" class="form-control form-control-lg" name="alamat" required />
              <label class="form-label" for="alamat">Alamat</label>
            </div>

            <div class="form-outline mb-4">
              <input type="number" id="no_ktp" class="form-control form-control-lg" name="no_ktp" required />
              <label class="form-label" for="no_ktp">No KTP</label>
            </div>

            <div class="form-outline mb-4">
              <input type="number" id="no_hp" class="form-control form-control-lg" name="no_hp" required />
              <label class="form-label" for="no_hp">No HP</label>
            </div>

            <div class="form-check mb-4">
              <input class="form-check-input" type="checkbox" id="agreeTerms" name="terms" value="agree" required />
              <label class="form-check-label" for="agreeTerms">I agree to the <a href="#">terms</a></label>
            </div>

            <div class="pt-1 mb-4">
              <button class="btn btn-info btn-lg btn-block" type="submit">Register</button>
            </div>

           
          </form>
        </div>
      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="data:image/jpeg;base64,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"
          alt="Registration image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</section>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
