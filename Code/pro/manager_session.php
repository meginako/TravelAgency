<?php
  @session_start();
  if (!isset($_SESSION['manager'])) {
    echo "<script>alert('You are not logged in!'); window.location='../';</script>";
    exit;
  }

  if (($_SESSION['category']) != 'manager' && $_SESSION['category'] != 'super') {
    echo "<script>alert('You are not logged in!'); window.location='../';</script>";
    exit;
  }
  $manager_id = $_SESSION['manager'];
  $agency_id = $_SESSION['agency_id'];
  if (!isset($conn)) require '../conn.php';

  ?>

