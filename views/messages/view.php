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
                <?php if ($messageList): ?>
                    <div class="messages">
                        <?php foreach ($messageList as $key => $value): ?>
                            <?php $user = User::getUserById($value['user_id']); ?>
                            <div class="message-item">
                                <div class="head">
                                    <a href="/profile/<?php echo $user['id']; ?>"
                                       class="float-left"><?php echo $user['name']; ?></a>
                                    <p class="d-flex justify-content-end"><?php echo date("d.m.y", strtotime($value['date'])); ?></p>
                                </div>
                                <div class="body">
                                    <p class="float-none"><?php echo $value['text']; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="send_message">
                        <form method="post">
                            <div class="form-group">
                                <label for="message">Сообщение:</label>
                                <textarea class="form-control" name="message" id="message" rows="3" required></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Отправить</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
