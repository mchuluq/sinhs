<script>
    $(document).ready(function(){
        $('.khs_det').click(function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('href'),
                success:function(data){
                    $('#khs_data').html(data);
                }
            });

        })
    })
</script>
<table id="khs_grouped"class="table table-striped table-hover table-condensed ch-table">
    <thead>
    <tr>
        <th>Semester</th>
        <th>Tahun Ajaran</th>
        <th>Total Matakuliah</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(empty($khs_grouped)) { echo"<tr><td colspan=\"6\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
    foreach($khs_grouped as $khs): ?>
        <tr>
            <td><?php echo $khs['frs_semester'];?></td>
            <td><?php echo $khs['frs_thn_ajar'];?></td>
            <td><?php echo $khs['total_matkul'];?></td>
            <td><a class="khs_det" href="<?php echo base_url("khs/index/detail").'/'.$khs['frs_grup']?>">Lihat Detil</a></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
