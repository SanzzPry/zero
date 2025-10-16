<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>CV Pelamar - Bambang Kurnia</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background-color: #fff;
            color: #333;
            margin: 0;
            padding: 40px;
            line-height: 1.6;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        h1,
        h2,
        h3 {
            color: #e67e22;
        }

        .flex {
            display: flex;
        }

        .justify-between {
            justify-content: space-between;
        }

        .items-center {
            align-items: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-justify {
            text-align: justify;
        }

        .bold {
            font-weight: bold;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .mt-6 {
            margin-top: 1.5rem;
        }

        .mt-8 {
            margin-top: 2rem;
        }

        .mt-10 {
            margin-top: 2.5rem;
        }

        .border-orange {
            border-top: 5px solid #e67e22;
            width: 60%;
        }

        .section-title {
            color: #e67e22;
            font-size: 22px;
            font-weight: bold;
            margin-top: 40px;
        }

        ul {
            list-style-type: disc;
            margin-left: 20px;
        }

        .footer {
            border-top: 1px solid #ccc;
            margin-top: 50px;
            padding-top: 10px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        .photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ccc;
        }

        .info-right {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="flex justify-between items-start">
            <!-- Foto -->
            <img src="storage/anjay.jpg" alt="Foto Profil" class="photo">

            <!-- Nama & Alamat -->
            <div>
                <h1>Bambang Kurnia</h1>
                <p>
                    Jalan Prapatan Dalam No. 04 RT. 47<br>
                    Balikpapan Kota, Kota Balikpapan,<br>
                    Kalimantan Timur, ID, 76111
                </p>
            </div>

            <!-- Kontak -->
            <div class="info-right">
                <p>📧 Chappie_cute@miside.com</p>
                <p>📞 08123456789</p>
                <p>📸 bamboong_kurnia</p>
                <p>🔗 LinkedIn</p>
            </div>
        </div>

        <!-- Tentang Saya -->
        <h2 class="section-title">TENTANG SAYA</h2>
        <div class="border-orange"></div>
        <p class="text-justify mt-4">
            Saya adalah lulusan Teknik Informatika di Universitas Gadjah Mada yang memiliki minat besar dalam
            pengembangan
            web dan aplikasi. Dengan keahlian dalam Flutter untuk pengembangan aplikasi berbasis Android serta PHP untuk
            pemrograman web, saya terus mengasah kemampuan saya di bidang teknologi. Saya bercita-cita menjadi seorang
            programmer full-stack yang mampu mengembangkan aplikasi atau website sendiri, dengan harapan dapat
            memberikan
            kontribusi positif bagi masyarakat dalam menghadapi perkembangan dunia digital yang semakin pesat.
        </p>

        <!-- Keahlian & Kompetensi -->
        <h2 class="section-title">KEAHLIAN & KOMPETENSI</h2>
        <div class="border-orange"></div>
        <ul class="mt-4">
            <li>Laravel — <strong>Expert</strong></li>
            <li>PHP — <strong>Intermediate</strong></li>
            <li>Flutter — <strong>Expert</strong></li>
            <li>CSS — <strong>Intermediate</strong></li>
            <li>JavaScript — <strong>Expert</strong></li>
        </ul>

        <!-- Organisasi -->
        <h2 class="section-title">ORGANISASI</h2>
        <div class="border-orange"></div>
        <div class="mt-4">
            <div class="flex justify-between">
                <p><strong>Tim Kreatif HIMA ILKOM UGM</strong></p>
                <p>(2018 - 2019)</p>
            </div>
            <p class="text-justify">
                Sebagai anggota Tim Kreatif, saya bertanggung jawab dalam menghasilkan konsep kreatif untuk berbagai
                kegiatan
                dan acara yang diselenggarakan oleh himpunan. Saya berkolaborasi dengan tim untuk merancang desain
                visual,
                materi promosi, serta konten media sosial yang menarik dan efektif.
            </p>

            <div class="flex justify-between mt-4">
                <p><strong>Divisi Humas BEM KM UGM</strong></p>
                <p>(2018 - 2019)</p>
            </div>
            <p class="text-justify">
                Sebagai anggota Divisi Humas BEM KM UGM, saya berperan dalam menjaga komunikasi yang baik antara
                organisasi
                dengan mahasiswa, pihak universitas, serta masyarakat umum. Tugas saya meliputi penyusunan strategi
                komunikasi,
                penyebaran informasi terkait kegiatan BEM melalui berbagai platform seperti media sosial, website, dan
                publikasi langsung.
            </p>
        </div>

        <!-- Pengalaman Kerja -->
        <h2 class="section-title">PENGALAMAN KERJA</h2>
        <div class="border-orange"></div>
        <div class="mt-4">
            <div class="flex justify-between">
                <p><strong>UI/UX Designer PT. Mega Jaya Permata</strong></p>
                <p>(2020 - 2022)</p>
            </div>
            <p class="text-justify">
                Bertanggung jawab merancang antarmuka pengguna yang intuitif dan menyenangkan. Saya berkolaborasi dengan
                tim pengembang
                menggunakan tools seperti Figma dan Adobe XD untuk membuat wireframes, prototipe, serta user flow yang
                efektif.
            </p>

            <div class="flex justify-between mt-4">
                <p><strong>Front End Developer PT. Pertamina (Persero)</strong></p>
                <p>(2022 - 2023)</p>
            </div>
            <p class="text-justify">
                Merancang antarmuka pengguna dan memastikan setiap elemen desain estetis sekaligus fungsional,
                menggunakan framework modern.
            </p>

            <div class="flex justify-between mt-4">
                <p><strong>Back End Developer PT. Haryanto Group</strong></p>
                <p>(2023 - 2024)</p>
            </div>
            <p class="text-justify">
                Fokus pada pengembangan server, basis data, dan logika aplikasi. Menggunakan PHP dan Node.js untuk
                membangun API yang handal dan aman.
            </p>
        </div>

        <!-- Pendidikan -->
        <h2 class="section-title">LATAR BELAKANG PENDIDIKAN</h2>
        <div class="border-orange"></div>
        <div class="mt-4">
            <div class="flex justify-between">
                <p><strong>Universitas Gadjah Mada</strong></p>
                <p>(2018 - 2019)</p>
            </div>
            <p>Teknik Informatika</p>

            <div class="flex justify-between mt-4">
                <p><strong>SMK Negeri 2 Yogyakarta</strong></p>
                <p>(2018 - 2019)</p>
            </div>
            <p>Teknik Komputer dan Jaringan</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Copyright © 2024 areakerja.com</p>
        </div>
    </div>
</body>

</html>