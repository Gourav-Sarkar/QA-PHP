    <!DOCTYPE html>
    <html>
    <head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <header>
            <?php require_once 'templates/header-view.php'; ?>
        </header>
        <div class="row-fluid container-fluid">
            <div class="row-fluid">
                <div class="offset1 span10">
                    <div class="span8">
                    <!-- USer profile -->
                        <div class="span6">
                            <!-- user avatar -->
                            
                        </div>
                        <div class="span6">
                            <!-- short profile data -->
                            <div><?php echo $this->getNick(); ?></div>
                        </div>
                    </div>
                
                    <div class="span4">
                    <!-- User Details -->
                    </div>
                </div>
            </div>
            
            <div class="row-fluid">
                <!-- User statsitic, achievement,behaviour -->
                
            </div>
        </div>
    <script src="/jquery/jquery-min.js" type="text/javascript"></script>
    <script src="/Bootstrap/js/bootstrap.js" type="text/javascript"></script>
    </body>
    </html>