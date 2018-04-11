<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT . '/views/matrix/link.php'; ?>
</head>
<body>
<?php include ROOT . '/views/matrix/header.php'; ?>

<div class="forum-box center">
    <div>
        <div class="user_img">
            <img class="center" src="<?php echo User::getImage($user['id']);?>">
        </div>
        <div class="text-align">
            <p><?php echo $user['name']; ?></p>
            <p><?php echo $user['email']; ?></p>
        </div>
        <div class="text-align">
            <a href="/user/edit/<?php echo $user['id'];?>" class="btn btn-primary">Редактировать</a>
            <?php if ($permission == "admin"): ?>
                <a href="" class="btn btn-primary">Админ панель</a>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
