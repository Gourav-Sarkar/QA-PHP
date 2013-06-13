    <?php
    /*
        $ques = new Question();
        $ques->setConnection(DatabaseHandle::getConnection());
        $data= $ques->get(1);
        
        $QuestionTemplate = new Template("template-question",$data);
      */ 
    ?>

    <!DOCTYPE html>
    <html>
    <head>
    <title>
        <?php echo $this->getTitle(); ?> -StackOverflow
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
    
        <header claas="row-fluid">
           <?php require 'Templates/header-view.php'; ?>
        </header>
        
        <section class="row-fluid">
            
            <div class="row-fluid container-fluid">
            <!-- Question Template  -->
                <h1 class="span10 page-header">
                    <?php echo $this->getTitle() ?>
                </h1>
            </div>
            
            <div class="row-fluid">
                
                <div id="question" class="span6 container-fluid">
                    <div class="span1">
                        <p>
                            <?php
                            echo $this->getUser()->render(new Template("User-short")); 
                            ?>
                        </p>
                        
                        <!--Vote interface -->
                        <div>
                            <a class="btn" href="<?php echo $this->getLink("upvote"); ?>">
                                up vote
                            </a>
                             <p class="text-center lead" style="margin:0px"><?php echo $this->getVotes(); ?></p>
                             <a class="btn" href="<?php echo $this->getLink("downvote"); ?>">
                                 down vote
                             </a>
                             
                        </div>
                        
                    </div>
                    
                    <div class="span11">
                        <p data-name="content" class="lead">
                            <?php echo $this->getContent(); ?>
                        </p>
                        
                        <div class="row-fluid">
                            <div class="span7">
                                <div class="container-fluid">
                                    <!-- get tag template -->
                                    <?php echo $this->getTags()->count(); ?>
                                    <?php echo $this->getTags()->render(new Template("tag-list")); ?>
                                </div>
                            </div>
                            <div class="span4">
                                - <?php echo Utility::timeDiff($this->getTime()); ?>
                            </div>
                        </div>
                    
                        <div class="row-fluid">
                        <!-- Revision data -->
                            <?php if($this->getRevisions()->count()):?>
                            <a href="<?php echo $this->getLink("getRevision"); ?>">Show rev</a>
                            <?php else: echo '&nbsp;'; ?>
                            <?php endif; ?>
                       
                        </div>
                    
                        <div class="row-fluid">
                        <!--Action link/button goes here -->
                            <div class="broup">
                                <a href="<?php echo $this->getLink("close"); ?>">Close</a>
                                <a href="<?php echo $this->getLink("edit"); ?>">Edit</a>
                                <a href="<?php echo $this->getLink("delete"); ?>">Delete</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Comment section of Question -->
                    <div class="row-fluid offset1 span11">
                       <!--comment template goes here -->
                       <?php 
                        //Conugated object
                        $coms=$this->getComments();
                        //var_dump($coms->count());
                        echo (is_object($coms))?$coms->render(new Template("comment")):'no Comments';
                        ?>
                        
                        <?php require "/../comment/comment-form-view.php"; ?>
                    </div>
                    
                </div>
                
                
                <!-- <h2>Best Answer</h2> -->
                <?php 
                    //Conugated object
                    $ans=$this->getSelectedAnswer();
                    //var_dump($ans);
                    echo (is_object($ans))?$ans->render(new Template("Best-Answer")):'';
                ?>
                
            </div>
         
          
            <div class="row-fluid">
                
                <div class="offset2 span7">
                    <hr/>
                        
                         
                        <div class="pagination pagination-medium">
                            <ul>
                                <li><a href="#">Prev</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">Next</a></li>
                            </ul>
                        </div>
                        
                        <?php require '/../Answer/Answer-form-view.html'; ?>
                        
                        <?php 
                        //Conugated object
                        $ans=$this->getAnswers();
                        echo (is_object($ans))?$ans->render(new Template("Answer")):$this->getMessage();
                        ?>
                     
                </div>
                
            </div>
            
        </section>
        
        
        <?php require_once 'templates/footer-view.php'; ?>
	<!-- -->
    </body>
    </html>