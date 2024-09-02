<?php
session_start();
include_once("../../config/conn.php");

if (isset($_SESSION['login'])) {
  echo "<meta http-equiv='refresh' content='0; url=../..'>";
  die();
}

if (isset($_POST['klik'])) {
  $username = stripslashes($_POST['nama']);
  $password = $_POST['alamat'];
  if ($username == 'admin') {
    if ($password == 'admin') {
      $_SESSION['login'] = true;
      $_SESSION['id'] = null;
      $_SESSION['username'] = 'admin';
      $_SESSION['akses'] = 'admin';
      echo "<meta http-equiv='refresh' content='0; url=../admin'>";
      die();
    }
  } else {
    $cek_username = $pdo->prepare("SELECT * FROM dokter WHERE nama = '$username'; ");
    try{
        $cek_username->execute();
        if($cek_username->rowCount()==1){
            $baris = $cek_username->fetchAll(PDO::FETCH_ASSOC);
            if($password == $baris[0]['alamat']){
              $_SESSION['login'] = true;
              $_SESSION['id'] = $baris[0]['id'];
              $_SESSION['username'] = $baris[0]['nama'];
              $_SESSION['akses'] = 'dokter';
              echo "<meta http-equiv='refresh' content='0; url=../dokter/index.php'>";
              die();
            }
        }
    } catch(PDOException $e){
      $_SESSION['error'] = $e->getMessage();
      echo "<meta http-equiv='refresh' content='0;'>";
      die();
    }
  }
  $_SESSION['error'] = 'Username dan Password Tidak Cocok';
  echo "<meta http-equiv='refresh' content='0;'>";
  die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poliklinik | Log in</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-image: url('https://img-cdn.medkomtek.com/a27TX565evz8amFQ63-qJq1nV6g=/730x411/smart/filters:quality(100):format(webp)/article/g23-oe-NgIqd4v1RwqSdY/original/029652700_1508145627-Lakukan-5-Hal-Ini-saat-Konsultasi-ke-Dokter.jpg');
      background-size: cover;
      background-position: center;
    }
    .container {
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      display: flex;
      overflow: hidden;
      width: 800px;
      max-width: 100%;
    }
    .left-box {
      background-color:#11B69F;
      color: #fff;
      padding: 40px 20px;
      text-align: center;
      flex: 1;
    }
    .right-box {
      padding: 40px 30px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background-color: rgba(255, 255, 255, 0.8); /* background color with opacity */
    }
    .left-box h1 {
      font-family: 'Montserrat', sans-serif;
      font-size: 28px;
      margin-bottom: 20px;
    }
    .form-control {
      width: 100%;
      padding: 15px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 50px;
      box-sizing: border-box;
    }
    .btn-primary {
      background-color: #11B69F;
      color: #fff;
      padding: 15px;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      width: 100%;
      box-sizing: border-box;
    }
    .btn-primary:hover {
      background-color: #0e9785;
    }
    .alert {
      background-color: #11B69F;
      color: #842029;
      padding: 10px;
      border-radius: 50px;
      text-align: center;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="left-box">
    <h1 class="fw-bold">BK-Poliklinik</h1>
    <p>Login untuk Dokter</p>
  </div>
  <div class="right-box">
    <?php if (isset($message)) { ?>
      <div class="alert"><?php echo $message; ?></div>
    <?php } ?>
    <form method="POST">
      <input type="text" name="nama" class="form-control" placeholder="Username" required />
      <input type="password" name="alamat" class="form-control" placeholder="Password" required />
      <button type="submit" name="klik" class="btn-primary">Sign In</button>
    </form>
  </div>
</div>
</body>
</html>

