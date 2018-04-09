<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT.'/views/matrix/link.php';?>
</head>
<body>
<?php include ROOT.'/views/matrix/header.php';?>

<div class="forum-box center">
    <?php foreach($topic as $key => $value):?>
        <p><?php echo $value['data'];?></p>
        <h1 class="text-align"><?php echo $value['title_name'];?></h1>
        <div class="user_topic">
            <div class="user_img">
                <img src="/templates/images/avatars/1.jpg">
            </div>
            <div class="information">
                <p><?php echo $user['name'];?></p>
                <p>Тем: <?php echo $countTopics;?></p>
                <p>Сообщений:</p>
            </div>
        </div>
        <div class="topic_description">
            <?php echo $value['description'];?>
        </div>
    <?php endforeach; ?>
</div>

<?php foreach($messages as $key => $value): ?>
<div class="forum-box center">
    <div class="user float-left">
        <?php $user_message = Forum::getUserById($value['user_id']);?>
        <?php $countMessage = Forum::getCountUserMessages($user_message['id']);?>
        <div class="user_img_message float-left">
            <img src="/templates/images/avatars/1.jpg">
        </div>
        <div class="information float-left">
            <p><?php echo $user_message['name'];?></p>
            <p>Тем: <?php echo $countTopics;?></p>
            <p>Сообщений: <?php echo $countMessage;?></p>
        </div>
    </div>
    <div class="message">
        <?php echo $value['message']?>
    </div>
</div>
<?php endforeach; ?>

<div class="forum-box center">
    <form method="post">
        <div class="form-group">
            <label for="message">Сообщение:</label>
            <textarea class="form-control" name="message" id="message" rows="3"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>

</body>
</html>
