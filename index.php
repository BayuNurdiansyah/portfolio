<?php require_once 'config/db.php';
 ?>
<?php
$biodata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biodata LIMIT 1"));
$foto = $biodata['foto_local']
  ? 'assets/img/'.$biodata['foto_local']
  : $biodata['foto'];

$jml_pendidikan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM pendidikan"))['c'];

$jml_pekerjaan  = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM pekerjaan"))['c'];

$jml_organisasi = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM organisasi"))['c'];

$jml_techstack  = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM techstack"))['c'];

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio | Ahmad Bayu Nurdiansyah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php include 'layouts/navbar.php'; ?>

<section class="hero-section page-wrapper">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <p class="hero-tag">&#x2022;
 Open to Opportunities</p>
        <h1 class="hero-name">
          Ahmad <span style="color:#e00000">Bayu</span><br>Nurdiansyah
        </h1>
        <div class="d-flex flex-wrap align-items-center gap-2 my-3">
          <span class="skill-badge skill-mahir">PHP</span>
          <span class="skill-badge skill-mahir">JavaScript</span>
          <span class="skill-badge skill-mahir">Python</span>
          <span class="badge px-3 py-2" style="background:rgba(224,0,0,0.15);border:1px solid #e00000;color:#e00000;
">
            <i class="fa fa-map-marker-alt me-1"></i> Yogyakarta
          </span>
        </div>
        <p class="hero-focus"><?= htmlspecialchars($biodata['fokus']) ?></p>
        <div class="d-flex gap-3 mt-4">
          <a href="techstack.php" class="btn btn-danger px-4 py-2 fw-bold">
            <i class="fa fa-code me-2"></i>Tech Stack
          </a>
          <a href="pekerjaan.php" class="btn btn-outline-danger px-4 py-2 fw-bold">
            <i class="fa fa-briefcase me-2"></i>Pengalaman
          </a>
        </div>
      </div>
      <div class="col-lg-5 text-center">
        <div class="hero-photo-wrapper">
          <img src="<?= htmlspecialchars($foto) ?>"
          alt="Foto Ahmad Bayu" class="hero-photo"
          onerror="this.src='https://ui-avatars.com/api/?name=Ahmad+Bayu&size=220&background=1a1a1a&color=e00000&bold=true'">
        </div>
        <div class="mt-3">
          <span class="badge px-3 py-2" style="background:rgba(224,0,0,0.1);border:1px solid #e00000;color:#e00000;">
            <span class="blink-dot me-1">●</span> Web Developer
          </span>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <p class="section-title">Biodata</p>
    <div class="title-line"></div>
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card-dark h-100">
          <p class="label-red mb-3">IDENTITAS DIRI</p>
          <table class="bio-table w-100">
            <tr>
              <td><i class="fa fa-user me-2" style="color:#e00000"></i>Nama</td>
              <td><?= htmlspecialchars($biodata['nama']) ?></td>
            </tr>
            <tr>
              <td><i class="fa fa-calendar me-2" style="color:#e00000"></i>Lahir</td>
              <td><?= date('d F Y', strtotime($biodata['tgl_lahir'])) ?></td>
            </tr>
            <tr>
              <td><i class="fa fa-map-marker-alt me-2" style="color:#e00000"></i>Domisili</td>
              <td><?= htmlspecialchars($biodata['alamat']) ?></td>
            </tr>
            <tr>
              <td><i class="fa fa-heart me-2" style="color:#e00000"></i>Hobby</td>
              <td><?= htmlspecialchars($biodata['hobby']) ?></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card-dark h-100">
          <p class="label-red mb-3">FOKUS & SKILL</p>
          <p ><?= htmlspecialchars($biodata['fokus']) ?></p>
          <hr style="border-color:rgba(224,0,0,0.2)">
          <p class="label-red mb-2">BAHASA PEMROGRAMAN</p>
          <p class="text-main small mb-1">Mahir</p>
          <span class="skill-badge skill-mahir">PHP</span>
          <span class="skill-badge skill-mahir">JavaScript</span>
          <span class="skill-badge skill-mahir">Python</span>
          <p class="text-main small mb-1 mt-2">Menengah</p>
          <span class="skill-badge skill-menengah">Golang</span>
          <span class="skill-badge skill-menengah">Java</span>
          <p class="text-main small mb-1 mt-2">Pemula</p>
          <span class="skill-badge skill-pemula">Fox Pro</span>
        </div>
      </div>
    </div>

    <div class="row g-4 mt-2">
      <?php
      $stats = [
        ['icon'=>'fa-graduation-cap','label'=>'Riwayat Pendidikan','val'=>$jml_pendidikan,'href'=>'pendidikan.php'],
        ['icon'=>'fa-briefcase',     'label'=>'Riwayat Pekerjaan', 'val'=>$jml_pekerjaan, 'href'=>'pekerjaan.php'],
        ['icon'=>'fa-users',         'label'=>'Riwayat Organisasi','val'=>$jml_organisasi,'href'=>'organisasi.php'],
        ['icon'=>'fa-code',          'label'=>'Tech Stack',        'val'=>$jml_techstack, 'href'=>'techstack.php'],
      ];

      foreach($stats as $s): ?>
      <div class="col-6 col-lg-3 list-section">
        <a href="<?= $s['href'] ?>" class="text-decoration-none">
          <div class="card-dark text-center">
            <i class="fa <?= $s['icon'] ?> fa-2x mb-2" style="color:#e00000"></i>
            <h3 class="fw-bold mb-0" style="color:#e00000;font-family:'Orbitron',monospace;"><?= $s['val'] ?></h3>
            <p class="list-section small mb-0"><?= $s['label'] ?></p>
          </div>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include 'layouts/footer.php';
 ?>

<style>
  .blink-dot {
    animation:blink 1.2s infinite
    }
    @keyframes blink {
      0%, 100% {
        opacity:1
      } 50% {
        opacity:0
      }
    }
  .hero-section {
    min-height:100vh;
    display:flex;
    align-items:center;
    position:relative;
    overflow:hidden
  }
  .hero-section::before {
    content:'';
    position:absolute;
    top:-50%;
    right:-20%;
    width:600px;
    height:600px;
    border-radius:50%;
    background:radial-gradient(circle,rgba(224,0,0,0.07) 0%,transparent 70%);
    animation:pulse-glow 4s ease-in-out infinite
  }
  @keyframes pulse-glow {
    0%, 100% {
    transform:scale(1)
    } 50% {
    transform:scale(1.1)
    }
  }
  .hero-tag {
    font-family:'Orbitron',monospace;
    font-size:.75rem;
    color:#e00000;
    letter-spacing:4px;
    text-transform:uppercase
  }
  .hero-name {
    font-family:'Orbitron',monospace;
    font-size:clamp(1.8rem,5vw,3rem);
    font-weight:900;
    line-height:1.1
  }
  .hero-focus {
    color: #f0f0f0;
    font-size:1rem;
    line-height:1.8;
    max-width:500px
  }
  .hero-photo-wrapper {
    position:relative;
    display:inline-block
  }
  .hero-photo-wrapper::before {
    content:'';
    position:absolute;
    inset:-3px;
    border-radius:50%;
    background:conic-gradient(#e00000,transparent,#8b0000,transparent,#e00000);
    animation:spin-border 6s linear infinite;
    z-index:0
  }
  @keyframes spin-border {
    to {
      transform:rotate(360deg)
    }
  }
  .hero-photo {
    width:220px;
    height:220px;
    border-radius:50%;
    object-fit:cover;
    position:relative;
    z-index:1;
    border:4px solid #0a0a0a
  }
</style>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>