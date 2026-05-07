<?php
session_start();

if(isset($_SESSION['admin']))  {
  header('Location: dashboard.php');
  exit;
}
require_once '../config/db.php';

$error = '';

if($_SERVER['REQUEST_METHOD']==='POST') {

  $username = mysqli_real_escape_string($conn, $_POST['username']);

  $row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM admin_user WHERE username='$username' LIMIT 1"));

    if($row && password_verify($_POST['password'], $row['password'])) {
        $_SESSION['admin'] = $row['username'];
        header('Location: dashboard.php');
        exit;
    } else  {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | Ahmad Bayu Nurdiansyah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="d-flex align-items-center justify-content-center" style="min-height:100vh;">
  <div style="width:100%;max-width:400px;padding:1rem;">

    <div class="text-center mb-4">
      <p style="font-family:'Orbitron',monospace;font-size:1.4rem;font-weight:900;color:#f0f0f0;">
        <span style="color:#e00000">&lt;</span>Admin<span style="color:#e00000">/&gt;</span>
      </p>
      <p class="text-main small mb-0">BE CAREFULL ALL OF THIS CONTENT IS SENSITIVE!</p>
    </div>

    <div class="card-dark">
      <p class="label-red mb-4 text-center">LOGIN PANEL</p>

      <?php if($error): ?>
      <div class="alert mb-3 py-2 text-center" style="background:rgba(224,0,0,0.1);border:1px solid #e00000;color:#ff6666;font-size:.9rem;">
        <i class="fa fa-exclamation-triangle me-2"></i><?= $error ?>
      </div>
      <?php endif; ?>

      <form method="POST">
        <div class="mb-3">
          <label class="form-label text-main small">USERNAME</label>
          <div class="input-group">
            <span class="input-group-text" style="background:#1a1a1a;border:1px solid rgba(224,0,0,0.3);border-right:none;color:#e00000;">
              <i class="fa fa-user"></i>
            </span>
            <input type="text" name="username" class="form-control admin-input"
                   style="border-left:none;" placeholder="Masukkan username" required>
          </div>
        </div>
        <div class="mb-4">
          <label class="form-label text-main small">PASSWORD</label>
          <div class="input-group">
            <span class="input-group-text" style="background:#1a1a1a;border:1px solid rgba(224,0,0,0.3);border-right:none;color:#e00000;">
              <i class="fa fa-lock"></i>
            </span>
            <input type="password" name="password" id="passInput" class="form-control admin-input" style="border-left:none;border-right:none;" placeholder="Masukkan password" required>
            <span class="input-group-text" id="togglePass"
                  style="background:#1a1a1a;border:1px solid rgba(224,0,0,0.3);border-left:none;color:#888;cursor:pointer;">
              <i class="fa fa-eye"></i>
            </span>
          </div>
        </div>
        <button type="submit" class="btn btn-danger w-100 fw-bold py-2">
          <i class="fa fa-sign-in-alt me-2"></i>LOGIN
        </button>
      </form>
    </div>

    <p class="text-center mt-3">
      <a href="../index.php" class="text-main small" style="text-decoration:none;">
        <i class="fa fa-arrow-left me-1"></i> Kembali ke Website
      </a>
    </p>

  </div>
</div>

<style>
    .admin-input {
        background:#1a1a1a;
        border:1px solid rgba(224,0,0,0.3);
        color:#f0f0f0;
        border-radius:0
    }
    .admin-input:focus {
        background:#1a1a1a;
        border-color:#e00000;
        color:#f0f0f0;
        box-shadow:none
    }
    body::before {
        content:'';
        position:fixed;
        top:-50%;
        right:-20%;
        width:500px;
        height:500px;
        border-radius:50%;
        background:radial-gradient(circle,rgba(224,0,0,0.06) 0%,transparent 70%);
        pointer-events:none
    }
</style>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
$('#togglePass').on('click', function() {
    const inp = $('#passInput');
    const icon = $(this).find('i');

    if(inp.attr('type')==='password') {
        inp.attr('type','text');
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else  {
        inp.attr('type','password');
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
});

</script>
</body>
</html>