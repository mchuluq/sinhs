<script>
    function v_grup(){
        $.ajax({
            url: "<?=base_url('nilai/index/grup/0')?>",
            success:function(data){
                $('#nilai_data').html(data);
            }
        });
    }
    $(document).ready(function(){
        $('a.backToGroup').click(function(){
            v_grup();
        })
    })
</script>
<table id="mk_detail"class="table table-striped table-hover table-condensed ch-table">
    <thead>
    <tr>
        <th>Kode MK</th>
        <th>Matakuliah</th>
        <th>SKS</th>
        <th>Dosen</th>
        <th>Input Nilai</th>
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
            <td><a href="<?php echo base_url('nilai/input/'.$mk['mk_id'])?>">Input Nilai</a></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<div class="row-fluid">
    <div class="span10">

    </div>
    <div class="span2">
        <a class="btn btn-primary backToGroup">Kembali</a>
    </div>
</div>