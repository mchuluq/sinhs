<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script>
        function v_grup(){
            /*$.ajax({
                url: "<?=base_url('matakuliah/index/grup/0')?>",
                success:function(data){
                    $('#mk_data').html(data);
                }
            });*/
            document.location = "<?php echo base_url('matakuliah/index')?>";
        }
        function dropMk(id){
            alertify.confirm('Apakah anda ingin menghapus data ini ?',function(r) {
                if(r){
                    $.ajax({
                        url: "<?=base_url('matakuliah/drop')?>"+"/"+id,
                        dataType: "json",
                        success:function(data){
                            //cloudfire.notification(data.message,{title:data.title,type:data.type});
                            $.pnotify({
                                title: data.title,
                                text: data.message,
                                type: data.type
                            });
                            if(data.type == 'success'){
                                setTimeout(function(){
                                    location.reload();
                                },3000);
                            }
                        }
                    });
                }else{
                    return false
                };
            });
        }
        $(document).ready(function(){
            $("table#mk_detail tbody tr").contextMenu({
                menu: 'menu_menu'
            }, function(action, el, pos) {
                switch(action){
                    case 'add':
                        document.location= '<?php echo base_url("matakuliah/add")?>';
                        break;
                    case 'edit':
                        var id=el.attr('id');
                        document.location='<?php echo base_url("matakuliah/edit")?>/'+id;
                        break;
                    case 'v-grup':
                        v_grup();
                        break;
                    case 'drop':
                        var id=el.attr('id');
                        dropMk(id);
                        break;
                }
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
                            <header>Data matakuliah</header>
                            <div class="ch-article-content">
                                <table id="mk_detail"class="table table-striped table-hover table-condensed ch-table">
                                    <thead>
                                    <tr>
                                        <th>Kode MK</th>
                                        <th>Matakuliah</th>
                                        <th>SKS</th>
                                        <th>Dosen</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(empty($mk_detail)) { echo"<tr><td colspan=\"4\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
                                    foreach($mk_detail as $mk): ?>
                                        <tr id="<?php echo $mk['mk_id'];?>">
                                            <td><?php echo $mk['mk_kode'];?></td>
                                            <td><?php echo $mk['mk_nama'];?></td>
                                            <td><?php echo $mk['mk_sks'];?></td>
                                            <td><?php echo $mk['mk_dosen'];?></td>
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                                <div class="row-fluid">
                                    <div class="span12" style="text-align:center;">

                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span9 ch-pagination-total">

                                    </div>
                                    <div class="span3 btn-group">
                                        <a class="btn btn-primary" href="<?php echo base_url('matakuliah/add')?>">Tambah Data matakuliah</a>
                                    </div>
                                </div>

                                <ul class="ch-contextmenu" id="menu_menu">
                                    <li><a href="#add">Tambah Data matakuliah</a></li>
                                    <li><a href="#edit">Ubah</a></li>
                                    <li class="separator"><a href="#v-grup">Lihat Pengelompokan</a></li>
                                    <li><a href="#drop"><i class="icn icon-trash"></i>Hapus</a></li>
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

</body>
</html>