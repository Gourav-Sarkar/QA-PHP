<!DOCTYPE html>
<html>
    <head>
        <title>Bootstrap 101 Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/Bootstrap/css/bootstrapSwitch.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <header class="row-fluid">
            <?php require 'Templates/header-view.php'; ?>
        </header>

        <section class="row-fluid">
            <div class="span8">
                <div class="stream" data-stream="question">
                    <!--Question list template -->
                    <?php
                    //$ans=$this->getSelectedAnswer();
                    //var_dump($this);
                    
                    echo ($questions->count()) ? $questions->render(new Template("Question-summary")) : 'No questions ahs been asked yet';
                    ?>
                </div>

                <div class="row-fluid">
                    <?php echo $pager->render(new Template("pager")); ?>
                </div>
            </div>
            <div class="span4">
                <div id="widgets" class="container-fluid">
                    <h1>Tags <?php echo $pager->gettotalPage(); ?></h1>
                </div>
            </div>
        </section>

        <?php require_once 'templates/footer-view.php'; ?>
    </body>
</html>