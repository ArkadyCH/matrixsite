<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT . '/views/matrix/link.php'; ?>
</head>
<body>
<?php include ROOT . '/views/matrix/header.php'; ?>

<div class="forum-box center">
    <?php if (User::checkUserSession()): ?>
            <form method="post">
                <div class="form-group">
                    <label for="message">Сообщение:</label>
                    <textarea class="form-control" name="text" id="message" rows="3" required></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Отправить</button>
            </form>
    <?php endif; ?>
</div>

</body>
</html>
