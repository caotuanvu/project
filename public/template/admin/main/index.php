<!DOCTYPE html>
<html>
<head>

    <?php echo $this->_metaHttp; ?>
    <?php echo $this->_metaName; ?>
    <title><?php echo $this->title; ?></title>
    <?php echo $this->_fileJs; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <?php echo $this->_fileCss; ?>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
    <?php include_once 'html/header.php';?>
     <div class="content">
        <?php
        require_once MODULE_ROOT. $this->_module. DS .'views'. DS. $this->_fileContent.'.php';
        ?>
    </div>
    <?php include_once 'html/footer.php';?>
</div>
</body>

</html>
