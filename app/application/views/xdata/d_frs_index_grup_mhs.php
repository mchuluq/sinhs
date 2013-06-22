<script>
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
            <td><?php echo $frs['user_full_name'];?></td>
            <td><?php echo $frs['total_matkul'];?></td>
            <td><a class="frs_det" href="<?php echo base_url("frs/mahasiswa/detail").'/'.$frs['frs_grup']?>">Lihat Detil</a></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
