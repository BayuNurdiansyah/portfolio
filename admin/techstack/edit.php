<?php
session_start();
if(!isset($_SESSION['admin'])){ header('Location: ../../admin/login.php'); exit; }
require_once '../../config/db.php';

$id  = (int)$_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM techstack WHERE id=$id"));
if(!$row){ header('Location: index.php'); exit; }

if($_SERVER['REQUEST_METHOD']==='POST'){
  $nama     = mysqli_real_escape_string($conn,$_POST['nama']);
  $kategori = mysqli_real_escape_string($conn,$_POST['kategori']);
  $logo_url = mysqli_real_escape_string($conn,$_POST['logo_url']);
  $logo_local = $row['logo_local'];

  if(!empty($_FILES['logo_local']['name'])){
    $ext      = pathinfo($_FILES['logo_local']['name'], PATHINFO_EXTENSION);
    $filename = strtolower(str_replace(' ','-',$nama)).'-'.time().'.'.$ext;
    $target   = '../../assets/img/techstack/'.$filename;
    $allowed  = ['png','jpg','jpeg','svg','webp'];
    if(in_array(strtolower($ext),$allowed)){
      // Hapus file lama
      if($logo_local && file_exists('../../assets/img/techstack/'.$logo_local)){
        unlink('../../assets/img/techstack/'.$logo_local);
      }
      move_uploaded_file($_FILES['logo_local']['tmp_name'], $target);
      $logo_local = mysqli_real_escape_string($conn,$filename);
    }
  }

  mysqli_query($conn,"UPDATE techstack SET nama='$nama',logo_url='$logo_url',kategori='$kategori',logo_local='$logo_local' WHERE id=$id");
  header('Location: index.php?msg=Tech stack berhasil diupdate'); exit;
}

$logo_preview = $row['logo_local']
  ? '../../assets/img/techstack/'.$row['logo_local']
  : $row['logo_url'];
?>
<!DOCTYPE html><html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Edit Tech Stack</title>
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
  <p class="section-title">Edit Tech Stack</p>
  <div class="title-line"></div>
  <div class="row justify-content-center"><div class="col-lg-6">
    <div class="card-dark">
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label text-main small">NAMA</label>
          <input type="text" name="nama" class="form-control admin-input" value="<?= htmlspecialchars($row['nama']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label text-main small">KATEGORI</label>
          <select name="kategori" class="form-control admin-input" required>
            <?php
            $cats = ['Framework','Frontend','Library','Database','Runtime','Mobile','Tools','Language'];
            foreach($cats as $c):
            ?>
            <option value="<?= $c ?>" <?= $row['kategori']===$c?'selected':'' ?>><?= $c ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Preview current -->
        <div class="mb-3 text-center">
          <p class="text-main small mb-1">Logo Saat Ini:</p>
          <img id="previewImg" src="<?= htmlspecialchars($logo_preview) ?>" alt="logo"
               style="width:50px;height:50px;object-fit:contain;filter:drop-shadow(0 0 4px rgba(224,0,0,0.4))"
               onerror="this.src='https://via.placeholder.com/50x50/1a1a1a/e00000?text=?'">
        </div>

        <div class="mb-3">
          <label class="form-label text-main small">UPLOAD LOGO BARU (Opsional)</label>
          <input type="file" name="logo_local" class="form-control admin-input" accept=".png,.jpg,.jpeg,.svg,.webp">
        </div>
        <div class="mb-4">
          <label class="form-label text-main small">ATAU LOGO URL</label>
          <input type="text" name="logo_url" class="form-control admin-input" value="<?= htmlspecialchars($row['logo_url']) ?>">
        </div>

        <button type="submit" class="btn btn-danger w-100 fw-bold"><i class="fa fa-save me-2"></i>Update</button>
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
$('input[name="logo_local"]').on('change', function(){
  const file = this.files[0];
  if(file){
    const reader = new FileReader();
    reader.onload = e => { $('#previewImg').attr('src', e.target.result); };
    reader.readAsDataURL(file);
  }
});
$('input[name="logo_url"]').on('input', function(){
  if($(this).val()) $('#previewImg').attr('src', $(this).val());
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body></html>