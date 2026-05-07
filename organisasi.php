<?php require_once 'config/db.php';
 ?>
<?php
$data = mysqli_query($conn, "SELECT * FROM organisasi ORDER BY id ASC");

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Organisasi | Ahmad Bayu Nurdiansyah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php include 'layouts/navbar.php'; ?>

<div class="container page-wrapper">
  <p class="section-title">Riwayat Organisasi</p>
  <div class="title-line"></div>

  <div class="row g-4 justify-content-center">
    <?php while($row = mysqli_fetch_assoc($data)): ?>
    <div class="col-lg-6">
      <div class="card-dark">
        <div class="d-flex align-items-start gap-3">
          <div class="mt-1">
            <i class="fa fa-users fa-2x" style="color:#e00000"></i>
          </div>
          <div>
            <p class="timeline-year mb-1"><?= htmlspecialchars($row['tahun']) ?></p>
            <p class="timeline-title mb-1"><?= htmlspecialchars($row['posisi']) ?></p>
            <p class="timeline-sub mb-1"><?= htmlspecialchars($row['nama_org']) ?></p>
            <span class="badge" style="background:rgba(224,0,0,0.15);border:1px solid #e00000;color:#ff6666;font-size:.75rem;
">
              <i class="fa fa-map-marker-alt me-1"></i><?= htmlspecialchars($row['lokasi']) ?>
            </span>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<?php include 'layouts/footer.php'; ?>
<style>
    .timeline-year {
        font-family:'Orbitron',monospace;
        font-size:.75rem;
        color:#e00000;
        letter-spacing:2px
    }
    .timeline-title {
        font-size:1.05rem;
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