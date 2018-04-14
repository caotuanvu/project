<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $this->_metaHttp; ?>
    <?php echo $this->_metaName; ?>
    <?php echo $this->_fileJs; ?>
    <title><?php echo $this->title; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <?php echo $this->_fileCss; ?>

</head>
<body>
<div class="container-fluid">

<?php
  require $pathHeader    = MODULE_BLOCK . 'header.php';
  require $pathNavbar   = MODULE_BLOCK . 'navbar.php';


 ?>

   <div class="container-fluid">
        <!-- OPEN CONTENT REGISTER -->   
        <div class="content">
            <div class="row" id="my-row">
               <div class="col-md-8">
                    <?php
                        require  MODULE_ROOT. $this->_module. DS .'views'. DS. $this->_fileContent.'.php';
                    ?>
               </div>

                    <div class="col-md-4 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="head-panel">
                                <?php  require $pathListCatery = MODULE_BLOCK . 'mycart.php';?>
                            </div>
                            <div class="panel-body">
                                <?php  require $pathListCatery = MODULE_BLOCK . 'listCategory.php';?>
                                <div class="row" id="promiss-special">
                                    <?php  require $pathListCatery = MODULE_BLOCK . 'promiss.php';?>
                                    <?php  require $pathListCatery = MODULE_BLOCK . 'special.php';?>
                                </div>

                            </div>
                         </div>
                    </div>
                 </div>
        </div>
        <!-- THE END CONTENT REGISTER -->
    </div>

    <div class="footer">

        <div class="copyright">Copyright © 2018, Tuấn Vũ Store</div>
    </div>
</div>
</body>

</html>
