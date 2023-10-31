<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";



//koneksi databsae
include 'php/dbconnect.php';

// query
$query = "SELECT * FROM news";
$result = mysqli_query($conn, $query);

?>


<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
</head>

<body class="bg-black">
    <div class=" text-xl bg-slate-700 text-white m-6 rounded-md  h-14 flex items-center justify-between ">
        <div></div>
        <div class="flex  align-center justify-center ">
            <p class="font-semibold">Selamat datang di</p>
            <p class="text-amber-300 font-semibold"> Fikom UMI</p>
            <p> &nbsp;<?php echo $username; ?></p>
        </div>
        <div class="flex justify-end">
            <?php if (isset($_SESSION['username'])) : ?>
                <a href="php/logout.php" class="bg-gray-500 mr-3 rounded-md text-black hover:bg-sky-600">Logout</a>
            <?php else : ?>
                <button onclick="openModal()" class="bg-gray-500 mr-3 rounded-md text-black hover:bg-sky-600">Login</button>
            <?php endif; ?>
        </div>
    </div>
    <div class="flex justify-center bg-amber-100 h-2/5">
        <img src="img/fikom.jpeg" alt="fikom ig" class="rounded-xl m-3">
    </div>
    <!-- moto -->
    <div class="flex justify-center flex-wrap mt-9">
        <div class="text-white font-semibold w-96">
            <span class="text-amber-300">"</span>Kombinasi ilmu pengetahuan dan nilai-nilai keislaman di <span class="text-amber-300">Fakultas Ilmu Komputer</span> membentuk karakter berintegritas, kreatif, dan
            inovatif <span class="text-amber-300">Anda</span> dalam lingkungan belajar kondusif. Kembangkan potensi Anda
            di sini.<span class="text-amber-300">"</span>
        </div>
    </div>
    <div class="m-5 rounded-xl flex justify-center">
        <img src="img/peringkat.jpeg" alt="">
    </div>
    <!-- news -->
    <div class="news font-bold text-white m-5 flex justify-center">
        NEWS
    </div>
    <?php while ($news = mysqli_fetch_assoc($result)) : ?>
        <div class="text-white flex m-5 bg-stone-900 justify-between">
            <div class="gambar m-4 ml-6 flex justify-center items-center">
                <img src="uploads/<?php echo  $news['foto'] ?>" alt="foto student exhange" class="aturangambar rounded-xl">
            </div>
            <div class="textnews mt-6 w-6/12 flex  flex-col justify-star">
                <p class="font-semibold">
                    <?php echo $news['judul'] ?>
                </p>
                <p class="">
                    <span class="short-content"><?php echo substr($news['isi'], 0, 100); ?></span>
                    <span class="full-content" style="display: none;"><?php echo $news['isi']; ?></span>
                    <button class="italic text-cyan-300" onclick="toggleContent(this)">Selengkapnya</button>
                </p>
            </div>
            <div class="flex items-end">
                <?php
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    echo '<a href="php/delete.php?id=' . $news['id'] . '" class="bg-red-800 m-3 hover:bg-red-950 p-3 rounded-md">Delete</a>';
                }
                ?>
            </div>
        </div>
    <?php endwhile; ?>

    <?php

    // Cek peran atau status pengguna (misalnya, admin atau bukan)
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        // Tampilkan tombol "Tambah News" hanya jika pengguna adalah admin
        echo '<div class="tambah-news flex justify-center ">
            <button id="tambahDataButton" class="bg-amber-500 hover:bg-amber-900 text-white font-bold py-2 px-4 rounded">Tambah News</button>

            <div id="formTambahData" class="hidden bg-gray-200 p-4 mt-4 transition-transform transform translate-y-16">
                <h3 class="text-lg font-semibold">Berita baru:</h3>
                <form action="php/kirimdata.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 text-sm font-bold">Judul:</label>
                        <input type="text" id="judul" name="judul" required class="rounded-md border border-gray-400 p-2">
                    </div>

                    <div class="mb-4">
                        <label for="isi" class="block text-gray-700 text-sm font-bold">Isi:</label>
                        <input type="text" id="isi" name="isi" required class="rounded-md border border-gray-400 p-2">
                    </div>
                    <div class="mb-4">
                        <label for="foto" class="block text-gray-700 text-sm font-bold">foto</label>
                        <input type="file" id="foto" name="foto" required class="rounded-md border border-gray-400 p-2">
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                </form>
            </div>
        </div>';
    }
    ?>

    <!-- Location -->
    <div class="lokasi flex text-white font-semibold justify-center m-5">
        LOCATION
    </div>
    <div class="flex justify-center m-6 mb-20">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d993.4492152951287!2d119.44876106962974!3d-5.136384653755903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefd3165008369%3A0x7af75b8baf265f2b!2sFakultas%20Ilmu%20Komputer%20UMI!5e0!3m2!1sid!2sid!4v1698633338521!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-xl"></iframe>
    </div>
    <div class="footer bg-stone-800 text-white font-semibold flex justify-center p-6">
        Thank Your for Open this Website : )
    </div>

    <!-- pop up -->
    <div id="myModal" class="hidden fixed inset-0 flex items-center justify-center z-50 ">
        <div class="modal-container w-9/12 h-2/4 p-4 rounded shadow-lg bg-gray-300  ">
            <!-- Isi Form -->
            <button id="closeModal" class="text-red-500 hover:text-red-700 text-right text-lg cursor-pointer flex ">Tutup</button>
            <div class="flex justify-center items-center flex-col h-3/4">
                <div class="mb-2">
                    Anda Perlu Login terlebih dahulu
                </div>
                <div class="font-semibold mt-6">
                    <form action="php/login.php" method="POST" class="flex flex-col">
                        <label for="username">Masukkan Username</label>
                        <input type="text" name="username" class="rounded-md mt-2">
                        <label for="password">Masukkan Password</label>
                        <input type="password" name="password" class="rounded-md mt-2">
                        <button type="submit" class="mt-8 rounded-md hover:bg-sky-700 hover:text-white">Masuk</button>
                    </form>
                </div>
            </div>
            <div class="flex justify-end">
                <p>tidak memiliki akun?</p>
                <button id="daftar" class="text-blue-600">daftar disini</button>
            </div>
        </div>
    </div>
    <!-- daftar -->
    <div id="menudaftar" class="hidden fixed inset-0 flex items-center justify-center z-50 ">
        <div class="modal-container w-9/12 h-2/4 p-4 rounded shadow-lg bg-gray-300  ">
            <!-- Isi Form -->
            <button id="closeModal1" class="text-red-500 hover:text-red-700 text-right text-lg cursor-pointer flex ">Tutup</button>
            <div class="flex justify-center items-center flex-col h-3/4">
                <div class="mb-2 font-bold">
                    Daftar
                </div>
                <div class="font-semibold mt-6">
                    <form action="php/daftar.php" method="POST" class="flex flex-col">
                        <label for="username">Masukkan Username</label>
                        <input type="text" name="username" class="rounded-md mt-2">
                        <label for="password">Masukkan Password</label>
                        <input type="password" name="password" class="rounded-md mt-2">
                        <button type="submit" class="mt-8 rounded-md hover:bg-sky-700 hover:text-white">Daftar</button>
                    </form>
                </div>
            </div>
            <div class="flex justify-end">
                <p>sudah memiliki akun?</p>
                <button id="punyaakun" class="text-blue-600 hover:font-semibold">Masuk</button>
            </div>
        </div>
    </div>

    <script>
        // Dapatkan elemen modal dan tombol tutup
        const modal = document.getElementById('myModal');
        const menudaftar = document.getElementById('menudaftar');
        const closeModal = document.getElementById('closeModal');
        const closeModal1 = document.getElementById('closeModal1');
        const daftar = document.getElementById('daftar');
        const punyaakun = document.getElementById('punyaakun');

        // Fungsi untuk menampilkan modal
        function openModal() {
            modal.classList.remove('hidden');
        }

        function openMenudaftar() {
            menudaftar.classList.remove('hidden');
        }

        // Fungsi untuk menyembunyikan modal
        function hideModal() {
            modal.classList.add('hidden');
        }

        function hideMenuDaftar() {
            menudaftar.classList.add('hidden');
        }

        // nested fungsi
        function openMenudaftarAndHideModal() {
            openMenudaftar();
            hideModal();
        }

        function openModalAndHideMenuDaftar() {
            openModal();
            hideMenuDaftar();
        }

        // Tambahkan event listener untuk tombol
        daftar.addEventListener('click', openMenudaftarAndHideModal);
        punyaakun.addEventListener('click', openModalAndHideMenuDaftar)
        // openButton1.addEventListener('click', openModal);
        closeModal.addEventListener('click', hideModal);
        closeModal1.addEventListener('click', hideMenuDaftar);



        // tambah news
        document.getElementById('tambahDataButton').addEventListener('click', function() {
            const formTambahData = document.getElementById('formTambahData');
            if (formTambahData.style.display === 'none') {
                formTambahData.style.display = 'block';
                formTambahData.classList.remove('translate-y-16');
            } else {
                formTambahData.style.display = 'none';
                formTambahData.classList.add('translate-y-16');
            }
        });

        //selengkapnya
        function toggleContent(button) {
            const shortContent = button.parentElement.querySelector('.short-content');
            const fullContent = button.parentElement.querySelector('.full-content');

            if (fullContent.style.display === 'none') {
                fullContent.style.display = 'inline';
                shortContent.style.display = 'none';
                button.textContent = 'Sembunyikan';
            } else {
                fullContent.style.display = 'none';
                shortContent.style.display = 'inline';
                button.textContent = 'Selengkapnya';
            }
        }
    </script>
</body>

</html>
