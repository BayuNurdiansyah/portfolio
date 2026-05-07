<?php $current = basename($_SERVER['PHP_SELF']); ?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">
      <span style="color:#e00000">&lt;</span>Bayu<span style="color:#e00000">/&gt;</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?= $current=='index.php'?'active':'' ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current=='pendidikan.php'?'active':'' ?>" href="pendidikan.php">Pendidikan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current=='pekerjaan.php'?'active':'' ?>" href="pekerjaan.php">Pekerjaan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current=='organisasi.php'?'active':'' ?>" href="organisasi.php">Organisasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current=='techstack.php'?'active':'' ?>" href="techstack.php">Tech Stack</a>
        </li>
        <li class="nav-item ms-lg-3">
          <a class="btn btn-sm btn-danger px-3 fw-bold" href="admin/login.php">Admin</a>
        </li>
      </ul>
    </div>
  </div>
</nav>