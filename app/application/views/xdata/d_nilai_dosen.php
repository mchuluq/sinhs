<script>
    $(document).ready(function(){

    })
</script>
<table id="mk_detail"class="table table-striped table-hover table-condensed ch-table">
    <thead>
    <tr>
        <th>Kode MK</th>
        <th>Matakuliah</th>
        <th>SKS</th>
        <th>Semester</th>
        <th>Jumlah Mahasiswa</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(empty($mkl)) { echo"<tr><td colspan=\"4\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
    foreach($mkl as $mk): ?>
        <tr id="<?php echo $mk['mk_id'];?>">
            <td><?php echo $mk['mk_kode'];?></td>
            <td><?php echo $mk['mk_nama'];?></td>
            <td><?php echo $mk['mk_sks'];?></td>
            <td><?php echo $mk['mk_semester'];?></td>
            <td><?php echo $mk['total_mhs']?></td>
            <td><a href="<?php echo base_url('nilai/input/'.$mk['mk_id'])?>">Input Nilai</a></td>
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
    <div class="span12 ch-pagination-total">
        <?php echo $total ?>
    </div>
</div>