<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script src="<?php echo base_url('assets/plugins/highcharts/highcharts.js')?>"></script>
</head>
<body>
<?php echo $_header;?>
<div class="container-fluid">
    <div class="row-fluid" id="header-area">
        <?php echo $_head_area;?>
    </div>
    <div class="row-fluid" id="content-area">
        <section class="span9" id="ch-main-content">
            <?php $row_fluid = 0 ; $max_widgets = sizeof($widgets) - 1;
            foreach($widgets as $wid):
                if($row_fluid % 2 == 0){echo '<div class="row-fluid">';}
                $data['title'] = $wid['w_title'];
                $this->load->view('widgets/'.$wid['w_name'],$data);
                if($row_fluid % 2 != 0 or $row_fluid == $max_widgets){echo '</div>';};
                $row_fluid++ ;
            endforeach;
            ?>
        </section>
        <aside class="span3" id="ch-sidebar">
            <?php echo $_sidebar;?>
        </aside>
    </div>
    <div class="row-fluid" id="footer-area">
        <?php echo $_footer; ?>
    </div>
</div>
<?php echo $_bscript;?>
</body>
</html>