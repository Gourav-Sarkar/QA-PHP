<div class="row-fluid">
    
    
    <div class="span11">
        <p>
            <?php echo $this->getContent();?>
            -
            <span><?php echo Utility::timeDiff($this->getTime()); ?></span>
            <span class="btn-group">
                <a href="<?php echo $this->getLink("edit"); ?>">
                    <i class='icon-edit'></i>
                </a>
                <a href="<?php echo $this->getLink("delete"); ?>">
                    <i class='icon-remove'></i>
                </a>
                <a href="<?php echo $this->getLink("flag"); ?>">
                    <i class='icon-flag'></i>
                </a>
                <b><?php //echo $this->getLink("delete"); ?></b>
            </span>
        </p>
        
    </div>
    
</div>