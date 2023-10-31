<?php
include "dbconnect.php";

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// Mengecek di tabel admin
$query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $query);

// Jika ditemukan di tabel admin
if (mysqli_num_rows($result) > 0) {

    $_SESSION['role'] = 'admin';
    $_SESSION['username'] = $username;

    echo "<script>alert('Login berhasil sebagai admin.');</script>";
    header('Location: ../index.php');
} else {
    // Mengecek di tabel user
    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Jika ditemukan di tabel user
    if (mysqli_num_rows($result) > 0) {
        // Proses login user
        // ...

        // Set session untuk user
        $_SESSION['role'] = 'user';
        $_SESSION['username'] = $username;

        echo "<script>alert('Login berhasil sebagai user.');</script>";
        header('Location: ../index.php');
    } else {
        // Tidak ditemukan di kedua tabel
        echo "<script>alert('Username atau password salah.'); window.location.href='../index.php';</script>";

        // Redirect atau tampilkan pesan kesalahan sesuai kebutuhan
        // ...
    }
}
