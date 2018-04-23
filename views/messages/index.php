<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT . '/views/matrix/link.php'; ?>
</head>
<body>
<?php include ROOT . '/views/matrix/header.php'; ?>

<div class="forum-box center">
    <div class="conteiner">
        <div class="panel list-user">
            <div class="panel-heading">
                <p>Пользователи</p>
            </div>
            <div class="panel-body">
                <?php if ($dialogs): ?>
                    <?php foreach ($dialogs as $key => $value): ?>
                        <div class="user-item">
                            <a href="/dialog/<?php echo $value['send']; ?>"
                               class="btn btn-primary"><?php echo User::getUserNameById($value['send']); ?></a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="panel panel-chat">
            <div class="panel-heading">
                <p>Сообщения</p>
            </div>
            <div class="panel-body">
            </div>
        </div>
    </div>
</div>

</body>
</html>
