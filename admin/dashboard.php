<?php require_once '../config/db.php'; ?>
<?php
    session_start();
    if(!isset($_SESSION['admin'])){ header('Location: ../login.php'); exit; }
?>
<?php
$jml_pendidikan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM pendidikan"))['c'];
$jml_pekerjaan  = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM pekerjaan"))['c'];
$jml_organisasi = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM organisasi"))['c'];
$jml_techstack = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM techstack"))['c'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark fixed-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <span style="color:#e00000">&lt;</span>Admin<span style="color:#e00000">/&gt;</span>
    </a>
    <div class="d-flex gap-2">
      <a href="../index.php" class="btn btn-outline-danger btn-sm">
        <i class="fa fa-globe me-1"></i> Website
      </a>
      <a href="logout.php" class="btn btn-danger btn-sm">
        <i class="fa fa-sign-out-alt me-1"></i> Logout
      </a>
    </div>
  </div>
</nav>

<div class="container page-wrapper">
  <p class="section-title">Dashboard Admin</p>
  <div class="title-line"></div>

  <div class="row g-4 mb-5">
    <?php
    $menu = [
      ['icon'=>'fa-graduation-cap','label'=>'Pendidikan','val'=>$jml_pendidikan,'href'=>'pendidikan/index.php','color'=>'#e00000'],
      ['icon'=>'fa-briefcase','label'=>'Pekerjaan','val'=>$jml_pekerjaan,'href'=>'pekerjaan/index.php','color'=>'#e00000'],
      ['icon'=>'fa-users','label'=>'Organisasi','val'=>$jml_organisasi,'href'=>'organisasi/index.php','color'=>'#e00000'],
      ['icon'=>'fa-code','label'=>'Tech Stack','val'= >$jml_techstack,'href'=>'techstack/index.php','color'=>'#e00000'],
    ];
    foreach($menu as $m): ?>
    <div class="col-md-4">
      <div class="card-dark text-center">
        <i class="fa <?= $m['icon'] ?> fa-2x mb-2" style="color:#e00000"></i>
        <h2 class="fw-bold" style="font-family:'Orbitron',monospace;color:#e00000"><?= $m['val'] ?></h2>
        <p class="text-main mb-3"><?= $m['label'] ?></p>
        <a href="<?= $m['href'] ?>" class="btn btn-danger btn-sm w-100">
          <i class="fa fa-cog me-1"></i> Kelola <?= $m['label'] ?>
        </a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <div class="row g-4 mt-2">
    <div class="col-12">
        <div class="card-dark d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <?php
            $b = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM biodata LIMIT 1"));
            $fp = $b['foto_local'] ? 'assets/img/'.$b['foto_local'] : $b['foto'];
            ?>
            <img src="<?= htmlspecialchars($fp) ?>" alt="foto"
                style="width:50px;height:50px;border-radius:50%;object-fit:cover;border:2px solid #e00000;"
                onerror="this.src='https://ui-avatars.com/api/?name=Ahmad+Bayu&size=50&background=1a1a1a&color=e00000&bold=true'">
            <div>
            <p class="fw-bold mb-0" style="color:#f0f0f0"><?= htmlspecialchars($b['nama']) ?></p>
            <p class="text-main small mb-0">Edit foto profil</p>
            </div>
        </div>
        <a href="profil/index.php" class="btn btn-danger btn-sm px-4">
            <i class="fa fa-camera me-2"></i>Edit Foto
        </a>
        </div>
    </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>