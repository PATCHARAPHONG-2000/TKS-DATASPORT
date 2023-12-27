<?php
require_once '../../service/connect.php';

if (!isset($_SESSION['AD_ROLE'])) {
    header('Location: ../../login-score.php');
    exit(); // อย่าลืมเรียก exit หลังจาก header
}
