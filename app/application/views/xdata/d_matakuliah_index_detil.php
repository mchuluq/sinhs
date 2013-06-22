<script>
    function loadCurrentData(){
        var current_url = "<?php echo base_url($this->uri->uri_string())?>";
        $.ajax({
            url: current_url,
            success:function(data){
                $('#mk_data').html(data);
            }
        });
    }
    function v_grup(){
        $.ajax({
            url: "<?=base_url('matakuliah/index/grup/0')?>",
            success:function(data){
                $('#mk_data').html(data);
            }
        });
    }
    function dropMk(id){
        cloudfire.confirm('Apakah anda ingin menghapus data ini ?',function(r) {
            if(r){
                $.ajax({
                    url: "<?=base_url('matakuliah/drop')?>"+"/"+id,
                    dataType: "json",
                    success:function(data){
                        cloudfire.notification(data.message,{title:data.title,type:data.type});
                        if(data.type == 'success'){
                            loadCurrentData();
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