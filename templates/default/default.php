<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <title><?php echo IHS_APP_NAME ?> | <?php echo IHS_PAGE_NAME ?></title>
    
    <link rel="shortcut icon" href="<?php echo IHS_SITE_URL ?>templates/default/assets/img/logo.png"/>
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/assets/css/fonts.css"/>
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/fontawesome-free/css/all.min.css"/>
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/dashicons/css/dashicons.min.css"/>
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/elementor-icons/css/elementor-icons.min.css"/>
    
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"/>
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/assets/css/adminlte.min.css"/>
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"/>
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/toastr/toastr.min.css"/>
    
    
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"/> 
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"/> 
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css"/> 
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/icheck-bootstrap/icheck-bootstrap.min.css"/> 
    
    <!--link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"/-->
    
    
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/lib/codemirror.css"/>
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/addon/display/fullscreen.css" />
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/theme/<?php echo IHS_CODEMIRROR_THEME ?>.css"/>
    
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/plugins/jstree/themes/default/style.min.css"/>
    
    <link rel="stylesheet" href="<?php echo IHS_SITE_URL ?>templates/default/assets/css/main.css"/>
    
    
    
    
    <script type="text/javascript">
    <!--
    var IHS_CODEMIRROR_THEME = "<?php echo IHS_CODEMIRROR_THEME ?>";	
    -->
    </script>
    
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
      
    
     <?php echo IHS_LAYOUT_MAIN_HEADER ?> 
     <?php echo IHS_LAYOUT_MAIN_SIDEBAR ?>
    
  
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="text-dark"><?php echo IHS_PAGE_NAME ?><small><?php echo IHS_PAGE_DESC ?></small></h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <?php echo IHS_LAYOUT_BREADCRUMB ?>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
      
        
        <section class="content">
            <div class="container-fluid">
                <!-- page -->
                <?php echo IHS_LAYOUT_CONTENT ?>
                <!-- ./page -->
            </div>
        </section>
      
     </div> <!-- ./content-wrapper -->
     
     
     
     
      
     <footer class="main-footer text-sm">
       <strong>Copyright &copy; <?php echo date("Y") ?> <a href="http://ihsana.com">Ihsana Global Solusindo</a>.</strong> All rights reserved.
       <div class="float-right d-none d-sm-inline-block"><b>Version</b> <?php echo IHS_INTERFACE_VERSION ?> (Loading: <?php echo $_SESSION['TOTAL_TIME'] ?> second)</div>
       
     </footer>
      
    </div>


    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/jquery-ui/jquery-ui.min.js"></script>
    
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/sweetalert2/sweetalert2.min.js"></script>
    
    
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/assets/js/adminlte.min.js"></script>
    
    <!-- codemirror -->
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/lib/codemirror.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/addon/edit/continuelist.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/mode/xml/xml.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/mode/javascript/javascript.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/mode/markdown/markdown.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/mode/php/php.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/mode/css/css.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/mode/clike/clike.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/codemirror/addon/edit/matchbrackets.js"></script>

    
    <!-- datatables -->
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
    
    
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/jstree/jstree.min.js"></script>
    <script src="<?php echo IHS_SITE_URL ?>templates/default/plugins/edit_area/edit_area_full.js"></script>
  
    
    <script src="<?php echo IHS_SITE_URL ?>templates/default/assets/js/main.js"></script>
    
 

    <?php if(IHS_DEMO == true){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
	   var tags = '<section class="content" style="padding-bottom: 0;border: 3px dashed red;margin: 14px !important;"><div class="alert alert-default" style="margin:0;padding: 6px;"><label class="badge badge-danger">DEMO</label> : Click the <strong>Activate</strong> button to see the available features and click the <strong>See the result</strong> button to see the code used. This tool is readonly, you <strong>cannot save forms</strong> or the Save Changes button has been disabled.</div></section>';
	   $(".content-header").after(tags);
	});
    </script>
    <?php } ?>
    
    <script type="text/javascript"> 
        <?php echo IHS_PAGE_JS ?>  
    	<?php echo IHS_LAYOUT_ALERT ?>
    </script>

</body>
</html>