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
    function loadData(url){
        var cari = $("input#searchbox").val();
        var safe = cari.replace(/\s/g,"");
        var limit = $("select#limitbox").val();
            $.ajax({
            url: url+"/"+limit+"/"+ safe,
            success:function(data){
                $('#mk_data').html(data);
            }
        });
    }
    function v_detail(id){
        /*$.ajax({
            url: '<?php echo base_url("matakuliah/index/detail")?>/'+id,
            success:function(data){
                $('#mk_data').html(data);
            }
        });*/
        document.location = '<?php echo base_url("matakuliah/index/detail")?>/'+id;
    }
    $(document).ready(function(){
        $(".ch-pagination a").click(function(e){
            e.preventDefault();
            var offset = $(this).attr('id');
            if(offset != undefined){
                var url = "<?php echo base_url('matakuliah/index/grup')?>"+"/"+offset;
                loadData(url);
            }
        })
        $("#formSearch").submit(function(e){
            e.preventDefault;
            loadData("<?php echo base_url('matakuliah/index/grup/0');?>");
            return false;
        })

        $("table#mk_grouped tbody tr").contextMenu({
            menu: 'menu_menu'
        }, function(action, el, pos) {
            switch(action){
                case 'add':
                    document.location = '<?php echo base_url("matakuliah/add")?>';
                    break;
                case 'v-detil':
                    var id=$(el).attr('id');
                    v_detail(id);
                    break;
            }
        });
    })
</script>
<table id="mk_grouped"class="table table-striped table-hover table-condensed ch-table">
    <thead>
    <tr>
        <th>Semester</th>
        <th>Tahun Ajaran</th>
        <th>Fakultas / Prodi</th>
        <th>Jumlah Matakuliah</th>
        <th>Total SKS</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(empty($mk_grouped)) { echo"<tr><td colspan=\"6\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
    foreach($mk_grouped as $mk): ?>
        <tr id="<?php echo $mk['mk_grup'];?>">
            <td><?php echo $mk['mk_semester'];?></td>
            <td><?php echo $mk['mk_thn_ajar'];?></td>
            <td><?php echo $mk['mk_fak_prod'];?></td>
            <td><?php echo $mk['total_matkul'];?></td>
            <td><?php echo $mk['total_sks'];?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<div class="row-fluid">
    <div class="span12" style="text-align:center;">
        <?php echo $pagination ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span9 ch-pagination-total">
        <?php echo $total ?>
    </div>
    <div class="span3 btn-group">
        <a class="btn btn-primary" href="<?php echo base_url('matakuliah/add')?>">Tambah Data matakuliah</a>
    </div>
</div>

<ul class="ch-contextmenu" id="menu_menu">
    <li><a href="#add">Tambah Data matakuliah</a></li>
    <li><a href="#v-detil">Lihat Detil</a></li>
</ul>