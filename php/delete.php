<?php
include 'dbconnect.php';
session_start();

// Memeriksa apakah pengguna sudah login sebagai admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Jika belum login sebagai admin, arahkan pengguna ke halaman login
    echo "<script>alert('Anda harus login sebagai admin.'); window.location.href = '../login.html';</script>";
    exit(); // Menghentikan eksekusi skrip selanjutnya
}
// Menghapus data pengguna berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM news WHERE id = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "i", $id);
    mysqli_stmt_execute($statement);

    mysqli_stmt_close($statement);
    mysqli_close($conn);

    // Set status berhasil
    session_start();
    $_SESSION['status'] = 'success di hapus';

    header('Location: ../index.php');
    exit();
}
