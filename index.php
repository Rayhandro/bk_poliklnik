<?php
session_start();

$muncul = false;
$arah = null;

if (isset($_SESSION['login'])) {
  $muncul = true;
  $arah = $_SESSION['akses'];
}if (isset($_SESSION['signup'])) {
  $muncul = true;
  $arah = $_SESSION['akses'];
}
?>

<?php
$title = 'BK_Poli';
if ($muncul) :

  include_once './layouts/welcome.php';
else:
  include_once './layouts/welcome.php';
endif ?>
