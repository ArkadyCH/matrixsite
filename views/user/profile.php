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
            <img class="center" src="<?php echo User::getImage($usver['id']); ?>">
        </div>
        <div class="text-align">
            <p><?php echo $usver['name']; ?></p>
            <p><?php echo $usver['email']; ?></p>
            <?php if ($permission == "admin"): ?>
                <p>Роль: Администратор</p>
            <?php endif; ?>
            <p>Тем: <?php echo $topics; ?></p>
            <p>Сообщений: <?php echo $messages; ?></p>
        </div>
        <?php if ($_SESSION['user_id'] == $usver['id']): ?>
            <div class="text-align">
                <a href="/user/edit/<?php echo $usver['id']; ?>" class="btn btn-primary">Редактировать</a>
                <?php if ($permission == "admin"): ?>
                    <a href="/admin" class="btn btn-primary">Админ панель</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="text-align">
                <a href="/message/to/<?php echo $usver['id']; ?>" class="btn btn-primary ">Отправить сообщение</a>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
