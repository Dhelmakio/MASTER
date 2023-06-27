<?php
session_start();
include('../config/conn.php');
$id;

$sql = "SELECT min, max FROM loan_types WHERE loan_type_id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($min, $max);
$stmt->fetch();
$stmt->close();

echo "<input type='number' name='duration' min='".$min."' max='".$max."' placeholder='".$min."-".$max."'>";
?>
