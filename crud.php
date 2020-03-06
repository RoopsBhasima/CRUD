<?php 

$mysqli = new mysqli('localhost', 'root', null, 'students');

$name = '';
$roll = '';


if(isset($_POST['save'])) {
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $mysqli->query("INSERT INTO studentlist(name, roll) values ('$name', $roll)") or die($mysqli->error);
}

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM studentlist WHERE id=$id") or die($mysqli->error);
}

if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $mysqli = $mysqli->query("SELECT * FROM studentlist WHERE id=$id") or die($mysqli->error);
    $singleStudent = $mysqli->fetch_assoc();
    $name = $singleStudent['name'];
    $roll = $singleStudent['roll'];
}

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $roll = $_POST['roll'];

    $mysqli->query("UPDATE studentlist SET 'name'='$name', 'roll'=$roll WHERE id=$id") or die($mysqli->error);
}