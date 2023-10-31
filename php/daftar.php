<?php
include 'dbconnect.php'; // Menghubungkan ke file koneksi database


// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];


// Query untuk memasukkan data ke tabel pengguna
$query = "INSERT INTO user (username, password) VALUES ('$username', '$password')";

// Jalankan query
if (mysqli_query($conn, $query)) {
    // Pendaftaran berhasil, arahkan pengguna ke halaman login
    header("Location: ../index.php");
    exit();
} else {
    // Jika terjadi kesalahan saat menjalankan query
    echo "Error: " . mysqli_error($conn);
}
