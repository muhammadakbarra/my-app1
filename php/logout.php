<?php
session_start();

// Hapus semua data sesi
session_unset();

// Hapus sesi dari server
session_destroy();

// Arahkan pengguna ke halaman login
header("Location: ../index.php");
exit();
