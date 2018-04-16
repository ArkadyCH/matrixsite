<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT . '/views/matrix/link.php'; ?>
</head>
<body>
<?php include ROOT . '/views/matrix/header.php'; ?>

<div class="forum-box center">
    <?php foreach ($topic as $key => $value): ?>
        <p><?php echo $value['data']; ?></p>
        <h1 class="text-align"><?php echo $value['title_name']; ?></h1>
        <div class="user_topic">
            <div class="user_img">
                <img class="center" src="<?php echo User::getImage($value['user_id']); ?>">
            </div>
            <div class="information">
                <p><?php echo User::getUserNameById($value['user_id']); ?></p>
                <p>Тем: <?php echo Forum::getCountTopicByUserId($value['user_id']); ?></p>
                <p>Сообщений: <?php echo Forum::getCountUserMessages($value['user_id']); ?></p>
            </div>
        </div>
        <div class="topic_description">
            <?php echo $value['description']; ?>
        </div>
    <?php endforeach; ?>
</div>

<?php if ($messages): ?>
    <?php foreach ($messages as $key => $value): ?>
        <div class="forum-box center">
            <div class="user float-left">
                <?php $user_message = User::getUserById($value['user_id']); ?>
                <div class="user_img_message float-left">
                    <img class="center" src="<?php echo User::getImage($value['user_id']); ?>">
                </div>
                <div class="information float-left">
                    <p><?php echo $user_message['name']; ?></p>
                    <p>Тем: <?php echo Forum::getCountTopicByUserId($value['user_id']); ?></p>
                    <p>Сообщений: <?php echo Forum::getCountUserMessages($user_message['id']); ?></p>
                </div>
            </div>
            <div class="message">
                <?php echo $value['message'] ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (User::checkUserSession()): ?>
    <div class="forum-box center">
        <form method="post">
            <div class="form-group">
                <label for="message">Сообщение:</label>
                <textarea class="form-control" name="message" id="message" rows="3" required></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
<?php endif; ?>

</body>
</html>
