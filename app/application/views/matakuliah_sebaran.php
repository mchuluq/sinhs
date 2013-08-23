<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script>
        $(document).ready(function(){
            $.sinhs.ajaxForm('#sbr_mk','#mk_data');
            $.pnotify({
                title: 'Saran Pencetakan',
                text: 'Untuk tampilan cetak terbaik, gunakan Google Chrome Web Browser',
                type: 'info'
            });
        });
        function printSbrMk(){
            var head = '<html><head><title>Sebaran Matakuliah</title><link href="<?php echo site_url("assets/styles/app.print.css")?>" rel="stylesheet"><body>';
            var close = '</body></html>';
            var content = document.getElementById('mk_data').innerHTML;
            window.frames["sbr_mk_print_frame"].document.body.innerHTML = head + content + close ;
            window.frames["sbr_mk_print_frame"].window.focus();
            window.frames["sbr_mk_print_frame"].window.print();
        }
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
                            <header>Sebaran matakuliah</header>
                            <div class="ch-article-content">
                                <form id="sbr_mk" method="POST" action="<?php echo base_url('matakuliah/sebaran')?>" class="form-inline">
                                    <select name="gg">
                                    	<option value="gnj">Ganjil</option>
                                    	<option value="gnp">Genap</option>
                                    </select>
                                    <select name="thn_ajar">
                                        <?php foreach($thn_ajar as $ta ):?>
                                            <option value="<?php echo $ta['mk_thn_ajar']?>"><?php echo $ta['mk_thn_ajar']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <select name="fp">
                                    <?php foreach($fp_list as $fp ):?>
                                        <option value="<?php echo $fp['fp_fak_prodi']?>"><?php echo $fp['fp_fak_prodi']?></option>
                                    <?php endforeach;?>
                                    </select>
                                    <button class="btn" type="submit"><i class="icn icon-search"></i> Cari</button>
                                </form>
                                <iframe id="printing-frame" name="sbr_mk_print_frame" src="about:blank" style="display:none;"></iframe>
                                <div id="mk_data">

                                </div>
                                <div style="text-align: right;padding:5px; ">
                                    <button onclick="javascript:printSbrMk()" class="btn"><i class="icon-print"></i> Cetak</button>
                                </div>
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