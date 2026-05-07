<?php require_once 'config/db.php';
 ?>
<?php
$data = mysqli_query($conn, "SELECT * FROM techstack ORDER BY kategori, nama");

$stacks = [];

while($row = mysqli_fetch_assoc($data)) {

  $stacks[$row['kategori']][] = $row;


}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tech Stack | Ahmad Bayu Nurdiansyah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php include 'layouts/navbar.php';
 ?>

<div class="container page-wrapper">
  <p class="section-title">Tech Stack</p>
  <div class="title-line"></div>

  <?php foreach($stacks as $kategori => $items): ?>
  <div class="mb-5">
    <p class="label-red mb-3">
      <i class="fa fa-layer-group me-2"></i><?= htmlspecialchars($kategori) ?>
    </p>
    <div class="tech-grid">
      <?php foreach($items as $item): ?>
      <div class="tech-card">
        <img src="<?= htmlspecialchars($item['logo_url']) ?>"
             alt="<?= htmlspecialchars($item['nama']) ?>">
        <p class="tech-name"><?= htmlspecialchars($item['nama']) ?></p>
        <p class="tech-cat"><?= htmlspecialchars($item['kategori']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<?php include 'layouts/footer.php';
 ?>
<style>
    .tech-grid {
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(110px,1fr));
        gap:1rem
    }
    .tech-card {
        background:#1a1a1a;
        border:1px solid rgba(224,0,0,0.3);
        border-radius:8px;
        padding:1.2rem .8rem;
        text-align:center;
        transition:all .3s
    }
    .tech-card:hover {
        border-color:#ff2222;
        box-shadow:0 0 15px rgba(224,0,0,0.25);
        transform:translateY(-3px)
    }
    .tech-card img {
        width:38px;
        height:38px;
        object-fit:contain;
        margin-bottom:.6rem;
        filter:drop-shadow(0 0 4px rgba(224,0,0,0.3))
    }
    .tech-name {
        font-size:.78rem;
        font-weight:700;
        color:#f0f0f0;
        margin-bottom:2px
    }
    .tech-cat {
        font-size:.65rem;
        color:#e00000;
        text-transform:uppercase;
        letter-spacing:1px;
        margin:0
    }
</style>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>