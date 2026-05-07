<?php
session_start();
if(!isset($_SESSION['admin'])){ header('Location: ../../admin/login.php'); exit; }
require_once '../../config/db.php';

$id  = (int)$_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM techstack WHERE id=$id"));

// Hapus file lokal kalau ada
if($row && $row['logo_local'] && file_exists('../../assets/img/techstack/'.$row['logo_local'])){
  unlink('../../assets/img/techstack/'.$row['logo_local']);
}

mysqli_query($conn,"DELETE FROM techstack WHERE id=$id");
header('Location: index.php?msg=Tech stack berhasil dihapus');
exit;
?>