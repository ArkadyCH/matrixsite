<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT . '/views/matrix/link.php';?>
    <meta charset="Utf-8">
</head>
<body>
<?php include ROOT . '/views/matrix/header.php';?>
<?php if(isset($result)):?>
    <p class="center">Вы успешно зарегистрировались</p>
<?php else: ?>
    <div class="errors">
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

    <div class="content center">
        <h1 class="text-align">Регистрация</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="MAX_FILE_SIZE" value="3145728" />
                <div class="user_img">
                    <img class="center" src="/upload/images/user/noimage.jpg">
                </div>
                <input name="userfile" type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" accept=".jpg, .jpeg, .png">
                <small id="fileHelp" class="form-text text-muted">Не больше 3МБ, желательно 150x150.</small>
            </div>
            <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $params['name']?>" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?php echo $params['email']?>" placeholder="E-mail">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
    </div>
<?php endif;?>

</body>
</html>
