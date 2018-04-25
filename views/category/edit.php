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
                <label for="selectCategory">Выберите категорию </label>
                <select class="form-control" name="id" id="selectCategory" required>
                    <?php foreach ($list as $key => $value): ?>
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
            <button type="submit" name="submit" class="btn btn-primary">Выбрать</button>
        </form>
    </div>
</div>
<?php if ($result && $element['type_id'] != 3): ?>
    <div class="forum-box center">
        <div class="form-choose">
            <form method="post">
                <?php if (isset($element)): ?>
                    <div class="form-group">
                        <label for="idElement">Выбранный элемент</label>
                        <select class="form-control" name="id" id="idElement" required>
                            <option value="<?php echo $element['id']; ?>"><?php echo $element['title_name']; ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectCategory">Выберите родителя если хотите переместить элемент</label>
                        <select class="form-control" name="parent_id" id="selectCategory" required>
                            <?php foreach ($list as $key => $value): ?>
                                <?php foreach ($value as $inner_key => $inner_value): ?>
                                    <?php if ($element['type_id'] == 1): ?>
                                        <?php if ($inner_value['id'] == $element['id']): ?>
                                            <option value="0">
                                                <?php echo $inner_value['title_name']; ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if (!Forum::sectionIsTopics($inner_value['id']) && $inner_value['type_id'] != 3 && $inner_value['id'] != $element['id']): ?>
                                            <option value="<?php echo $inner_value['id']; ?>" <?php if ($inner_value['id'] == $element['parent_id']) echo 'selected'; ?>>
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
                               placeholder="Введите название" value="<?php echo $element['title_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание:</label>
                        <textarea class="form-control" name="description" id="description"
                                  rows="3"><?php echo $element['description'] ?></textarea>
                    </div>
                <?php endif; ?>
                <button type="submit" name="submit_edit" class="btn btn-primary">Изменить</button>
            </form>
        </div>
    </div>
<?php endif; ?>
</body>
</html>
