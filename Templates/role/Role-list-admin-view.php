<div class="accordion-group">
    <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="<?php echo $this->getTitle(); ?>">
            <?php echo $this->getTitle(); ?>
        </a>
        <span><?php echo $this->getContent(); ?></span>
    </div>
    <div id="<?php echo $this->getTitle(); ?>" class="accordion-body collapse in">
        
        <div class="accordion-inner">
            <!-- permission list for each module -->
            <!-- List of sub Modules -->
            <ul class="nav nav-pills">
            <li><a href="#home" data-toggle="tab">Home</a></li>
            <li><a href="#profile" data-toggle="tab">Profile</a></li>
            <li><a href="#messages" data-toggle="tab">Messages</a></li>
            <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="question">profile</div>
            </div>
        </div>
    
    </div>
</div>