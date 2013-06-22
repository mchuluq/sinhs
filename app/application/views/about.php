<!DOCTYPE html>
<html>
<head>
    <?php echo $_embed;?>
    <script>
         $(document).ready(function(){
            $('#grup_tab a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            })
        })
        $(function () {
            $('#grup_tab a:first').tab('show');
        });
    </script>

</head>
<body>
<?php echo $_header;?>

<div class="container-fluid">
    <div class="row-fluid" id="header-area">
        <?php echo $_head_area;?>
    </div>
    <div class="row-fluid" id="content-area">
        <section class="span9" id="ch-main-content">
            <div class="row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <article class="ch-article span12">
                            <header><i class="icon-info-sign"></i>About</header>
                            <div class="ch-article-content">
                                <ul class="nav nav-tabs" id="grup_tab">
                                    <li><a href="#about" data-toggle="tab">About</a></li>
                                    <li><a href="#credits" data-toggle="tab">Credits</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="about">
                                        <div id="abouth">
                                            <img src="<?php echo base_url('assets/pictures/uyp.ico')?>"/>
                                            <h5><?php echo $this->config->item('app_name')?><small><?php echo $this->config->item('app_desc')?></small></h5>
                                            <p class="smaller">version <?php echo $this->config->item('app_version')?></p>
                                        </div>
                                        <div class="desc">
                                            <p>SINHS merupakan sebuah aplikasi yang dibangun dalam rangka memenuhi tugas penelitian skripsi bagi author, untuk mengelolah data studi mahasiswa , utamanya dalam hal nilai hasil studi mahasiswa untuk Fakultas Teknik Universitas Yudharta Pasuruan.</p>
                                            <p>Aplikasi ini di bangun dengan menggunakan bahasa scripting PHP dan Framework CodeIgniter dengan sistem basis data MySQL. </p>
                                        </div>
                                        <p class="smaller"><?php echo $this->config->item('app_name')?></p>
                                        <p class="smaller">&copy; 2013 <?php echo $this->config->item('author')?> :: <?php echo $this->config->item('company')?></p>

                                    </div>
                                    <div class="tab-pane" id="credits">
                                        <ul>
                                            <li>
                                                <h3>CodeIgniter v2.1.3</h3>
                                                <p>CodeIgniter is an Application Development Framework - a toolkit - for people who build web sites using PHP.</p>
                                            </li>
                                            <li>
                                                <h3>Bootstrap v2.3.1</h3>
                                                <p>Sleek, intuitive, and powerful front-end framework for faster and easier web development.</p>
                                            </li>
                                            <li><h3>jQuery v2.0</h3></li>
                                            <li><h3>jQuery-UI v1.10.2</h3></li>
                                            <li><h3>Highcharts</h3></li>
                                            <li><h3>elFinder</h3></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <aside class="span3" id="ch-sidebar">
            <?php echo $_sidebar;?>
        </aside>
    </div>
    <div class="row-fluid" id="footer-area">
        <?php echo $_footer; ?>
    </div>
</div>

</body>
</html>