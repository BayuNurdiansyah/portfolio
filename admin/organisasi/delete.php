<?php
require_once '../../config/db.php';
    session_start();
    if(!isset($_SESSION['admin'])){ header('Location: ../../admin/login.php'); exit; }
    
    $id = (int)$_GET['id'];
    mysqli_query($conn,"DELETE FROM organisasi WHERE id=$id");
    header('Location: index.php?msg=Data berhasil dihapus');
    exit;
?>