<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT . '/views/matrix/link.php'; ?>
</head>
<body>
<?php include ROOT . '/views/matrix/header.php'; ?>

<div class="forum-box center">
    <h1 class="text-align">Изменение данных о пользователе</h1>
    <div class="content center">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="MAX_FILE_SIZE" value="3145728" />
                <div class="user_img">
                    <img class="center" src="<?php echo User::getImage($user['id']);?>">
                </div>
                <input name="userfile" type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" accept=".jpg, .jpeg, .png">
                <small id="fileHelp" class="form-text text-muted">Не больше 3МБ, желательно 150x150.</small>
            </div>
            <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $user['name']?>" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?php echo $user['email']?>" placeholder="E-mail">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Изменить</button>
        </form>
    </div>
</div>

</body>
</html>
