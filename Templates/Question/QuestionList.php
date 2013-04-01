    <!DOCTYPE html>
    <html>
    <head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <header class="row-fluid">
            <?php require 'Templates/header-view.php'; ?>
        </header>
        
        <section class="row-fluid">
            <div class="span8">
                <div class="row-fluid">
                    <div class="container-fluid">
                        <?php require_once 'question-form-view.html'; ?>
                    </div>
                    
                </div>
                
                
                <!--Question list template -->
                <?php 
                    //$ans=$this->getSelectedAnswer();
                    //var_dump($this);
                    try{
                         $ques= new Question();
                         
                         $pager= new Pagination($ques);
                         $pager->setPage($_GET['page']);
                         
                         
                         if(isset($_GET['tags']))
                            {
                                $ques->setTags(implode(',',$_GET['tags']));
                        
                            }
                        }
                        catch (Exception $e)
                         {
                            //Ignore exception
                         }
                    $questions=Question::listing($ques);
                    echo ($questions->count())?$questions->render(new Template("Templates/Question-summary-view.php")):'No questions ahs been asked yet';
                    
                    
                    
                   ?>
                <div class="row-fluid">
                    <?php echo $pager->render(new Template("/templates/pager-view.php")); ?>
                </div>
            </div>
            <div class="span4">
                <div id="widgets" class="container-fluid">
                    <h1>Tags <?php echo $pager->gettotalPage(); ?></h1>
                </div>
            </div>
        </section>
        
        <footer class="row-fluid">
            
        </footer>
    <script src="/Bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>