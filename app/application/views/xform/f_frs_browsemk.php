<script>
    $('table#frs_browse tbody tr').click(function(){
        var content = $(this).html();
        var append = '<tr class="ch-glow"><td><input type="checkbox" name="mkt[]" value="TRUE" checked></td>'+content+'<td><input type="text" id="frs_keterangan" name="frs_keterangan[]" class="span12"></td></tr>';
        var mk_name = $(this).find('.mk_nama').text();
        var question = 'Apakah anda ingin menambahkan mata kuliah "'+mk_name+'" ?';
        alertify.confirm(question,function(r) {
            if(r){
                $('#mk_detail').find('tbody').append(append);
                $.sinhs.close_modal();
            }else{
                return false
            };
        });
    })
</script>
<table id="frs_browse" class="table table-condensed table-striped table-hover" id="mk_detail" title="Klik untuk memilih matakuliah yang ditambahkan" style="cursor:pointer">
    <thead>
    <tr>
        <td>Kode MK</td>
        <td>Matakuliah</td>
        <td>SKS</td>
        <td>Dosen</td>
    </tr>
    </thead>
    <tbody>
    <?php if(empty($listMk)) echo '<tr><td colspan="5"><div class="alert"><button type="button" class="close backToStep1" data-dismiss="alert">&times;</button> Data tidak tersedia.</div></td></tr>';?>
    <?php foreach($listMk as $mk):?>
        <tr>
            <td>
                <span><?php echo $mk['mk_kode'] ?></span>
                <input type="hidden" name="mk_id[]" value="<?php echo $mk['mk_id'] ?>">
            </td>
            <td class="mk_nama"><?php echo $mk['mk_nama'] ?></td>
            <td>
                <span><?php echo $mk['mk_sks'] ?></span>
                <input type="hidden" name="sks[]" value="<?php echo $mk['mk_sks'] ?>">
            </td>
            <td><?php echo $mk['mk_dosen'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>