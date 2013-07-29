<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script>
        function printFrs(){
            var head = '<html><head><title>Sebaran Matakuliah</title><link href="<?php echo site_url("assets/styles/app.print.css")?>" rel="stylesheet"><body>';
            var close = '</body></html>';
            var content = document.getElementById('frs_content').innerHTML;
            window.frames["frs_print_frame"].document.body.innerHTML = head + content + close ;
            window.frames["frs_print_frame"].window.focus();
            window.frames["frs_print_frame"].window.print();
        }
        $(document).ready(function(){
            $.pnotify({
                title: 'Saran Pencetakan',
                text: 'Untuk tampilan cetak terbaik, gunakan Google Chrome Web Browser',
                type: 'info'
            });
        });
    </script>
</head>
<body>
<?php echo $_header;?>

<div class="container-fluid">
    <div class="row-fluid" id="header-area">
        <?php echo $_head_area;?>
    </div>
    <div class="row-fluid" id="content-area">
        <section class="span9" id="ch-main-content">
            <div class="row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <article class="ch-article span12">
                            <header>Data FRS</header>
                            <div class="ch-article-content">
                                <div id="frs_content">
                                    <div class="frs_header">
                                        <img src="<?php echo site_url('assets/pictures/uyp-bw.png')?>">
                                        <h1>UNIVERSITAS YUDHARTA PASURUAN</h1>
                                        <p> Kampus : Jl. Yudharta No. 07 (Pesantren Ngalah), Purwosari-Pasuruan Telp/Fax. 0343 611186</p>
                                        <br>
                                        <h1>FORMULIR RENCANA STUDI (FRS)</h1>
                                        <hr>
                                    </div>
                                <table class="head-table">
                                    <tr>
                                        <td>Nama Mahasiswa</td>
                                        <td class="dotted"><?php echo $frs['user_full_name']?></td>
                                        <td>Semester</td>
                                        <td class="dotted"><?php echo $frs['frs_semester']?></td>
                                    </tr>
                                    <tr>
                                        <td>Program Studi</td>
                                        <td class="dotted"><?php $prostud = explode('/',$frs['frs_fak_prod']); echo $prostud[1]?></td>
                                        <td>Fakultas / Jurusan</td>
                                        <td class="dotted"><?php echo $frs['frs_fak_prod']?></td>
                                    </tr>
                                    <tr>
                                        <td>Nim</td>
                                        <td class="dotted"><?php echo $frs['user_code']?></td>
                                        <td>Pembimbing Akademik</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Nimko</td>
                                        <td class="dotted"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                                <table id="frs_detail"class="table table-striped table-condensed table-bordered ch-table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode MK</th>
                                        <th>Matakuliah</th>
                                        <th>SKS</th>
                                        <th>Dosen</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(empty($frs_detail)) { echo"<tr><td colspan=\"4\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
                                    $no = 1;
                                    $sks = 0;
                                    foreach($frs_detail as $frs): ?>
                                        <tr id="<?php echo $frs['frs_id'];?>">
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $frs['mk_kode'];?></td>
                                            <td><?php echo $frs['mk_nama'];?></td>
                                            <td><?php echo $frs['mk_sks'];?></td>
                                            <td><?php echo $frs['mk_dosen'];?></td>
                                            <td><?php echo $frs['frs_keterangan'];?></td>
                                        </tr>
                                    <?php
                                        $sks = $sks + $frs['mk_sks'];
                                        $no++;
                                    endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align: center">JUMLAH</th>
                                            <th><?php echo $sks?></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                                <iframe id="printing-frame" name="frs_print_frame" src="about:blank" style="display:none;"></iframe>
                                <div class="row-fluid">
                                    <div class="span9">

                                    </div>
                                    <div class="span3 btn-group">
                                        <button class="btn" onclick="javascript:history.back()"><i class="icon-chevron-left"></i> Kembali</button>
                                        <button class="btn" onclick="javascript:printFrs()"><i class="icon-print"></i> Cetak</button>
                                    </div>
                                </div>

                                <ul class="ch-contextmenu" id="menu_menu">
                                    <li class="separator"><a href="#v-grup">Lihat Pengelompokan</a></li>
                                </ul>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <aside class="span3" id="ch-sidebar">
            <?php echo $_sidebar;?>
        </aside>
    </div>
    <div class="row-fluid" id="footer-area">
        <?php echo $_footer; ?>
    </div>
</div>
<?php echo $_bscript;?>
</body>
</html>