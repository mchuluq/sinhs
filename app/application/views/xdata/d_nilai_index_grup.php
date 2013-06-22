<script>
    function loadCurrentData(){
        var current_url = "<?php echo base_url($this->uri->uri_string())?>";
        $.ajax({
            url: current_url,
            success:function(data){
                $('#nilai_data').html(data);
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
                $('#nilai_data').html(data);
            }
        });
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
        $('a.v_detil').click(function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('href'),
                success:function(data){
                    $('#nilai_data').html(data);
                }
            });

        })
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
        <th></th>
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
            <td><a class="v_detil" href="<?php echo base_url("nilai/index/detail/".$mk['mk_grup'])?>">Lihat Detil</a></td>
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
    <div class="span3">

    </div>
</div>
