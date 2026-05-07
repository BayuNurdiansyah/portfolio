<?php 
    require_once '../../config/db.php';
    session_start();
    if(!isset($_SESSION['admin'])){ header('Location: ../../admin/login.php'); exit; }
?>
<?php $data = mysqli_query($conn,"SELECT * FROM organisasi ORDER BY id ASC"); ?>
<!DOCTYPE html><html lang="id">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin Organisasi</title>
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
 <?php if(isset($_GET['msg'])): ?>
  <div class="alert alert-dismissible fade show mb-3 py-2" role="alert" style="background:rgba(0,200,0,0.1);border:1px solid green;color:#0f0">
  <?= htmlspecialchars($_GET['msg']) ?>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" style="padding:0.25rem;font-size:0.65rem;"></button>
  </div>
  <?php endif; ?>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <p class="section-title mb-0">Kelola Organisasi</p>
      <div class="title-line mb-0"></div>
    </div>
    <a href="create.php" class="btn btn-danger"><i class="fa fa-plus me-2"></i>Tambah</a>
  </div>
  <div class="card-dark p-0" style="overflow:hidden">
    <table class="table table-dark table-hover mb-0" style="background:transparent">
      <thead style="background:rgba(224,0,0,0.15);font-family:'Orbitron',monospace;font-size:.78rem;">
        <tr>
          <th class="px-4 py-3">#</th>
          <th class="py-3">Nama Organisasi</th>
          <th class="py-3">Posisi</th>
          <th class="py-3">Tahun</th>
          <th class="py-3">Lokasi</th>
          <th class="py-3 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
        <tr style="border-color:rgba(224,0,0,0.15)">
          <td class="px-4"><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['nama_org']) ?></td>
          <td><?= htmlspecialchars($row['posisi']) ?></td>
          <td><?= htmlspecialchars($row['tahun']) ?></td>
          <td><?= htmlspecialchars($row['lokasi']) ?></td>
          <td class="text-center">
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger me-1"><i class="fa fa-edit"></i></a>
            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body></html>