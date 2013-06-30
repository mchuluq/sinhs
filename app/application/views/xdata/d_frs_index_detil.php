<script>
    function loadCurrentData(){
        var current_url = "<?php echo base_url($this->uri->uri_string())?>";
        $.ajax({
            url: current_url,
            success:function(data){
                $('#frs_data').html(data);
            }
        });
    }
    function v_grup(){
        $.ajax({
            url: "<?=base_url('frs/index/grup/0')?>",
            success:function(data){
                $('#frs_data').html(data);
            }
        });
    }
    function dropFrs(id){
        alertify.confirm('Apakah anda ingin menghapus data ini ?',function(r) {
            if(r){
                $.ajax({
                    url: "<?=base_url('frs/drop')?>"+"/"+id,
                    dataType: "json",
                    success:function(data){
                        //cloudfire.notification(data.message,{title:data.title,type:data.type});
                        $.pnotify({
                            title: data.title,
                            text: data.message,
                            type: data.type
                        });
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
        $("table#frs_detail tbody tr").contextMenu({
            menu: 'menu_menu'
        }, function(action, el, pos) {
            switch(action){
                case 'v-grup':
                    v_grup();
                    break;
                case 'drop':
                    var id=el.attr('id');
                    dropFrs(id);
                    break;
            }
        });
    })
</script>
<table id="frs_detail"class="table table-striped table-hover table-condensed ch-table">
    <thead>
    <tr>
        <th>Semester</th>
        <th>Matakuliah</th>
        <th>SKS</th>
        <th>Dosen</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(empty($frs_detail)) { echo"<tr><td colspan=\"4\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
    foreach($frs_detail as $frs): ?>
        <tr id="<?php echo $frs['frs_id'];?>">
            <td><?php echo $frs['frs_semester'];?></td>
            <td><?php echo $frs['mk_nama'];?></td>
            <td><?php echo $frs['mk_sks'];?></td>
            <td><?php echo $frs['mk_dosen'];?></td>
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

    </div>
</div>

<ul class="ch-contextmenu" id="menu_menu">
    <li class="separator"><a href="#v-grup">Lihat Pengelompokan</a></li>
    <li><a href="#drop"><i class="icn icon-trash"></i>Hapus</a></li>
</ul>