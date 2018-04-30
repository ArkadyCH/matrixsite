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

                    <?php foreach ($dialogs as $key => $value): ?>
                        <?php if ($value['send'] != $_SESSION['user_id'] || $value['recive'] != $_SESSION['user_id']): ?>
                            <div class="user-item">
                                <a href="/dialog/<?php if($value['send'] != $_SESSION['user_id']) echo $value['send']; else echo $value['recive']; ?>"
                                   class="btn btn-primary">
                                    <?php
                                    if($value['send'] != $_SESSION['user_id'])
                                        echo User::getUserNameById($value['send']);
                                    else
                                        echo User::getUserNameById($value['recive']);
                                    ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

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
