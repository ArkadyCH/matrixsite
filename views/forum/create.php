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
                <?php foreach($list as $key => $value): ?>
                    <option value="<?php echo $value['id'];?>"><?php echo $value['title_name'];?></option>
                <? endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="category">Название</label>
            <input type="text" name="title_name" class="form-control" id="category" placeholder="Введите название" required>
        </div>
        <div class="form-group">
            <label for="description">Описание:</label>
            <textarea class="form-control" name="description" id="description" rows="3" ></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Создать</button>
    </form>
</div>

</body>
</html>
