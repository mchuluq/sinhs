<article class="ch-article span6">
    <header><i class="icon-user"></i><?php echo $title?></header>
    <div class="ch-article-content alertKhs">
        <?php
        $query = $this->db->query("SELECT * FROM view_khs_detail WHERE frs_status = '1' AND frs_nilai_angka <= 79 AND user_id = '".$this->session->userdata('user_id')."' ORDER BY frs_nilai_angka ASC");
        $mks = $query->result_array();
        if(empty($mks)){ ?>
            <div class="alert alert-block">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Tidak ada peringatan
            </div>
        <?php }
        foreach($mks as $mk):?>
        <div class="alert <?php if($mk['frs_nilai_angka'] <= 69) { echo 'alert-warning';}elseif($mk['frs_nilai_angka'] >= 70 AND $mk['frs_nilai_angka'] <= 79){ echo 'alert-info';}?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php if($mk['frs_nilai_angka'] <= 69) { echo 'wajib diulang !';}?></strong>
            <?php echo $mk['mk_nama'] ."<strong> ( ".$mk['frs_nilai_huruf']." ) </strong>"?>
        </div>
        <?php endforeach; ?>
    </div>
</article>