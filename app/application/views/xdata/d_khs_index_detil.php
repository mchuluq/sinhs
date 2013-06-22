<script>
    function loadCurrentData(){
        var current_url = "<?php echo base_url($this->uri->uri_string())?>";
        $.ajax({
            url: current_url,
            success:function(data){
                $('#khs_data').html(data);
            }
        });
    }
    function v_grup(){
        $.ajax({
            url: "<?=base_url('khs/index/grup/0')?>",
            success:function(data){
                $('#khs_data').html(data);
            }
        });
    }
    $(document).ready(function(){
        $('a.backToGroup').click(function(){
            v_grup();
        })
    })
</script>
<table id="khs_detail"class="table table-striped table-hover table-condensed ch-table">
    <thead>
    <tr>
        <th>Kode MK</th>
        <th>Matakuliah</th>
        <th>SKS</th>
        <th>Nilai</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(empty($khs_detail)) { echo"<tr><td colspan=\"4\"><div class=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button> Data Tidak Ada.</div></td></tr>";};
    foreach($khs_detail as $khs): ?>
        <tr id="<?php echo $khs['frs_id'];?>">
            <td><?php echo $khs['mk_kode'];?></td>
            <td><?php echo $khs['mk_nama'];?></td>
            <td><?php echo $khs['mk_sks'];?></td>
            <td><?php echo $khs['frs_nilai_huruf'];?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<div class="row-fluid">
    <div class="span12" style="text-align:center;">

    </div>
</div>
<div class="row-fluid">
    <div class="span10">

    </div>
    <div class="span2">
        <a class="btn btn-primary backToGroup">Kembali</a>
    </div>
</div>