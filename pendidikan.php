<?php require_once 'config/db.php';
 ?>
<?php
$data = mysqli_query($conn, "SELECT * FROM pendidikan ORDER BY tahun_masuk ASC");

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendidikan | Ahmad Bayu Nurdiansyah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php include 'layouts/navbar.php'; ?>

<div class="container page-wrapper">
  <p class="section-title">Riwayat Pendidikan</p>
  <div class="title-line"></div>

  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="timeline">
        <?php while($row = mysqli_fetch_assoc($data)): ?>
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="card-dark">
            <p class="timeline-year mb-1">
              <?= $row['tahun_masuk'] ?> — <?= $row['tahun_keluar'] ?? 'Sekarang' ?>
            </p>
            <p class="timeline-title mb-1"><?= htmlspecialchars($row['institusi']) ?></p>
            <?php if($row['keterangan']): ?>
            <p class="timeline-sub mb-0"><?= htmlspecialchars($row['keterangan']) ?></p>
            <?php endif; ?>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
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
        margin-bottom:2rem
    }
    .timeline-dot {
        position:absolute;
        left:-26px;
        top:18px;
        width:12px;
        height:12px;
        border-radius:50%;
        background:#e00000;
        box-shadow:0 0 10px #ff2222
    }
    .timeline-year {
        font-family:'Orbitron',monospace;
        font-size:.75rem;
        color:#e00000;
        letter-spacing:2px
    }
    .timeline-title {
        font-size:1.1rem;
        font-weight:700;
        color:#f0f0f0
    }
    .timeline-sub {
        font-size:.9rem;
        color:#888
    }
</style>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>