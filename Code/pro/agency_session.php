<?php
  @session_start();
  if (!isset($_SESSION['agency'])) {
    echo "<script>alert('You are not logged in!'); window.location='../';</script>";
    exit;
  }

  if (($_SESSION['category']) != 'agency' && $_SESSION['category'] != 'super') {
    echo "<script>alert('You are not logged in!'); window.location='../';</script>";
    exit;
  }
  $agency_id = $_SESSION['agency'];
  if (!isset($conn)) require '../conn.php';

  ?>

