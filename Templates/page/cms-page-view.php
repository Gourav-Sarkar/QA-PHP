<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="row-fluid">
    <div class="offset1 span10">
        <div class='row-fluid'>
            <div class="span4" data-container="name">
                <?php echo $this->get('name'); ?>
            </div>
                
            <div class="span8">
                <?php echo $this->get('address'); ?>
            </div>
        </div>
    </div>
</div> 

<script src="jquery/jquery-min.js"></script>
<script src="Bootstrap/js/bootstrap.min.js"></script>
</body>
</html>