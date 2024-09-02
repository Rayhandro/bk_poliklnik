<?php
include_once("../../../config/conn.php");
session_start();

if (!isset($_SESSION['login'])) {
  echo "<meta http-equiv='refresh' content='0; url=../auth/login.php'>";
  die();
}

$nama = $_SESSION['username'];
$akses = $_SESSION['akses'];

if ($akses != 'dokter') {
  echo "<meta http-equiv='refresh' content='0; url=../..'>";
  die();
}

if (!isset($_GET['pasien_id'])) {
  echo "<meta http-equiv='refresh' content='0; url=index.php'>";
  die();
}

$pasien_id = $_GET['pasien_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Poliklinik | Riwayat Pasien</title>
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="path/to/adminlte.min.css">
  <!-- Bootstrap CSS (included with AdminLTE) -->
  <link rel="stylesheet" href="path/to/bootstrap.min.css">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="wrapper">
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Riwayat Pasien</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= $base_dokter; ?>">Home</a></li>
                <li class="breadcrumb-item active">Riwayat Pasien</li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Detail Riwayat Pasien</h3>
          </div>
          <div class="card-body">
            <?php
            $data2 = $pdo->query("SELECT 
                                    p.nama AS 'nama_pasien',
                                    pr.*,
                                    d.nama AS 'nama_dokter',
                                    dpo.keluhan AS 'keluhan',
                                    GROUP_CONCAT(o.nama_obat SEPARATOR ', ') AS 'obat'
                                FROM periksa pr
                                LEFT JOIN daftar_poli dpo ON (pr.id_daftar_poli = dpo.id)
                                LEFT JOIN jadwal_periksa jp ON (dpo.id_jadwal = jp.id)
                                LEFT JOIN dokter d ON (jp.id_dokter = d.id)
                                LEFT JOIN pasien p ON (dpo.id_pasien = p.id)
                                LEFT JOIN detail_periksa dp ON (pr.id = dp.id_periksa)
                                LEFT JOIN obat o ON (dp.id_obat = o.id)
                                WHERE dpo.id_pasien = '$pasien_id'
                                GROUP BY pr.id
                                ORDER BY pr.tgl_periksa DESC;");
            ?>
            <?php if ($data2->rowCount() == 0) : ?>
              <h5>Tidak Ditemukan Riwayat Periksa</h5>
            <?php else : ?>
              <div class="grid-container">
                <div class="grid-item">No</div>
                <div class="grid-item">Tanggal Periksa</div>
                <div class="grid-item">Nama Pasien</div>
                <div class="grid-item">Nama Dokter</div>
                <div class="grid-item">Keluhan</div>
                <div class="grid-item">Catatan</div>
                <div class="grid-item">Obat</div>
                <div class="grid-item">Biaya Periksa</div>
                <?php $no = 1; ?>
                <?php while ($da = $data2->fetch()) : ?>
                  <div class="grid-item"><?= $no++; ?></div>
                  <div class="grid-item"><?= $da['tgl_periksa']; ?></div>
                  <div class="grid-item"><?= $da['nama_pasien']; ?></div>
                  <div class="grid-item"><?= $da['nama_dokter']; ?></div>
                  <div class="grid-item"><?= $da['keluhan']; ?></div>
                  <div class="grid-item"><?= $da['catatan']; ?></div>
                  <div class="grid-item"><?= $da['obat']; ?></div>
                  <div class="grid-item"><?= formatRupiah($da['biaya_periksa']); ?></div>
                <?php endwhile ?>
              </div>
            <?php endif ?>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>
</html>
<?php include '../../../layouts/index.php'; ?>
