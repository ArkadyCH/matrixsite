<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT . '/views/matrix/link.php';?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/lang/summernote-ru-RU.js"></script>
    <script>
        $(document).ready(function() {
            $('#edit').summernote({
                lang: 'ru-RU'
            });
        });
    </script>
</head>
<body>
<?php include ROOT . '/views/matrix/header.php';?>

<div class="forum-box center">
    <form method="post">
        <div class="form-group">
            <label for="title_topic">Название</label>
            <input type="text" name="title_name" class="form-control" id="title_topic" placeholder="Введите название" required>
        </div>
        <div class="form-group">
            <label for="edit">Описание:</label>
            <textarea class="form-control" name="edit" id="edit" rows="3" required></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary" onclick="getCode()">Создать</button>
    </form>
</div>

</body>
</html>
