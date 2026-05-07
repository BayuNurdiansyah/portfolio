<?php
session_start();
if(!isset($_SESSION['admin'])){ header('Location: ../../admin/login.php'); exit; }
require_once '../../config/db.php';
$folder_img = '../../assets/img/';
if(!is_dir($folder_img)){
  mkdir($folder_img, 0755, true);
}
$biodata = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM biodata LIMIT 1"));

if($_SERVER['REQUEST_METHOD']==='POST'){
  $foto = $biodata['foto'];

  if(!empty($_FILES['foto']['name'])){
    $ext      = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $filename = 'foto-bayu-'.time().'.'.$ext;
    $target   = '../../assets/img/'.$filename;
    $allowed  = ['png','jpg','jpeg','webp'];
    if(in_array(strtolower($ext), $allowed)){
      // Hapus foto lama
      if($foto && file_exists('../../assets/img/'.$foto)){
        unlink('../../assets/img/'.$foto);
      }
      move_uploaded_file($_FILES['foto']['tmp_name'], $target);
      $foto = mysqli_real_escape_string($conn, $filename);
      mysqli_query($conn,"UPDATE biodata SET foto='$foto' WHERE id={$biodata['id']}");
      header('Location: index.php?msg=Foto berhasil diupdate'); exit;
    } else {
      $error = 'Format file tidak didukung. Gunakan PNG/JPG/WEBP.';
    }
  }
}

$foto_preview = $biodata['foto'];
?>
<!DOCTYPE html><html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Edit Profil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="../../assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark fixed-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../dashboard.php"><span style="color:#e00000">&lt;</span>Admin<span style="color:#e00000">/&gt;</span></a>
    <a href="../dashboard.php" class="btn btn-outline-danger btn-sm"><i class="fa fa-arrow-left me-1"></i> Dashboard</a>
  </div>
</nav>

<div class="container page-wrapper">
  <p class="section-title">Edit Foto Profil</p>
  <div class="title-line"></div>

  <?php if(isset($_GET['msg'])): ?>
  <div class="alert alert-dismissible fade show mb-3 py-2" role="alert" style="background:rgba(0,200,0,0.1);border:1px solid green;color:#0f0">
    <?= htmlspecialchars($_GET['msg']) ?>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" style="padding:0.25rem;font-size:0.65rem;"></button>
  </div>
  <?php endif; ?>
  <?php if(isset($error)): ?>
  <div class="alert alert-dismissible fade show mb-3 py-2" role="alert" style="background:rgba(224,0,0,0.1);border:1px solid #e00000;color:#ff6666">
    <?= $error ?>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" style="padding:0.25rem;font-size:0.65rem;"></button>
  </div>
  <?php endif; ?>

  <div class="row justify-content-center">
    <div class="col-lg-5">
      <div class="card-dark text-center">

        <!-- Preview foto -->
        <div class="mb-4">
          <div class="hero-photo-wrapper d-inline-block">
            <img id="previewImg" src="../../<?= htmlspecialchars($foto_preview) ?>"
                 alt="Foto Profil" class="hero-photo"
                 onerror="this.src='https://ui-avatars.com/api/?name=Ahmad+Bayu&size=220&background=1a1a1a&color=e00000&bold=true'">
          </div>
          <p class="text-main small mt-3 mb-0">Foto profil saat ini</p>
        </div>

        <form method="POST" enctype="multipart/form-data">
          <div class="mb-4 text-start">
            <label class="form-label text-main small">UPLOAD FOTO BARU</label>
            <input type="file" name="foto" id="fotoInput" class="form-control admin-input"
                   accept=".png,.jpg,.jpeg,.webp" required>
            <p class="text-main mt-1" style="font-size:.75rem;">Format: PNG, JPG, WEBP. Maks 2MB.</p>
          </div>
          <button type="submit" class="btn btn-danger w-100 fw-bold">
            <i class="fa fa-save me-2"></i>Simpan Foto
          </button>
        </form>

      </div>
    </div>
  </div>
</div>

<style>
    .admin-input {
        background:#1a1a1a;
        border:1px solid rgba(224,0,0,0.3);
        color:#f0f0f0;
        border-radius:6px;
    }
    .admin-input:focus {
        background:#1a1a1a;
        border-color:#e00000;
        color:#f0f0f0;
        box-shadow:0 0 0 2px rgba(224,0,0,0.2)
    }
</style>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
$('#fotoInput').on('change', function(){
  const file = this.files[0];
  if(file){
    const reader = new FileReader();
    reader.onload = e => { $('#previewImg').attr('src', e.target.result); };
    reader.readAsDataURL(file);
  }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>