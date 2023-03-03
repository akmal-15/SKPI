<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta name=Generator content="Microsoft Word 15 (filtered)">
    <style>
        body {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Font Definitions */
        @font-face {
            /* font-family: "Cambria Math"; */
            panose-1: 2 4 5 3 5 4 6 3 2 4;
        }

        @font-face {
            /* font-family: Calibri; */
            panose-1: 2 15 5 2 2 2 4 3 2 4;
        }

        /* Style Definitions */
        p.MsoNormal,
        li.MsoNormal,
        div.MsoNormal {
            margin-top: 0in;
            margin-right: 0in;
            margin-bottom: 8.0pt;
            margin-left: 0in;
            line-height: 107%;
            font-size: 12.0pt;
            /* font-family: "Times New Roman", serif; */
        }

        .MsoChpDefault {
            font-size: 12.0pt;
        }

        .MsoPapDefault {
            margin-bottom: 8.0pt;
            line-height: 107%;
        }

        @page WordSection1 {
            size: 595.3pt 841.9pt;
            margin: 1.0in 1.0in 1.0in 1.0in;
        }

        div.WordSection1 {
            page: WordSection1;
        }

        div.head {
            background-color: rgb(22, 22, 127);
            color: aliceblue
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body lang=EN-US style='word-wrap:break-word'>
    <div class=WordSection1>
        
        <div class="p-3 mb-2 text-white " style="background: rgb(9, 42, 133);">
            
            <p class="text-center text-uppercase fas fa-font" style="font-size: 35px"><img src="/logo.png" class="float-left" style="width: 100px; height: 100px;">Surat Keterangan Pendamping Ijazah</p>
            <p class="text-center text-uppercase" style="font-size: 20px">Nomor: skpi/{{ $user['mahasiswa_id'] }}/{{ $user['thn_lulus'] }}/{{ $no ? $no->no_surat : '-' }} </p>
        </div>

        <div class="container" style="margin-top: 20px">
            <hr color="black" width="100%">
            <i class="fas fa-font-case"><p style="font-size: 26px">Surat Keterangan Pendamping Ijazah (SKPI)
                ini mengacu pada Kerangka Kualifikasi Nasional Indonesia (KKNI). Tujuan dari
                SKPI ini adalah menerangkan Capaian Prestasi, Penghargaan ataupun Pengalaman magang
                dan organisasi mahasiswa Universitas Serang Raya.</p></i>
            
            <hr color="black" width="100%">
        </div>

        {{-- BAGIAN KE 1 --}}
        <div class="container mt-5">
            <p class="font-weight-bold far fa-font" style="font-size: 26px ">1. INFORMASI TENTANG IDENTITAS
                DIRI PEMEGANG SKPI</p>

                <div class="row">
                    <div class="ml-2 col-12 row " style="margin-bottom: 10px">
                        <div class="col-6">
                            <p style="font-size: 23px">NAMA LENGKAP</p>
                            <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px">{{ $user["nama"] }}</p>
                        </div>
                        <div class="col-6">
                            <p style="font-size: 23px">TAHUN LULUS</p>
                            <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px">{{ $user["thn_lulus"] }}</p>
                        </div>
                    </div>
                
                    <div class="ml-2 col-12 row" style="margin-bottom: 10px">
                        <div class="col-6">
                            <p style="font-size: 23px">TEMPAT TANGGAL LAHIR</p>
                            <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px">{{ $user["tempat_tanggal_lahir"] }}</p>
                        </div>
                        <div class="col-6">
                            <p style="font-size: 23px">NO IJAZAH</p>
                            <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px">{{ $user["no_ijazah"] }}</p>
                        </div>
                    </div>
                
                    <div class="ml-2 col-12 row" style="margin-bottom: 10px">
                        <div class="col-6">
                            <p style="font-size: 23px">NOMOR INDUK MAHASISWA</p>
                            <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px">{{ $user["nim"] }}</p>
                        </div>
                        <div class="col-6">
                            <p style="font-size: 23px">GELAR</p>
                            <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px">Sarjana Komputer (S.KOM)</p>
                        </div>
                    </div>
                
                </div>
                <hr color="black" width="100%">
        </div>

        

        {{-- BAGIAN KE 2 --}}
        <div class="container mt-4">
            <p class="font-weight-bold" style="font-size: 26px">2. INFORMASI TENTANG IDENTITAS PENYELENGGARA</p>

            <div class="row">
                <div class="ml-2 col-12 row " style="margin-bottom: 10px">
                    <div class="col-6">
                        <p style="font-size: 23px">SK PENDIRIAN PERGURUAN TINGGI</p>
                        <p class="bg-secondary p-1 text-center text-white" style="font-size: 19px">Nomor: 262/D/O/2008, Tanggal 23 Desember 2008</p>
                    </div>
                    <div class="col-6">
                        <p style="font-size: 23px">PERSYARATAN PENERIMAAN</p>
                        <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px">Lulus pendidikan menengah atas/sederajat</p>
                    </div>
                </div>
            
                <div class="ml-2 col-12 row" style="margin-bottom: 10px">
                    <div class="col-6">
                        <p style="font-size: 23px">NAMA PERGURUAN TINGGI</p>
                        <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px">Universitas Serang Raya</p>
                    </div>
                    <div class="col-6">
                        <p style="font-size: 23px">BAHASA PENGANTAR KULIAH</p>
                        <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px" >Indonesia</p>
                    </div>
                </div>
            
                <div class="ml-2 col-12 row" style="margin-bottom: 10px">
                    <div class="col-6">
                        <p style="font-size: 23px">PROGRAM STUDI</p>
                        <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px">{{ $user["prodi"] }}</p>
                    </div>
                    <div class="col-6">
                        <p style="font-size: 23px">SISTEM PENILAIAN</p>
                        <p class="bg-secondary p-1 text-center text-white" style="font-size: 19px">Skala 46-100; A=80-100, A-=77-79, B+=74-76, B=68-73, B-=65-67, C+=62-64,
                            C=56-61, D=46-55</p>
                    </div>
                </div>
            
                <div class="ml-2 col-12 row" style="margin-bottom: 10px">
                    <div class="col-6">
                        <p style="font-size: 23px">JENIS & JENJANG PENDIDIKAN</p>
                        <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px">Akademik & Sarjana (Strata 1)</p>
                    </div>
                    <div class="col-6">
                        <p style="font-size: 23px">LAMA STUDI REGULER</p>
                        <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px">8 Semester</p>
                    </div>
                </div>
            
                <div class="ml-2 col-12 row" style="margin-bottom: 10px">
                    <div class="col-6">
                        <p style="font-size: 23px">JENJANG KUALIFIKASI SESUAI KKNI</p>
                        <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px">Level 6</p>
                    </div>
                    <div class="col-6">
                        <p style="font-size: 23px">JENJANG PENDIDIKAN LANJUTAN</p>
                        <p class="bg-secondary p-1 text-center text-white" style="font-size: 22px">Program Magister</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN KE 3 --}}
        <div class="container " style="margin-top: 100px">
           
            <p class="font-weight-bold" style="font-size: 26px">3. INFORMASI
            TENTANG KUALIFIKASI DAN HASIL YANG DICAPAI</p>
       
            <div class="row">
                <div class="ml-2 col-12 row " style="margin-bottom: 10px">
                    <div class="col-8">
                        <p class="font-weight-bold" style="font-size: 24px">A. CAPAIAN PEMBELAJARAN</p>
                        <p class=" ml-3 p-1 bg-secondary text-white" style="font-size: 23px">SARJANA KOMPUTER: {{ $user["prodi"]  }} (KKNI Level 6)</p>
                    </div>
                </div>
        
                <div class="ml-4 col-12 row" >
                    <div class="col-4">
                        <p class="bg-secondary p-1 text-white" style="font-size: 23px">KEMAMPUAN KERJA:</p>
                    </div>
                </div>
        
                <div class="ml-4 col-12 row" >
                    <div class="col-12 row">
                        @foreach($cp as $i => $v)
                        <div class="col-12 ml-3">
                            <p class=MsoNormal style="margin-top: 10px; font-size: 23px">{{ $i+1 }}    : {{$v["kemampuan_kerja"]}}</p>
                        </div>
                        
                        @endForeach
                    </div>
                </div>


                <div class="ml-4 col-12 row mt-3">
                    <div class="col-5">
                        <p class="bg-secondary p-1 text-white" style="font-size: 23px">PENGUASAAN PENGETAHUAN:</p>
                    </div>
                </div>

                <div class="ml-4 col-12 ">
                    
                        @foreach($nilai as $i => $v)
                            <div class="ml-4"> 
                                <p class=MsoNormal style="margin-top: 10px; font-size: 23px"> {{ $i+1 }}     : Memahami materi {{ $v['nama_materi'] }} dengan nilai {{ $v['grade'] }}</p>
                            </div>
                        @endForeach

                        <hr>

                            <div class="col-12 row">
                                @foreach($cp as $i => $v)
                                <div class="col-12 ml-3">
                                    <p class=MsoNormal style="margin-top: 10px; font-size: 23px">{{ $i+1 }}     : {{
                                    $v["penguasaan_pengetahuan"]
                                    }}</p>
                                </div>
                                {{-- <div class="col">
                                    <p class=MsoNormal style="margin-top: 10px; font-size: 23px">: {{
                                        $v["penguasaan_pengetahuan"]
                                        }}</p>
                                </div> --}}
                                @endForeach
                            </div>
                            
                </div>

                <div class="ml-4 col-12 row mt-3">
                    <div class="col-3">
                        <p class="bg-secondary p-1 text-white" style="font-size: 23px">SIKAP KHUSUS:</p>
                    </div>
                </div>
                
                <div class="ml-4 col-12 row">
                    
                        <div class="col-12 row">
                            @foreach($cp as $i => $v)
                            <div class="col-12 ml-3">
                                <p class=MsoNormal style="margin-top: 10px; font-size: 23px">{{ $i+1 }}    : {{$v["sikap_khusus"]}}</p>
                            </div>
                            @endForeach
                        </div>
                    
                </div>
                

                <div class="ml-2 mt-4 col-12 row ">
                    <div class="col-12">
                        <p class="font-weight-bold" style="font-size: 24px">B. AKTIVITAS PRESTASI DAN PENGHARGAAN </p>
                        <p class="ml-5" style="font-size: 23px">Pemegang Surat Keterangan Pendamping
                        Ijazah ini memiliki sertifikat professional:</p>
                        {{-- @foreach($kualifikasi as $i => $v)
                        <p class=MsoNormal style="margin-top: 10px; font-size: 23px"><span lang=EN-ID>            {{ $i+1 }}         : {{
                                $v["kegiatan"]
                                }} </span></p>
                        @endForeach --}}
                        <div class="ml-4 col-12 row">
                        
                            <div class="col-12 row">
                                @foreach($kualifikasi as $i => $v)
                                <div class="col-12 ml-1">
                                    <p class=MsoNormal style="margin-top: 10px; font-size: 23px">{{ $i+1 }}    : {{$v["kegiatan"]}}</p>
                                </div>
                                @endForeach
                            </div>
                        
                        </div>
                    </div>
                </div>

                <div class="ml-2 mt-4 col-12 row ">
                    
                    <div class="ml-2 col-12 row">
                        <p class="ml-5" style="font-size: 23px">Mahasiswa FTI Unsera telah mengikuti program atau telah memenuhi tanggung jawab berikut ini:</p>
                        <div class="col-12 ">
                            @foreach($kualifikasi2 as $i => $v)
                            <div class="col-12 ml-3">
                                <p class=MsoNormal style="margin-top: 10px; font-size: 23px">{{ $i+1 }}    : {{$v["kegiatan"]}}</p>
                            </div>
                            @endForeach
                        </div>
                    
                    </div>
                </div>

                <div class="ml-3 mt-4 col-12 row ">
                    <div class="col-12">
                        <p class="ml-3" style="font-size: 22px">Catatan:
                        Program-program tersebut di atas terdiri
                        atas kegiatan untuk mengembangkan soft
                        skills mahasiswa. Daftar kegiatan kurikuler
                        dan ekstra-kurikuler yang diikuti oleh
                        pemegang SKPI ini terlampir.</p>
                    </div>
                </div>
        
            </div>
        </div>

        {{-- BAGIAN KE 4 --}}
        <div class="container " style="margin-top: 300px">
        
            <p class="font-weight-bold" style="font-size: 26px">4. INFORMASI
                TENTANG SISTEM PENDIDIKAN TINGGI DI INDONESIA </p>

            <div class="row">
                <div class="ml-2 col-12 row " style="margin-bottom: 10px">
                    <div class="col-12">
                        <p class="font-weight-bold" style="font-size: 24px">Sistem Pendidikan Tinggi di Indonesia</p>
                        <P class="ml-3" style="font-size: 21px">Pendidikan tinggi terdiri dari (1) pendidikan akademik yang memiliki
                        fokus dalam penguasaan ilmu pengetahuan dan (2) pendidikan
                        vokasi yang menitikberatkan pada persiapan lulusan untuk
                        mengaplikasikan keahliannya</P>
                        <p class="ml-3" style="font-size: 21px">Institusi Pendidikan Tinggi yang menawarkan pendidikan akademik
                        dan vokasi dapat dibedakan berdasarkan jenjang dan program studi
                        yang ditawarkan seperti universitas, institut, sekolah tinggi,
                        politeknik, akademi dan akademi komunitas.</p>
                        <p class="ml-3" style="font-size: 21px">Universitas merupakan Perguruan Tinggi yang menyelenggarakan
                        pendidikan akademik dan dapat menyelenggarakan pendidikan
                        vokasi dalam berbagai rumpun Ilmu Pengetahuan dan/atau
                        Teknologi dan jika memenuhi syarat, universitas dapat
                        menyelenggarakan pendidikan profesi.</p>
                        <p class="ml-3" style="font-size: 21px">Akademik merupakan Perguruan Tinggi yang menyelenggarakan pendidikan vokasi dalam satu atau beberapa cabang ilmu pengetahuan atau teknologi tertentu. </p>
                        <p class="ml-3" style="font-size: 21px">Akademik Komunitas merupakan Perguruan Tinggi yang
                        menyelenggarakan pendidikan vokasi setingkat diploma satu
                        dan/atau diploma dua dalam satu atau beberapa cabang Ilmu
                        Pengetahuan dan/atau Teknologi tertentu yang berbasis keunggulan
                        lokal atau untuk memenuhi kebutuhan khusus.</p>
                    </div>
                </div>

                <div class="ml-2 col-12 row " style="margin-bottom: 10px">
                    <div class="col-12">
                        <p class="font-weight-bold" style="font-size: 24px">Jenjang Pendidikan dan Syarat Belajar</p>
                        <p class="ml-3" style="font-size: 21px">Institusi pendidikan tinggi menawarkan berbagai jenjang pendidikan
                        baik berupa pendidikan akademis maupun pendidikan vokasi.
                        Perguruan tinggi yang memberikan pendidikan akademis dapat
                        menawarkan jenjang pendidikan Sarjana (S1), Program Profesi,
                        Magister (S2), Program Spesialis (SP) dan Program Doktoral (S3).
                        Sedangkan pendidikan vokasi menawarkan program Diploma I, II, II
                        dan IV.</p>
                    </div>
                </div>

                <div class="ml-2 col-12 row " style="margin-bottom: 10px">
                    <div class="col-12">
                        <p class="font-weight-bold" style="font-size: 24px">SKS dan Lama Studi</p>
                        <p class="ml-3" style="font-size: 21px">SKS adalah singkatan dari satuan kredit semester. Dengan sistem
                        ini, mahasiswa dimungkinkan untuk memilih sendiri mata kuliah
                        yang akan ia ambil dalam satu semester. SKS digunakan
                        sebagai ukuran:</p>
                        <p class="ml-4" style="font-size: 21px">-. Besarnya beban studi mahasiswa.</p>
                        <p class="ml-4" style="font-size: 21px">-. Besarnya pengakuan atas keberhasilan usaha belajar
                        mahasiswa.</p>
                        <p class="ml-4" style="font-size: 21px">-. Besarnya usaha belajar yang diperlukan mahasiswa untuk menyelesaikan suatu program, baik program semesteran maupun
                        program lengkap.</p>
                        <p class="ml-4" style="font-size: 21px">-. Besarnya usaha penyelenggaraan pendidikan bagi tenaga pengajar</p>

                        <p class="ml-3" style="font-size: 21px">Seorang mahasiswa dapat dinyatakan lulus apabila telah
                        menyelesaikan jumlah SKS tertentu. Untuk menyelesaikan
                        pendidikan Sarjana (S1), seorang mahasiswa diwajibkan untuk
                        menyelesaikan beban studi program sarjana sekurang-kurangnya
                        144 (seratus empat puluh empat) SKS dan sebanyak-banyaknya 160
                        (seratus enam puluh) SKS yang dijadwalkan untuk 8 (delapan)
                        semester dan dapat ditempuh dalam waktu kurang dan 8 (delapan)
                        semester dan selama-lamanya 14 (empat belas) semester setelah
                        pendidikan menengah. Pada jenjang Magister (S2), seorang
                        mahasiswa harus menyelesaikan beban studi sekurang-kurangnya
                        36 (tiga puluh enam) SKS dan sebanyak-banyaknya 50 (lima puluh)
                        SKS yang dijadwalkan untuk 4 (empat) semester dan dapat ditempuh
                        dalam waktu kurang dan 4 (empat) semester dan selama-lamanya 10
                        (sepuluh) semester termasuk penyusunan tesis, setelah program
                        sarjana, atau yang sederajat.</p>
                    </div>
                </div>
            </div>    

        </div>

        {{-- BAGIAN KE 5 --}}
        <div class="container " style="margin-top: 30px">
        
            <p class="font-weight-bold" style="font-size: 25px">5. INFORMASI
                TENTANG KERANGKA KUALIFIKASI NASIONAL INDONESIA (KKNI) </p>

            <div class="row">
                <div class="ml-2 col-12 row " style="margin-bottom: 10px">
                    <div class="col-12">
                        <p class="ml-2" style="font-size: 21px">Kerangka Kualifikasi Nasional Indonesia (KKNI)
                        adalah kerangka penjenjangan kualifikasi dan
                        kompetensi tenaga kerja Indonesia yang
                        menyandingkan, menyetarakan, dan
                        mengintegrasikan sektor pendidikann dengan
                        sektor pelatihan dan pengalaman kerja dalam
                        suatu skema pengakuan kemampuan kerja yang
                        disesuaikan dengan struktur di berbagai sektor
                        pekerjaan. KKNI merupakan perwujudan mutu
                        dan jati diri Bangsa Indonesia terkait dengan
                        sistem pendidikan nasional, sistem pelatihan
                        kerja nasional serta sistem penilaian kesetaraan
                        capaian pembelajaran (learning outcomes)
                        nasional, yang dimiliki Indonesia untuk
                        menghasilkan sumberdaya manusia yang
                        bermutu dan produktif</p>
                    </div>

                    <div class="col-12">
                        <p class="ml-2" style="font-size: 21px">KKNI merupakan sistem yang berdiri sendiri dan
                        merupakan jembatan antara sektor pendidikan
                        dan pelatihan untuk membentuk SDM nasional
                        berkualitas dan bersertifikat melalui skema
                        pendidikan formal, non formal, in formal,
                        pelatihan kerja atau pengalaman kerja. Jenjang
                        kualifikasi adalah tingkat capaian pembelajaran
                        yang disepakati secara nasional, disusun
                        berdasarkan ukuran hasil pendidikan dan/atau
                        pelatihan yang diperoleh melalui pendidikan
                        formal, nonformal, informal, atau pengalaman
                        kerja seperti yang ditunjukkan pada Gambar 1.
                        KKNI terdiri dari 9 (sembilan) jenjang kualifikasi,
                        dimulai dari kualifiaksi 1 sebagai kualifiaksi
                        terendah hingga kualifikasi 9 sebagai kualifikasi
                        tertinggi.</p>
                    </div>

                </div>   
            </div>

        </div>

        {{-- BAGIAN KE 6 --}}
        <div class="container " style="margin-top: 30px">
        
            <p class="font-weight-bold" style="font-size: 26px">6. PENGESAHAN SKPI </p>
        
            <div class="row">

                <div class="ml-2 mt-5 col-12 row " style="margin-bottom: 10px">
                    <div class="col-6">
                        <p class="ml-2" style="margin-bottom: 80px">         </p>
                        <p class="ml-2 mt-3" style="font-size: 25px">Serang, ..................................</p>
                    </div>
                    <div class="col-6">
                        <p class="ml-2 text-center" style="font-size: 21px">Dekan FTI UNSERA</p>
                        <p class="ml-2" style="margin-bottom: 90px">         </p>
                        <p class="ml-2 text-center" style="font-size: 21px">SUMIATI, S.T., M.M., Ph.D.</p>
                        
                        <p class=" ml-2 text-center" style="font-size: 19px">NIDN: 0402098202</p>
                    </div>
                </div>

            </div>
            <hr color="black" width="100%">
 
            <div class="ml-2 mt-5 col-12 row " >
                <div class="col-8">
                    <p class="font-weight-bold" style="font-size: 22px">Catatan Resmi</p>
    
                    <p class="ml-3" style="font-size: 20px">-SKPI dikeluarkan oleh institusi pendidikan tinggi yang berwenang mengeluarkan ijazah sesuai dengan peraturan perundang-undangan yang berlaku.</p>
                    <p class="ml-3" style="font-size: 20px">-SKPI hanya diterbitkan setelah mahasiswa dinyatakan lulus dari suatu program studi secara resmi oleh Perguruan Tingg.</p>
                    <p class="ml-3" style="font-size: 20px">-SKPI diterbitkan dalam Bahasa Indonesia.</p>
                </div>

                <div class="col-4">
                    <p class="font-weight-bold" style="font-size: 22px">Alamat</p>
                    <p class="font-weight-bold" style="font-size: 21px">Universitas Serang Raya</p>
                    <p  style="font-size: 20px">Jalan Raya Serang, Cilegon KM. 5 Taman Drangong, Serang, Banten, Indonesia</p>
                    <p style="font-size: 20px">Website: unsera.ac.id</p>
                </div>
            </div>
        </div>



    </div>

    <script>
        window.print() 
    </script>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>