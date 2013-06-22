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
    function loadData(url){
        var cari = $("input#searchbox").val();
        var safe = cari.replace(/\s/g,"");
        var limit = $("select#limitbox").val();
            $.ajax({
            url: url+"/"+limit+"/"+ safe,
            success:function(data){
                $('#frs_data').html(data);
            }
        });
    }
    $(document).ready(function(){
        $('.frs_det').click(function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('href'),
                success:function(data){
                    $('#frs_data').html(data);
                }
            });

        })
        $(".ch-pagination a").click(function(e){
            e.preventDefault();
            var offset = $(this).attr('id');
            if(offset != undefined){
                var url = "<?php echo base_url('frs/index/grup')?>"+"/"+offset;
                loadData(url);
            }
        })
        $("#formSearch").submit(function(e){
            e.preventDefault;
            loadData("<?php echo base_url('frs/index/grup/0');?>");
            return false;
        })
    })
</script>
<table id="frs_grouped"class="table table-striped table-hover table-condensed ch-table">
    <thead>
    <tr>
        <th>Semester</th>
        <th>Tahun Ajaran</th>
        <th>Fakultas / Prodi</th>
        <th>Nama Mahasiswa</th>
        <th>Total Matakuliah</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(empty($frs_grouped)) { echo"<tr><td colspan=\"6\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
    foreach($frs_grouped as $frs): ?>
        <tr>
            <td><?php echo $frs['frs_semester'];?></td>
            <td><?php echo $frs['frs_thn_ajar'];?></td>
            <td><?php echo $frs['frs_fak_prod'];?></td>
            <td><b><?php echo $frs['user_full_name'];?></b> ( <?php echo $frs['user_code'];?> )</td>
            <td><?php echo $frs['total_matkul'];?></td>
            <td><a class="frs_det" href="<?php echo base_url("frs/index/detail").'/'.$frs['frs_grup']?>">Lihat Detil</a></td>
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

    </div>
</div>
