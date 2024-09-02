<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Poliklinik</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="./dist/css/welcome_styles.css" rel="stylesheet" />
    <style>
        body {
            background-image:url("dist/img/download.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .navbar {
            background-color: #2373ff !important;
        }
        .card-custom {
            border: 2px solid black;
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.8);
        }
        .card-custom h2, .card-custom p {
            color: black;
        }
    </style>
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container px-5">
            <a class="navbar-brand fw-bold" href="">BK-Poliklinik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <?php if ($muncul) : ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="http://<?= $_SERVER['HTTP_HOST'] ?>/bk_poliklnik/pages/<?= $arah ?>">Dashboard</a></li>
                    </ul>
                </div>
            <?php endif ?>
        </div>
    </nav>
   
    <!-- Features section-->
    <?php if (!$muncul) : ?>
        <section class="py-5 border-bottom" id="features">
            <div class="container px-5 my-5">
                <div class="row gx-5 d-flex flex-column text-center">
                    <div class="col-lg-6 mb-5 mx-auto">
                        <div class="card card-custom p-4">
                            <h2 class="h4 fw-bolder">Registrasi Pasien</h2>
                            <p>Form Registrasi Pasien</p>
                            <a class="text-decoration-none" href="http://<?= $_SERVER['HTTP_HOST'] ?>/bk_poliklnik/pages/auth/register.php">
                                <button class="btn btn-primary">Registrasi Pasien</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5 mx-auto">
                        <div class="card card-custom p-4">
                            <h2 class="h4 fw-bolder">Login Dokter</h2>
                            <p>Form login untuk dokter</p>
                            <a class="text-decoration-none" href="http://<?= $_SERVER['HTTP_HOST'] ?>/bk_poliklnik/pages/auth/login.php">
                                <button class="btn btn-primary">Login Dokter</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
