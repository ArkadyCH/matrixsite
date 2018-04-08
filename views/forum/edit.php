<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT . '/views/matrix/link.php'; ?>
</head>
<body>
<?php include ROOT . '/views/matrix/header.php'; ?>
<div class="forum-box center">
    <div class="form-choose">
        <form method="post">
            <div class="form-group">
                <label for="selectCategory">Выберите то, что хотите отредактировать</label>
                <select class="form-control" name="id" id="selectCategory" required>
                    <?php foreach ($list as $key => $value): ?>
                        <?php foreach ($value as $inner_key => $inner_value): ?>
                            <option value="<?php echo $inner_value['id']; ?>">
                                <?php for ($i = 0; $i < Forum::getRootLvl($inner_value['id']); $i++): ?>
                                    <?php echo "&#160;"; ?>
                                <?php endfor; ?>
                                <?php echo $inner_value['title_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="submit_choose" class="btn btn-primary">Выбрать</button>
        </form>
    </div>

    <div class="form-edit">
        <?php if (isset($elements)): ?>
            <form method="post">
                <div class="form-group">
                    <label for="selectCategory">Выберите Родителя</label>
                    <select class="form-control" name="parent_id" id="selectCategory" required>
                        <?php foreach ($list as $key => $value): ?>
                            <?php foreach ($value as $inner_key => $inner_value): ?>
                                <?php if ($elements[0]['type_id'] == 1): ?>
                                    <?php if ($inner_value['id'] == $elements[0]['id']): ?>
                                        <option value="<?php echo $inner_value['id']; ?>">
                                            <?php echo $inner_value['title_name']; ?>
                                        </option>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if ($inner_value['type_id'] != 3 && $inner_value['id'] != $elements[0]['id']): ?>
                                        <option value="<?php echo $inner_value['id']; ?>" <?php if ($inner_value['id'] == $elements[0]['parent_id']) echo 'selected'; ?>>
                                            <?php for ($i = 0; $i < Forum::getRootLvl($inner_value['id']); $i++): ?>
                                                <?php echo "&#160;"; ?>
                                            <?php endfor; ?>
                                            <?php echo $inner_value['title_name']; ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Название</label>
                    <input type="text" name="title_name" class="form-control" id="category"
                           placeholder="Введите название" value="<?php echo $elements[0]['title_name'] ?>">
                </div>
                <div class="form-group">
                    <label for="description">Описание:</label>
                    <textarea class="form-control" name="description" id="description"
                              rows="3"><?php echo $elements[0]['description'] ?></textarea>
                </div>
                <button type="submit" name="submit_edit" class="btn btn-primary">Изменить</button>
            </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
