<div class="container-fluid">
    <div class="row-fluid span1">
        <img src="/image/avatar/default.png" class="img-rounded" />
        
        <!--Vote interface -->
        <div class="span12">
            <a href="<?php echo $this->getLink("upvote"); ?>">
                <img src="/image/icon/ui/arrow-up-64.png" />
            </a>
            <p class="text-center lead" style="margin:0px">34k</p>
            <a href="<?php echo $this->getLink("downvote"); ?>">
                <img src="/image/icon/ui/arrow-down-64.png" />
            </a>
        </div>
        
    </div>
                    
    <div class="row-fluid span11">
        <p class="lead"><?php echo $this->getContent();?></p>
        <hr>
        
        <div class="row-fluid">
        <!--Action link/button goes here -->
            <a href="<?php echo $this->getLink("edit"); ?>"><span>Edit</span></a>
            <a href="<?php echo $this->getLink("delete"); ?>">Delete</a>
        </div>
        
        <div class="span12">
            <?php
            $comments=$this->getComments();
            //var_dump($comments->count());
            echo ($comments->count())?$comments->render(new Template("comment")):"";
            ?>
        
            <br/>
            <?php require "/../comment/comment-form-view.php"; ?>
      
            <br/>
        </div>
        
    </div>
</div>