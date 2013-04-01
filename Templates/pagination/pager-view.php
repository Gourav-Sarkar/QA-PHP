<div class="pagination pagination-large">
    <ul>
        <?php if($this->prevPage()): ?>
        <li><a href="<?php echo $this->getLink("getList") . "&amp;page=" . $this->prevPage(); ?>" >Prev</a></li>
        <?php endif; ?>
        
        <?php for($i=1;$i<=$this->getTotalPage();$i++): ?>
        <li><a href="<?php echo $this->getLink("getList") . "&amp;page=$i"; ?>" ><?php echo $i; ?></a></li>
        <?php endfor; ?>
        
        <?php if($this->nextPage()): ?>
        <li><a href="<?php echo $this->getLink("getList") . "&amp;page=" . $this->nextPage(); ?>" >Next</a></li>
        <?php endif; ?>
    </ul>
</div>