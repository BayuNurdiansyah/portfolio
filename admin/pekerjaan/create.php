<?php 
    require_once '../../config/db.php';
    session_start();
    if(!isset($_SESSION['admin'])){ header('Location: ../../admin/login.php'); exit; }
?>
<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
  $perusahaan  = mysqli_real_escape_string($conn,$_POST['perusahaan']);
  $posisi      = mysqli_real_escape_string($conn,$_POST['posisi']);
  $tahun_masuk = (int)$_POST['tahun_masuk'];
  $tahun_keluar= mysqli_real_escape_string($conn,$_POST['tahun_keluar']);
  $deskripsi   = mysqli_real_escape_string($conn,$_POST['deskripsi']);
  mysqli_query($conn,"INSERT INTO pekerjaan (perusahaan,posisi,tahun_masuk,tahun_keluar,deskripsi)
    VALUES ('$perusahaan','$posisi',$tahun_masuk,'$tahun_keluar','$deskripsi')");
  header('Location: index.php?msg=Data berhasil ditambahkan'); 
  exit;
}
?>
<!DOCTYPE html><html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Tambah Pekerjaan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark fixed-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../dashboard.php"><span style="color:#e00000">&lt;</span>Admin<span style="color:#e00000">/&gt;</span></a>
    <a href="index.php" class="btn btn-outline-danger btn-sm"><i class="fa fa-arrow-left me-1"></i> Kembali</a>
  </div>
</nav>
<div class="container page-wrapper">
  <p class="section-title">Tambah Pekerjaan</p>
  <div class="title-line"></div>
  <div class="row justify-content-center"><div class="col-lg-6">
    <div class="card-dark">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label text-main small">PERUSAHAAN</label>
          <input type="text" name="perusahaan" class="form-control admin-input" required>
        </div>
        <div class="mb-3">
          <label class="form-label text-main small">POSISI</label>
          <input type="text" name="posisi" class="form-control admin-input" required>
        </div>
        <div class="row g-3 mb-3">
          <div class="col">
            <label class="form-label text-main small">TAHUN MASUK</label>
            <input type="number" name="tahun_masuk" class="form-control admin-input" required>
          </div>
          <div class="col">
            <label class="form-label text-main small">TAHUN KELUAR</label>
            <input type="text" name="tahun_keluar" class="form-control admin-input" placeholder="Sekarang">
          </div>
        </div>
        <div class="mb-4">
          <label class="form-label text-main small">DESKRIPSI</label>
          <textarea name="deskripsi" class="form-control admin-input" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-danger w-100 fw-bold"><i class="fa fa-save me-2"></i>Simpan</button>
      </form>
    </div>
  </div></div>
</div>
<style>.admin-input{background:#1a1a1a;border:1px solid rgba(224,0,0,0.3);color:#f0f0f0;border-radius:6px}.admin-input:focus{background:#1a1a1a;border-color:#e00000;color:#f0f0f0;box-shadow:0 0 0 2px rgba(224,0,0,0.2)}</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body></html>