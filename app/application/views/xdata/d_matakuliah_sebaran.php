<div class="sbr_mk_head">
        <img src="<?php echo site_url('assets/pictures/uyp-bw.png')?>">
        <h1>UNIVERSITAS YUDHARTA PASURUAN </h1>
        <p>Prodi : <?php echo $fp?></p>
        <p>Tahun Ajaran : <?php echo $ta?></p>
</div>
<div class="row-fluid">
<div class="span12">
    <?php
    if(empty($matkul)){?>
        <div class="alert">
            <strong>Warning!</strong> Data Tidak ada.
        </div>
    <?php }
    $semester = null;
    foreach($matkul as $mk):
        $tbl_open = '<table class="table table-bordered table-condensed"><thead><tr><th colspan="4" class="sbr_h">Semester '.$mk['mk_semester'].' - '.$mk['mk_fak_prod'].'</th></tr><tr><th>Kode MK</th><th>Mata Kuliah</th><th>SKS</th><th>Dosen</th></tr></thead><tbody>';
        $tbl_close = '</tbody></table>';
        if($semester != $mk['mk_semester']){
            echo $tbl_close;
        }
        if($semester != $mk['mk_semester']){echo $tbl_open;}?>
        <tr>
            <td><?php echo $mk['mk_kode'];?></td>
            <td><?php echo $mk['mk_nama'];?></td>
            <td><?php echo $mk['mk_sks'];?></td>
            <td><?php echo $mk['mk_dosen'];?></td>
        </tr>
        <?php
        $semester = $mk['mk_semester'];
    endforeach;
    ?>
</div>
</div>
