@extends('layouts.dashboard')

@section('title', 'CV Pelamar')

@section('content')
    <div class="max-w-7xl mx-auto bg-white shadow-md  relative font-sans pt-12">

        <!-- Tombol Close -->
        <a href="javascript:history.back()"
            class="absolute top-4 right-4 text-gray-500 hover:text-red-600 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>


        <!-- Header -->
        <div class="flex items-start gap-x-10">
            <!-- Foto -->
            <img src="{{ asset('/storage/anjay.jpg') }}" alt="Foto Profil"
                class="w-32 h-32 rounded-full object-cover object-top border-4 border-gray-300 ml-20">

            <!-- Nama + Alamat -->
            <div>
                <h1 class="text-3xl font-bold text-orange-600">Bambang Kurnia</h1>
                <p class="text-gray-700 mt-1">
                    Jalan Prapatan Dalam No. 04 RT. 47 <br>
                    Balikpapan Kota, Kota Balikpapan, <br>
                    Kalimantan Timur, ID, 76111
                </p>
            </div>

            <!-- Kontak -->
            <div class="flex flex-col items-start text-sm text-gray-600 space-y-2 ml-[20rem]">
                <p class="flex items-center space-x-1">
                    <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M2.038 5.61A2.01 2.01 0 0 0 2 6v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6c0-.12-.01-.238-.03-.352l-.866.65-7.89 6.032a2 2 0 0 1-2.429 0L2.884 6.288l-.846-.677Z" />
                        <path
                            d="M20.677 4.117A1.996 1.996 0 0 0 20 4H4c-.225 0-.44.037-.642.105l.758.607L12 10.742 19.9 4.7l.777-.583Z" />
                    </svg>
                    <span>Chappie_cute@miside.com</span>
                </p>
                <p class="flex items-center space-x-1"><svg class="w-6 h-6 text-orange-500" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z" />
                    </svg> <span>08123456789</span></p>
                <p class="flex items-center space-x-1">
                    <svg class="w-6 h-6 text-orange-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>bamboong_kurnia</span>
                </p>
                <p class="flex items-center space-x-1"><svg class="w-6 h-6 text-orange-500" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12.51 8.796v1.697a3.738 3.738 0 0 1 3.288-1.684c3.455 0 4.202 2.16 4.202 4.97V19.5h-3.2v-5.072c0-1.21-.244-2.766-2.128-2.766-1.827 0-2.139 1.317-2.139 2.676V19.5h-3.19V8.796h3.168ZM7.2 6.106a1.61 1.61 0 0 1-.988 1.483 1.595 1.595 0 0 1-1.743-.348A1.607 1.607 0 0 1 5.6 4.5a1.601 1.601 0 0 1 1.6 1.606Z"
                            clip-rule="evenodd" />
                        <path d="M7.2 8.809H4V19.5h3.2V8.809Z" />
                    </svg>
                    <span>LinkedIn</span>
                </p>
            </div>
        </div>

        <div>
            <div class="flex mt-16 mx-24">
                <div>

                    {{-- Tentang saya --}}
                    <div class="w-full">
                        <p class="font-bold text-orange-500 text-2xl">TENTANG SAYA</p>
                        <div class="flex items-center w-full mt-2">
                            <div class=" w-1/6 border-t-8 border-orange-500"></div>

                            <div class="w-4/6 border-t-2 border-orange-500"></div>
                        </div>
                        <p class="mt-5 w-5/6 text-justify font-medium text-xl">Saya adalah lulusan Teknik Informatika di
                            Universitas Gadjah Mada yang memiliki minat besar dalam pengembangan web dan aplikasi. Dengan
                            keahlian dalam Flutter untuk pengembangan aplikasi berbasis Android serta PHP untuk pemrograman
                            web,
                            saya terus mengasah kemampuan saya di bidang teknologi. Saya bercita-cita menjadi seorang
                            programmer
                            full-stack yang mampu mengembangkan aplikasi atau website sendiri, dengan harapan dapat
                            memberikan
                            kontribusi positif bagi masyarakat dalam menghadapi perkembangan dunia digital yang semakin
                            pesat.
                        </p>
                    </div>

                    {{-- Keahlian dan kompetensi --}}
                    <div class="w-full mt-6">
                        <p class="font-bold text-orange-500 text-2xl">KEAHLIAN & KOMPETENSI</p>
                        <div class="flex items-center w-full mt-2">
                            <div class=" w-1/6 border-t-8 border-orange-500"></div>
                            <div class="w-4/6 border-t-2 border-orange-500"></div>
                        </div>
                        <ul class="list-disc list-inside text-lg font-semibold mx-4 mt-4">
                            <div class="w-5/6 justify-between flex">
                                <li>Laravel</li>
                                <p>Expert</p>
                            </div>
                            <div class="w-5/6 justify-between flex">
                                <li>PHP</li>
                                <p>Intermediate</p>
                            </div>
                            <div class="w-5/6 justify-between flex">
                                <li>Flutter</li>
                                <p>Expert</p>
                            </div>
                            <div class="w-5/6 justify-between flex">
                                <li>CSS</li>
                                <p>Intermediate</p>
                            </div>
                            <div class="w-5/6 justify-between flex">
                                <li>Java Script</li>
                                <p>Expert</p>
                            </div>
                        </ul>
                    </div>

                    {{-- organisasi --}}
                    <div class="w-full mt-10">
                        <p class="font-bold text-orange-500 text-2xl">ORGANISASI</p>
                        <div class="flex items-center w-full mt-2">
                            <div class=" w-1/6 border-t-8 border-orange-500"></div>
                            <div class="w-4/6 border-t-2 border-orange-500"></div>
                        </div>
                        <div class="flex mt-5 justify-between w-5/6">
                            <p class=" w-3/6 font-semibold text-xl">Jabatan - Tim Kreatif HIMA ILKOM UGM</p>
                            <p class="font-semibold text-xl">( 2018 - 2019 )</p>
                        </div>
                        <p class="mt-3  text-justify font-medium text-lg w-5/6">
                            Sebagai anggota Tim Kreatif, saya bertanggung jawab dalam menghasilkan konsep kreatif untuk
                            berbagai kegiatan dan acara yang diselenggarakan oleh himpunan. Saya berkolaborasi dengan tim
                            untuk merancang desain visual, materi promosi, serta konten media sosial yang menarik dan
                            efektif dalam menyampaikan pesan kepada anggota dan masyarakat..</p>
                        <div class="flex mt-6 justify-between w-5/6">
                            <p class=" w-4/6 font-semibold text-xl">Jabatan - Divisi Humas BEM KM UGM</p>
                            <p class="font-semibold text-xl">( 2018 - 2019 )</p>
                        </div>
                        <p class="mt-3  text-justify font-medium text-lg w-5/6">
                            Sebagai anggota Divisi Humas BEM KM UGM, saya berperan dalam menjaga komunikasi yang baik antara
                            organisasi dengan mahasiswa, pihak universitas, serta masyarakat umum. Tugas saya meliputi
                            penyusunan strategi komunikasi, penyebaran informasi terkait kegiatan BEM melalui berbagai
                            platform, seperti media sosial, website, dan publikasi langsung.</p>
                    </div>
                </div>
                <div>
                    {{-- Pengalaman kerja --}}
                    <div class="w-full ">
                        <p class="font-bold text-orange-500 text-2xl">PENGALAMAN KERJA</p>
                        <div class="flex items-center w-full mt-2">
                            <div class=" w-1/6 border-t-8 border-orange-500"></div>
                            <div class="w-5/6 border-t-2 border-orange-500"></div>
                        </div>
                        <div class="flex mt-5 justify-between">
                            <p class=" w-4/6 font-semibold text-xl">Jabatan - UI/UX Designer PT.Mega Jaya Permata</p>
                            <p class="font-semibold text-2xl">( 2020 - 2022 )</p>
                        </div>
                        <p class="mt-1  text-justify font-medium text-lg">
                            Bertanggung jawab untuk merancang antarmuka pengguna yang intuitif dan menyenangkan. Saya
                            berkolaborasi dengan tim pengembang untuk memastikan setiap elemen desain tidak hanya estetis
                            tetapi
                            juga fungsional. Dalam pekerjaan ini, saya menggunakan tools seperti Figma dan Adobe XD untuk
                            membuat wireframes, prototipe, serta user flow yang efektif.</p>
                        <div class="flex mt-6 justify-between ">
                            <p class=" w-4/6 font-semibold text-xl">Jabatan - Front End Developer PT.Pertamina ( Persero )
                            </p>
                            <p class="font-semibold text-xl">( 2022 - 2023 )</p>
                        </div>
                        <p class="mt-3  text-justify font-medium text-lg">
                            Bertanggung jawab untuk merancang antarmuka pengguna yang intuitif dan menyenangkan. Saya
                            berkolaborasi dengan tim pengembang untuk memastikan setiap elemen desain tidak hanya estetis
                            tetapi
                            juga fungsional. Dalam pekerjaan ini, saya menggunakan tools seperti Figma dan Adobe XD untuk
                            membuat wireframes, prototipe, serta user flow yang efektif.</p>
                        <div class="flex mt-6 justify-between ">
                            <p class=" w-4/6 font-semibold text-xl">Jabatan - Back End Developer PT.Haryanto Group</p>
                            <p class="font-semibold text-xl">( 2023 - 2024 )</p>
                        </div>
                        <p class="mt-3  text-justify font-medium text-lg ">
                            Fokus utama saya adalah pada pengembangan dan pengelolaan server, basis data, serta logika
                            aplikasi
                            di sisi server. Saya menggunakan bahasa pemrograman seperti PHP dan Node.js untuk membangun API
                            dan
                            sistem back-end yang handal, efisien, dan aman. Saya juga bertanggung jawab untuk memastikan
                            data
                            yang diolah dapat diakses secara cepat dan aman oleh pengguna melalui front-end, serta
                            memastikan
                            aplikasi dapat berkembang dengan baik seiring dengan meningkatnya permintaan dan penggunaan.</p>
                    </div>

                    {{-- Latar belakang --}}
                    <div class="w-full mt-8">
                        <p class="font-bold text-orange-500 text-2xl">LATAR BELAKANG PENDIDIKAN</p>
                        <div class="flex items-center w-full mt-2">
                            <div class=" w-1/6 border-t-8 border-orange-500"></div>
                            <div class="w-5/6 border-t-2 border-orange-500"></div>
                        </div>
                        <div class=" flex mt-5 justify-between">
                            <p class=" w-4/6 font-bold text-xl">Universitas Gadjah Mada</p>
                            <p class="font-bold text-xl">( 2018 - 2019 )</p>
                        </div>
                        <p class="w-4/6 font-bold text-xl">Teknik Informatika</p>
                        <div class=" flex mt-5 justify-between">
                            <p class=" w-4/6 font-bold text-xl">SMK Negeri 2 Yogyakarta</p>
                            <p class="font-bold text-xl">( 2018 - 2019 )</p>
                        </div>
                        <p class="w-4/6 font-bold text-xl">Teknik Komputer dan Jaringan</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex justify-center items-center mt-8 border-t border-gray-300 pt-4">
                <img src="{{ asset('/images/logo-orange.svg') }}" alt="Logo" class="h-12 mr-2">
                <p class="text-gray-600 text-sm">Copyright©2024 areakerja.com</p>
            </div>
        </div>
@endsection