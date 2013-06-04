
<div class="navbar navbar-inverse navbar-static-top">

    <div class="row-fluid container-fluid">
        <div class="span4">
            <h1>StackOverflow</h1>
        </div>

        <div class=" offset4 span4">
            <ul class="nav">
                <?php if (User::getActiveUser()): ?>
                    <li><img src='/image/avatar/avatar.jpg' style="width:40px;height:40px;" class="img-polaroid"/></li>
                    <li>
                        <a data-toggle="modal" href="<?php echo $_SESSION['self']->getLink("show"); ?>"><?php echo $_SESSION['self']->getNick(); ?></a>
                    </li>
                <?php else: ?>
                    <li><a href="#hover">Login</a></li>
                <?php endif; ?>

                <li><a href='#'><i class="icon-globe"></i></a></li>
                <li><a href='#'><i class="icon-bell"></i></a></li>
                <li><a href='#'><i class="icon-envelope"></i></a></li>
            </ul>
        </div>

    </div>
</div>