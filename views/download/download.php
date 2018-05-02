<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT . '/views/matrix/link.php'; ?>
</head>
<body>
<?php include ROOT . '/views/matrix/header.php'; ?>

<div class="content center">
    <h1 class="text-align">Загрузить программу прямо сейчас</h1>
    <?php if (User::checkUserSession()): ?>
        <?php if($file):?>
            <a class="btn btn-primary col-centered" href="/download/soft/<?php echo $file['filename']; ?>"><i
                        class="fa fa-download"></i></a>
        <?php else:?>
            <p class="text-align">В данный момент софт на скачивание не найден</p>
        <?php endif;?>
    <?php else: ?>
        <p class="text-align">Вы должны авторизироваться для того, чтобы скачивать файлы с данного сайта</p>
    <?php endif; ?>
</div>

</body>
</html>