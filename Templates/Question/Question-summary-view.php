<article class="row-fluid">
    <div class="span3">
        <div class="container-fluid">
            <ul class="thumbnails">
                <!--<li class="span4"><h3 class="text-center">13</h3></li> -->
                <li class="span4"><h3 class="text-center"><?php echo $this->getAnswerCount(); ?></h3></li>
                <li class="span4"><h3 class="text-center"><?php echo $this->getViews(); ?></h3></li>
            </ul>
         </div>
    </div>
                    
    <div class="span9">
        <div class="row-fluid container-fluid">
                <a href="<?php echo $this->getLink('show');?> ">
                <h3><?php echo $this->getTitle(); ?></h3>
                </a>
            
        </div>
        <div class="row-fluid container-fluid">
            <span><?php echo Utility::timeDiff($this->getTime()); ?>, By</span>
            <a href="#"><?php echo $this->getUser()->getNick(); ?></a>
        </div>
        <div class="row-fluid container-fluid">
           <?php echo $this->getTags()->render(new Template("tag-list")); ?>
        </div>
    </div>
</article>
<hr/>