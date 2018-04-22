<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT . '/views/matrix/link.php'; ?>
</head>
<body>
<?php include ROOT . '/views/matrix/header.php'; ?>

<div class="forum-box center">
    <h1 class="text-align">Удаление пользователей</h1>
    <div class="errors text-align">
        <?php if(isset($errors) && is_array($errors)):?>
            <ul>
                <?php foreach($errors as $error):?>
                    <li>
                        <?php echo $error ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <form method="post">
        <div class="form-group">
            <label for="nameUser">Введите логин пользователя</label>
            <input type="text" name="user_name" class="form-control" id="nameUser" placeholder="Введите логин" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Удалить</button>
    </form>
</div>

</body>
</html>
