<?php
include('dbconnect.php'); // Sertakan file dbconnect.php yang berisi informasi koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST["judul"];
    $isi = $_POST["isi"];

    // Periksa apakah file foto diunggah
    if (isset($_FILES["foto"]) && !empty($_FILES["foto"]["name"])) {
        $gambarFolder = "../uploads/";
        $gambarNama = basename($_FILES["foto"]["name"]);
        $gambarPath = $gambarFolder . $gambarNama;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $gambarPath)) {
            // Gambar berhasil diunggah, simpan data ke database
            $sql = "INSERT INTO news (judul, isi, foto) VALUES ('$judul', '$isi', '$gambarPath')";

            if ($conn->query($sql) === TRUE) {
                header('Location: ../index.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Gagal mengunggah gambar.";
        }
    } else {
        echo "Silakan pilih file gambar untuk diunggah.";
    }

    $conn->close();
}
