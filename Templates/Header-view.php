<div class="row-fluid container-fluid">
      <div class="span4">
          <h1>StackOverflow Clone</h1>
      </div>
           
    <div class="span4 navbar">
        <ul class="nav">
            <?php if($_SESSION['self'] instanceof AbstractUSer):?>
            <li><a data-toggle="modal" href="<?php echo $_SESSION['self']->getLink("show"); ?>"><?php echo $_SESSION['self']->getNick(); ?></a></li>
            <?php else: ?>
            <li><a data-toggle="modal" href="#myModal">login</a></li>
            <?php endif; ?>
            
            <li><a href="#">tags</a></li>
            <li><a href="#">admin panel</a></li>
            <li><a href="#">help</a></li>
        </ul>
    </div>
    
    <div class="span4">
        <form class="form-search">
             <span>Search</span>
             <input type="text" name="query" />
             <input type="submit" name="search" value="search" class="btn" />
         </form>
    </div>
    
    <?php require_once 'user-login-form-view.php'; ?>
</div>