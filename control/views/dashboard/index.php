<meta http-equiv="refresh" content="25" />

<?php
//require_once("includes/head.php");
?>
<div class="panel callout">
	<h4 style="display:inline">Dashboard</h4>
</div>

<div class="row">
    <?php
    if(Session::getRole()){
        if(true){
            $modules = $_SESSION['emp_role_module'];
            foreach($modules as $module){
                $thisModule = Modules::find_by_module($module);
                echo"<div class='large-3  columns'><a href='". $uri->link($module.'/'.$thisModule->link) ."'><div class='".$thisModule->css_class."'>
             $thisModule->description</div></a>
            </div>";
            }
        }else{
            $this->view->render("access/restricted");
        }
    }
    ?>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        setInterval(window.location.reload(),50000)
    })

</script>
