<table id="users_data"class="table table-striped table-hover table-condensed ch-table">
    <thead>
    <tr>
        <th>Nomor Induk</th>
        <th>Nama Lengkap</th>
        <th>Fakultas /Prodi</th>
        <th>Angkatan</th>
        <th>Program</th>
        <th>Lihat Transkrip</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(empty($users)) { echo"<tr><td colspan=\"6\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
    foreach($users as $user):
    ?>
        <tr>
            <td><?php echo $user['user_code'];?></td>
            <td><?php echo $user['user_full_name'];?></td>
            <td><?php echo $user['mhs_fak_prodi'];?></td>
            <td><?php echo $user['mhs_angkatan'];?></td>
            <td><?php echo $user['mhs_program'];?></td>
            <td><a href="<?php echo base_url('nilai/transkrip_mahasiswa/transkrip/'.$user['user_id']);?>">Lihat Transkrip</a></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
