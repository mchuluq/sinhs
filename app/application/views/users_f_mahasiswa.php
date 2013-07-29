<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/toggle-switch.css')?>"/>
    <script>
        function addField(){
            var field = '<tr>' +
                '<td><input type="text" name="user_code[]" class="span12" placeholder="N.I.M"></td>'+
                '<td><input type="text" name="user_full_name[]" class="span12" placeholder="Nama Lengkap"></td>'+
                '<td><input type="text" name="mhs_fak_prod[]" class="span12" placeholder="Fakultas / Prodi" data-provide="typeahead" autocomplete="off" data-items="4" data-source=\'[<?php echo implode(",",$fpl)?>]\'></td>'+
                '<td><input type="text" name="mhs_angkatan[]" class="span12" placeholder="Ankgkatan"></td>'+
                '<td><input type="text" name="mhs_program[]" class="span12" placeholder="Program" data-provide="typeahead" autocomplete="off" data-items="4" data-source=\'["reguler","ekstensi"]\'></td>'+
                '<td><a class="btn del-field" onclick="javascript:$(this).parent().parent().remove()">hapus</a></td>' +
                '</tr>';
            $("#mahasiswa_form table tbody").append(field);
        }
        $(document).ready(function(){
            addField();
            $.sinhs.xForm("#mahasiswa_form");
            $('#add-field').click(function(){
                addField();
            });
        })
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
                            <header><?php echo $user['title'] ?></header>
                            <div class="ch-article-content">
                                <form id="mahasiswa_form" action="<?php echo $user['action']?>" method="POST">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <td>Nomor Induk Mahasiswa</td>
                                            <td>Nama Lengkap</td>
                                            <td>Fakultas / Prodi</td>
                                            <td>Angkatan</td>
                                            <td>Program</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <div class="btn-group" style="float:right;margin:5px;">
                                        <input type="submit" class="btn btn-primary"value="simpan">
                                        <input type="reset" class="btn"value="reset">
                                        <a id="add-field" accesskey="a" class="btn"><i class="icn icon-plus"></i> Tambah</a>
                                        <a href="<?php echo base_url('users/index/mahasiswa')?>" class="btn"><i class="icn icon-user"></i> Lihat Data</a>
                                    </div>
                                </form>
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