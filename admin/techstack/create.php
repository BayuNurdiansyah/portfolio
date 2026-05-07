<?php
session_start();
if(!isset($_SESSION['admin'])){ header('Location: ../../admin/login.php'); exit; }
require_once '../../config/db.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
  $nama      = mysqli_real_escape_string($conn,$_POST['nama']);
  $kategori  = mysqli_real_escape_string($conn,$_POST['kategori']);
  $logo_url  = mysqli_real_escape_string($conn,$_POST['logo_url']);
  $logo_local= '';

  if(!empty($_FILES['logo_local']['name'])){
    $ext      = pathinfo($_FILES['logo_local']['name'], PATHINFO_EXTENSION);
    $filename = strtolower(str_replace(' ','-',$nama)).'-'.time().'.'.$ext;
    $target   = '../../assets/img/techstack/'.$filename;
    $allowed  = ['png','jpg','jpeg','svg','webp'];
    if(in_array(strtolower($ext),$allowed)){
      move_uploaded_file($_FILES['logo_local']['tmp_name'], $target);
      $logo_local = mysqli_real_escape_string($conn,$filename);
    }
  }

  mysqli_query($conn,"INSERT INTO techstack (nama,logo_url,kategori,logo_local)
    VALUES ('$nama','$logo_url','$kategori','$logo_local')");
  header('Location: index.php?msg=Tech stack berhasil ditambahkan'); exit;
}
?>
<!DOCTYPE html><html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Tambah Tech Stack</title>
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
<div class="container page-wrapper py-5">
  <p class="section-title">Tambah Tech Stack</p>
  <div class="title-line"></div>
  <div class="row justify-content-center"><div class="col-lg-6">
    <div class="card-dark">
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label text-main small">NAMA</label>
          <input type="text" name="nama" class="form-control admin-input" required>
        </div>
        <div class="mb-3">
          <label class="form-label text-main small">KATEGORI</label>
          <select name="kategori" class="form-control admin-input" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="Framework">Framework</option>
            <option value="Frontend">Frontend</option>
            <option value="Library">Library</option>
            <option value="Database">Database</option>
            <option value="Runtime">Runtime</option>
            <option value="Mobile">Mobile</option>
            <option value="Tools">Tools</option>
            <option value="Language">Language</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label text-main small">UPLOAD LOGO (PNG/SVG/JPG)</label>
          <input type="file" name="logo_local" class="form-control admin-input" accept=".png,.jpg,.jpeg,.svg,.webp">
          <p class="text-main" style="font-size:.75rem;margin-top:4px;">Jika upload, logo lokal akan dipakai. Kosongkan jika pakai URL.</p>
        </div>
        <div class="mb-4">
          <label class="form-label text-main small">ATAU LOGO URL (CDN)</label>
          <input type="text" name="logo_url" class="form-control admin-input" placeholder="https://...">
        </div>

        <div class="mb-4 text-center" id="previewWrap" style="display:none!important;">
          <p class="text-main small mb-1">Preview Logo:</p>
          <img id="previewImg" src="" alt="preview" style="width:50px;height:50px;object-fit:contain;filter:drop-shadow(0 0 4px rgba(224,0,0,0.4))">
        </div>

        <button type="submit" class="btn btn-danger w-100 fw-bold"><i class="fa fa-save me-2"></i>Simpan</button>
      </form>
    </div>
  </div></div>
</div>
<style>
.admin-input{background:#1a1a1a;border:1px solid rgba(224,0,0,0.3);color:#f0f0f0;border-radius:6px}
.admin-input:focus{background:#1a1a1a;border-color:#e00000;color:#f0f0f0;box-shadow:0 0 0 2px rgba(224,0,0,0.2)}
select.admin-input option{background:#1a1a1a;color:#f0f0f0}
</style>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
// Preview gambar sebelum upload
$('input[name="logo_local"]').on('change', function(){
  const file = this.files[0];
  if(file){
    const reader = new FileReader();
    reader.onload = e => {
      $('#previewImg').attr('src', e.target.result);
      $('#previewWrap').css('display','block !important').show();
    };
    reader.readAsDataURL(file);
  }
});
// Preview dari URL
$('input[name="logo_url"]').on('input', function(){
  const url = $(this).val();
  if(url){ $('#previewImg').attr('src',url); $('#previewWrap').show(); }
  else { $('#previewWrap').hide(); }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body></html>