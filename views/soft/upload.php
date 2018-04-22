<!DOCTYPE html>
<html>
<head>
    <title>Upload</title>
    <?php include ROOT . '/views/matrix/link.php'; ?>
</head>
<body>
<?php include ROOT . '/views/matrix/header.php'; ?>

<div class="forum-box center">
    <?php if (!$result): ?>
        <h1 class="text-align">Загрузка программы</h1>
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
        <div class="content center">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Имя файла</label>
                    <input type="text" name="filename" class="form-control" id="name" placeholder="Enter file name" required>
                </div>
                <div class="form-group">
                    <input name="soft" type="file" class="form-control-file" aria-describedby="fileHelp" accept=".rar, .zip, .exe">
                    <small id="fileHelp" class="form-text text-muted">Пожалуйста убедитесь, что файл имеет одно из следующих расширений .rar , .zip , .exe</small>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Загрузить</button>
            </form>
        </div>
    <?php else: ?>
        <p class="text-align">Файл загружен</p>
    <?php endif; ?>
</div>

</body>
</html>
