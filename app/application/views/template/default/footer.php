<div class="span12">
    <span id="left">&copy; 2013 <a href="<?php echo $this->config->item('author_link')?>"><?php echo $this->config->item('author')?></a> | rendered in  {elapsed_time} | memory usage : {memory_usage} |</span>
    <span id="right"><a href="<?php echo $this->config->item('kampus_link')?>"><?php echo $this->config->item('app_for')?></a></span>
</div>
<script>
    $(document).ready(function(){
        var peringatan = "";
    <?php if($this->session->userdata('passNotChanged')){
        echo " peringatan += 'Password Default anda belum diubah <br/>';";
    }?>
    <?php if($this->session->userdata('userNameNotChanged')){
        echo "peringatan +='Username Default anda belum diubah <br/>';";
    }?>
    <?php if($this->session->userdata('emptyContact')){
        echo "peringatan +='No. Kontak anda belum diisi <br/>';";
    }?>
    <?php if($this->session->userdata('emptyEmail')){
        echo "peringatan +='Email anda belum diisi <br/>';";
    }?>
        if(peringatan.length > 0){
            cloudfire.notification(peringatan,{title:'account',type:'info',autoHide:true,delay:4000});
        }
    });
</script>