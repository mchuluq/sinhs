<?php
/**
 * sinhs.
 * elfinder lib.
 * User: mochammad c. chuluq
 * Date: 05/06/13
 * Time: 19:59
 * Chraven Systems dev. labs.
 * elfinder custom lib.
 */
require_once './assets/plugins/elfinder/php/elFinderConnector.class.php';
require_once './assets/plugins/elfinder/php/elFinder.class.php';
require_once './assets/plugins/elfinder/php/elFinderVolumeDriver.class.php';
require_once './assets/plugins/elfinder/php/elFinderVolumeLocalFileSystem.class.php';

class elfinder_lib {
    var $elfinder_path = 'assets/plugins/elfinder';
    var $path = './';
    var $url =  '';
    var $elfinder_place = '#tempatnya-elfinder';
    var $elfinder_url = 'control/explorer/elfinder';


    function init(){
        ob_start() ?>
        <!-- load elFinder -->
        <link href="<?php echo base_url($this->elfinder_path)?>/css/theme.css" rel="stylesheet">
        <link href="<?php echo base_url($this->elfinder_path)?>/css/elfinder.all.css" rel="stylesheet">
        <script src="<?php echo base_url($this->elfinder_path)?>/js/elfinder.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/jquery.elFinder.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/elFinder.command.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/elFinder.history.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/elFinder.options.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/elFinder.resources.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/elFinder.version.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/jquery.dialogelfinder.js"></script>

        <link rel="stylesheet" href="<?php echo base_url($this->elfinder_path)?>/css/common.css"      type="text/css">
        <link rel="stylesheet" href="<?php echo base_url($this->elfinder_path)?>/css/dialog.css"      type="text/css">
        <link rel="stylesheet" href="<?php echo base_url($this->elfinder_path)?>/css/toolbar.css"     type="text/css">
        <link rel="stylesheet" href="<?php echo base_url($this->elfinder_path)?>/css/navbar.css"      type="text/css">
        <link rel="stylesheet" href="<?php echo base_url($this->elfinder_path)?>/css/statusbar.css"   type="text/css">
        <link rel="stylesheet" href="<?php echo base_url($this->elfinder_path)?>/css/contextmenu.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url($this->elfinder_path)?>/css/cwd.css"         type="text/css">
        <link rel="stylesheet" href="<?php echo base_url($this->elfinder_path)?>/css/quicklook.css"   type="text/css">
        <link rel="stylesheet" href="<?php echo base_url($this->elfinder_path)?>/css/commands.css"    type="text/css">

        <link rel="stylesheet" href="<?php echo base_url($this->elfinder_path)?>/css/fonts.css"       type="text/css">
        <link rel="stylesheet" href="<?php echo base_url($this->elfinder_path)?>/css/theme.css"       type="text/css">

        <!-- elfinder core -->
        <script src="<?php echo base_url($this->elfinder_path)?>/js/elFinder.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/elFinder.version.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/jquery.elfinder.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/elFinder.resources.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/elFinder.options.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/elFinder.history.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/elFinder.command.js"></script>

        <!-- elfinder ui -->
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/overlay.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/workzone.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/navbar.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/dialog.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/tree.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/cwd.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/toolbar.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/button.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/uploadButton.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/viewbutton.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/searchbutton.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/sortbutton.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/panel.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/contextmenu.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/path.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/stat.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/ui/places.js"></script>

        <!-- elfinder commands -->
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/back.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/forward.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/reload.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/up.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/home.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/copy.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/cut.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/paste.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/open.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/rm.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/info.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/duplicate.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/rename.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/help.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/getfile.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/mkdir.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/mkfile.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/upload.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/download.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/edit.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/quicklook.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/quicklook.plugins.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/extract.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/archive.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/search.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/view.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/resize.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/sort.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/commands/netmount.js"></script>

        <!-- elfinder languages -->
        <script src="<?php echo base_url($this->elfinder_path)?>/js/i18n/elfinder.en.js"></script>
        <script src="<?php echo base_url($this->elfinder_path)?>/js/i18n/elfinder.id.js"></script>

        <!-- elfinder dialog -->
        <script src="<?php echo base_url($this->elfinder_path)?>/js/jquery.dialogelfinder.js"></script>

        <!-- elfinder 1.x connector API support -->
        <script src="<?php echo base_url($this->elfinder_path)?>/js/proxy/elFinderSupportVer1.js"></script>

        <!-- elfinder custom extenstions -->
        <script src="<?php echo base_url($this->elfinder_path)?>/extensions/jplayer/elfinder.quicklook.jplayer.js"></script>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('<?php echo $this->elfinder_place?>').elfinder({
                    url: '<?php echo site_url($this->elfinder_url); ?>'
                }).elfinder('instance');
            });
        </script>

        <?php $r = ob_get_contents();
        ob_end_clean();
        return $r;
    }

    function connect($path=null,$url=null){
        $file_path = (empty($path)) ? $this->path : $path;
        $url_path = (empty($url)) ? $this->url : $url;
        $conn = new elFinderConnector(new elFinder(array(
            'roots'=>array(
                array(
                    'driver'=>'LocalFileSystem',
                    'path'=>$file_path,
                    'URL'=>base_url($url_path).'/',
                )
            )
        )));
        $conn->run();
    }
}