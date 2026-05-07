<?php 
    require_once '../../config/db.php';
    session_start();
    if(!isset($_SESSION['admin'])){ header('Location: ../../admin/login.php'); exit; }
?>
<?php
$id  = (int)$_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM organisasi WHERE id=$id"));
if(!$row){ header('Location: index.php'); exit; }
if($_SERVER['REQUEST_METHOD']==='POST'){
  $nama_org = mysqli_real_escape_string($conn,$_POST['nama_org']);
  $posisi   = mysqli_real_escape_string($conn,$_POST['posisi']);
  $tahun    = mysqli_real_escape_string($conn,$_POST['tahun']);
  $lokasi   = mysqli_real_escape_string($conn,$_POST['lokasi']);
  mysqli_query($conn,"UPDATE organisasi SET nama_org='$nama_org',posisi='$posisi',tahun='$tahun',lokasi='$lokasi' WHERE id=$id");
  header('Location: index.php?msg=Data berhasil diupdate'); exit;
}
?>
<!DOCTYPE html><html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Edit Organisasi</title>
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
  <p class="section-title">Edit Organisasi</p>
  <div class="title-line"></div>
  <div class="row justify-content-center"><div class="col-lg-6">
    <div class="card-dark">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label text-muted small">NAMA ORGANISASI</label>
          <input type="text" name="nama_org" class="form-control admin-input" value="<?= htmlspecialchars($row['nama_org']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label text-muted small">POSISI / JABATAN</label>
          <input type="text" name="posisi" class="form-control admin-input" value="<?= htmlspecialchars($row['posisi']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label text-muted small">TAHUN</label>
          <input type="text" name="tahun" class="form-control admin-input" value="<?= htmlspecialchars($row['tahun']) ?>" required>
        </div>
        <div class="mb-4">
          <label class="form-label text-muted small">LOKASI</label>
          <input type="text" name="lokasi" class="form-control admin-input" value="<?= htmlspecialchars($row['lokasi']) ?>" required>
        </div>
        <button type="submit" class="btn btn-danger w-100 fw-bold"><i class="fa fa-save me-2"></i>Update</button>
      </form>
    </div>
  </div></div>
</div>
<style>.admin-input{background:#1a1a1a;border:1px solid rgba(224,0,0,0.3);color:#f0f0f0;border-radius:6px}.admin-input:focus{background:#1a1a1a;border-color:#e00000;color:#f0f0f0;box-shadow:0 0 0 2px rgba(224,0,0,0.2)}</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body></html>