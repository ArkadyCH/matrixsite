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
            <select class="form-control" name="id" id="selectCategory" required>
                <option value="0">Новый раздел</option>
                <?php foreach($list as $key => $value): ?>
                    <?php foreach($value as $inner_key => $inner_value): ?>
                        <?php if($inner_value['type_id'] != 3):?>
                            <option value="<?php echo $inner_value['id'];?>">
                                <?php for($i = 0; $i < Forum::getRootLvl($inner_value['id']);$i++): ?>
                                    <?php echo "&#160;";?>
                                <?php endfor;?>
                                <?php echo $inner_value['title_name'];?>
                            </option>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php endforeach;?>
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
