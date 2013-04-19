<!-- Used to create and edit Roles -->
<form action="<?php echo $this->getLink("create");?>" method="post">
    <div>Role</div><input type="text" name="roleName" />
    <div>Role</div><textarea name="roleDescription"></textarea>
    <div>Role</div><input type="submit" name="create" />
</form>
