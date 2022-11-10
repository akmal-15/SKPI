<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta name=Generator content="Microsoft Word 15 (filtered)">
    <style>
        <!--
        /* Font Definitions */
        @font-face {
            font-family: "Cambria Math";
            panose-1: 2 4 5 3 5 4 6 3 2 4;
        }

        @font-face {
            font-family: Calibri;
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
            font-family: "Times New Roman", serif;
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
        -->
    </style>

</head>

<body lang=EN-US style='word-wrap:break-word'>

    <div class=WordSection1>

        <p class=MsoNormal align=center style='text-align:center'><span lang=EN-ID
                style='font-size:16.0pt;line-height:107%'>SURAT KETERANGAN PENDAMPING IJAZAH</span></p>

        <p class=MsoNormal align=center style='text-align:center'><span lang=EN-ID
                style='font-size:14.0pt;line-height:107%'>Diploma Supplement</span></p>

        <p class=MsoNormal align=center style='text-align:center'><span style='position:absolute;z-index:251659264;left:0px;margin-left:235px;
margin-top:40px;width:789px;height:3px'><img width=789 height=3
                    src="contoh%20skpi%20gue_files/image001.png"></span><span lang=EN-ID
                style='font-size:11.0pt;line-height:107%'>NOMOR: {{ $no  }} . </span></p>

        <p class=MsoNormal><span lang=EN-ID style='font-size:14.0pt;line-height:107%'>&nbsp;</span></p>

        <p class=MsoNormal><span lang=EN-ID>Surat Keterangan Pendamping Ijazah (SKPI)
                ini mengacu pada Kerangka Kualifikasi Nasional Indonesia (KKNI). Tujuan dari
                SKPI ini adalah menerangkan Capaian Prestasi, Penghargaan ataupun Pengalaman magang
                dan organisasi mahasiswa Universitas Serang Raya.</span></p>

        <p class=MsoNormal><span lang=EN-ID style='font-size:14.0pt;line-height:107%'>&nbsp;</span></p>

        <p class=MsoNormal style='line-height:200%'><span lang=EN-ID style='font-size:
14.0pt;line-height:200%'>1. </span><span lang=EN-ID>INFORMASI TENTANG IDENTITAS
                DIRI PEMEGANG SKPI</span></p>

        <p class=MsoNormal><span lang=EN-ID style='font-size:14.0pt;line-height:107%'>          Nim                     
                :
                {{ $user["nim"] }}</span></p>

        <p class=MsoNormal><span lang=EN-ID style='font-size:14.0pt;line-height:107%'>          </span><span
                lang=EN-ID>Nama Lengkap            : {{ $user["nama"] }}</span></p>


        <p class=MsoNormal><span lang=EN-ID>            Tahun Lulus                : {{ $user["thn_masuk"] }}</span></p>

        <p class=MsoNormal><span lang=EN-ID>            Gelar                           :
                Sarjana Komputer / S.Kom.</span></p>

        <p class=MsoNormal><span lang=EN-ID>            Program Studi             : {{ $user["prodi"] }} </span></p>

    

        <p class=MsoNormal><span lang=EN-ID>&nbsp;</span></p>

        <p class=MsoNormal style='line-height:200%'><span lang=EN-ID>2. INFORMASI
                TENTANG KUALIFIKASI DAN HASIL YANG DICAPAI</span></p>
        @foreach($kualifikasi as $i => $v)
            <p class=MsoNormal><span lang=EN-ID>            {{ $i+1 }}         : {{ $v["kegiatan"] }} </span></p>
        @endForeach
        

    </div>

    <script> window.print() </script>
</body>

</html>