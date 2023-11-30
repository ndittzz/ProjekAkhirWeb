<?php
session_start();
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail</title>

  <!-- Tamplate -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
  <!-- ICONS BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <!-- Favicon -->
  <link rel="shortcut icon" href="images/favicon.png" type="" />
  <!-- CSS -->
  <link rel="stylesheet" href="style.css">
  <link href="css/style.css" rel="stylesheet" />
</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar bg-grey py-2 px-5 shadow-lg d-flex align-items-center">
  <h1 class="my-2 text-putih fs-2">Dapur Kita</h1>
    <div class="d-flex gap-4">
      <a class="text-decoration-none text-light nav-item" href="index.php">Home</a>
      <a class="text-decoration-none text-light nav-item" href="menu.php">Resep</a>
    </div>

    <div class="user_option">
      <form class="form-inline">
        <button class="btn my-2 my-sm-0 nav_search-btn" type="submit">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </form>
      <a href="login.php" class="order_online"> Login </a>
    </div>

  </nav>
  <!-- END NAVBAR -->

  <!-- Main Section -->
  <?php
  $id_resep = $_GET["id_resep"];

  $query = "SELECT * FROM users u, resep r WHERE u.id_user = r.id_user AND r.id_resep = $id_resep";


  $hasil = mysqli_query($konek, $query);

  if (mysqli_num_rows($hasil) === 0) {
    // Nanti dirapikan lagi buat control handlingnya
    echo "<h1>Data tidak ada / Terjadi Kesalahan</h1>";
    die;
  }
  $data = mysqli_fetch_array($hasil);
  ?>
  <section class="container d-flex flex-column gap-4 pt-4 pb-5">
    <img src="./img/resep/<?= $data['foto'] ?>" alt="Foto Resep" class="gambar-resep rounded-4 shadow-lg">
    <div class="kotak shadow">
      <h4><?= $data['judul'] ?></h4>
      <p class="m-0">By. <?= $data['namaLengkap'] ?></p>
      <p class="m-0 pt-2"> <?= $data['deskripsi'] ?></p>
    </div>
    <div class="kotak shadow d-flex flex-column gap-1">
      <h5>Bahan-bahan</h5>
      <div class="garis"></div>
      <p class="m-0">
        <?= $data['bahan_bahan'] ?>
      </p>
    </div>
    <div class="kotak shadow d-flex flex-column gap-1">
      <h5>Cara Pembuatan</h5>
      <div class="garis"></div>
      <p class="m-0">
        <?= $data['cara_pembuatan'] ?>
      </p>
    </div>
    <div class="kotak shadow">
      <h5>Ditulis Oleh</h5>
      <div class="garis"></div>
      <div class="d-flex gap-3 justify-content-start align-items-center mb-2">
        <img src="img/profile/<?= $data['profilePicture'] ?>" alt="" class="profileDitulis">
        <div>
          <h6 class="fs-5 mb-0"><?= $data['namaLengkap'] ?></h6>
          <p class="m-0">pada <?= date('d F Y', strtotime($data['tgl_pembuatan'])) ?> </p>
        </div>
      </div>
      <p class="my-0"> <?= $data['headline'] ?></p>

    </div>
    <div class="kotak shadow">
      <div class="d-flex justify-content-between align-items-center">
        <h5>Resep lain dari penulis</h5>
        <i class="bi bi-arrow-right fs-3 fw-bold cursor-pointer cursor-pointer"></i>
      </div>
      <div class="garis"></div>
      <div class="d-flex flex-wrap gap-3">
        <?php
        $id_user = $data['id_user'];
        $query = "SELECT foto, judul FROM resep WHERE id_user = $id_user";
        $hasil = mysqli_query($konek, $query);
        while ($resep = mysqli_fetch_array($hasil)) :
        ?>
          <div class="bg-grey border-radius-15px">
            <img src="img/resep/<?= $resep['foto'] ?>" alt="" class="gambar-card">
            <p class="my-1 py-1 text-wrap text-center text-putih"><?= $resep['judul'] ?></p>
          </div>
        <?php endwhile; ?>

      </div>
    </div>
  </section>

  <!-- FOOTER SECTIOn -->
  <!-- COPAS DARI TAMPLATE -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>Hubungi Kami</h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span> WA 08123456789 </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span> dapurkita@gmail.com </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="homepage.php" class="footer-logo"> Dapur Kita </a>
            <p style="text-align: justify">
              Dapur Kita, sumber inspirasi kuliner penuh kreativitas! Temukan
              resep-resep lezat dari berbagai masakan, ikuti tips ahli, dan
              jalin komunitas dengan sesama pecinta masak.
            </p>
            <br />
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-pinterest" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>Apa yang pembuat katakan</h4>
          <p>Selamat memasak!</p>
          <p>SEMANGAT!</p>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> Dibuat oleh
          <a href="https://themewagon.com/" target="_blank">Dapur Kita</a>
        </p>
      </div>
    </div>
  </footer>

</body>

</html>