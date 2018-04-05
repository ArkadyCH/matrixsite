<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT.'/views/matrix/link.php';?>
</head>
<body>
<?php include ROOT.'/views/matrix/header.php';?>

<div class="forum-box center">
    <form method="post">
        <div class="form-group">
            <label for="selectCategory">Выберите Родителя</label>
            <select class="form-control" name="parent_id" id="selectCategory" required>
                <option value="0">Новый раздел</option>
                <?php foreach($title_name as $key => $value): ?>
                    <option value="<?php echo $value[1];?>"><?php echo $value[0];?></option>
                <? endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="category">Название</label>
            <input type="text" name="title_name" class="form-control" id="category" placeholder="Введите название" required>
        </div>
        <div class="form-group">
            <label for="description">Описание:</label>
            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Создать</button>
    </form>
    <a class="btn btn-link" href="<?php echo Matrix::GoBack();?>">Назад</a>
</div>

</body>
</html>
