<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT . '/views/matrix/link.php'; ?>
</head>
<body>
<?php include ROOT . '/views/matrix/header.php'; ?>

<div class="forum-box center">
    <form method="post">
        <div class="form-group">
            <label for="selectCategory">Выберите категорию</label>
            <select class="form-control" name="id" id="selectCategory" required>
                <?php foreach ($treeList as $key => $value): ?>
                    <?php foreach ($value as $inner_key => $inner_value): ?>
                        <?php if ($inner_value['type_id'] != 3): ?>
                            <option value="<?php echo $inner_value['id']; ?>">
                                <?php for ($i = 0; $i < Forum::getRootLvl($inner_value['id']); $i++): ?>
                                    <?php echo "&#160;"; ?>
                                <?php endfor; ?>
                                <?php echo $inner_value['title_name']; ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Удалить</button>
    </form>
</div>

</body>
</html>
