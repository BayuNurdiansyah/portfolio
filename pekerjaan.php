<?php require_once 'config/db.php';
 ?>
<?php
$data = mysqli_query($conn, "SELECT * FROM pekerjaan ORDER BY tahun_masuk ASC");

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pekerjaan | Ahmad Bayu Nurdiansyah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php include 'layouts/navbar.php';
 ?>

<div class="container page-wrapper">
  <p class="section-title">Riwayat Pekerjaan</p>
  <div class="title-line"></div>

  <?php
  // Kelompokkan per perusahaan
  $companies = [];

  while($row = mysqli_fetch_assoc($data)) {
    $companies[$row['perusahaan']][] = $row;
  }
  ?>

  <div class="row g-4">
    <?php foreach($companies as $company => $jobs): ?>
    <div class="col-lg-6">
      <div class="card-dark h-100">
        <p class="label-red mb-3">
          <i class="fa fa-building me-2"></i><?= htmlspecialchars($company) ?>
        </p>
        <div class="timeline ps-3">
          <?php foreach($jobs as $job): ?>
          <div class="timeline-item">
            <div class="timeline-dot"></div>
            <p class="timeline-year mb-0" style="margin-left: 8px;">
              <?= $job['tahun_masuk'] ?> — <?= $job['tahun_keluar'] ?>
            </p>
            <p class="timeline-title mb-0" style="margin-left: 8px;"><?= htmlspecialchars($job['posisi']) ?></p>
            <?php if($job['deskripsi']): ?>
            <p class="timeline-sub"><?= htmlspecialchars($job['deskripsi']) ?></p>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include 'layouts/footer.php';
 ?>
<style>
    .timeline {
        position:relative;
        padding-left:30px
    }
    .timeline::before {
        content:'';
        position:absolute;
        left:10px;
        top:0;
        bottom:0;
        width:2px;
        background:linear-gradient(180deg,#e00000,transparent)
    }
    .timeline-item {
        position:relative;
        margin-bottom:1.5rem
    }
    .timeline-dot {
        position:absolute;
        left:-26px;
        top:6px;
        width:10px;
        height:10px;
        border-radius:50%;
        background:#e00000;
        box-shadow:0 0 8px #ff2222
    }
    .timeline-year {
        font-family:'Orbitron',monospace;
        font-size:.72rem;
        color:#e00000;
        letter-spacing:2px
    }
    .timeline-title {
        font-size:1rem;
        font-weight:700;
        color:#f0f0f0
    }
    .timeline-sub {
        font-size:.88rem;
        color:#888;
        margin-top:2px
    }
</style>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>