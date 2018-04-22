<!DOCTYPE html>
<html>
<head>
    <title>Upload</title>
    <?php include ROOT . '/views/matrix/link.php'; ?>
</head>
<body>
<?php include ROOT . '/views/matrix/header.php'; ?>

<div class="forum-box center">
    <form method="post">
        <?php if ($errors): ?>
        <ul class="text-align">
            <li> <?php echo $errors; ?></li>
        </ul>
        <?php endif; ?>
        <div class="form-group">
            <label for="selectCategory">Выберите Файл</label>
            <select class="form-control" name="id" id="selectCategory" required>
                <?php foreach ($list as $key => $value): ?>
                    <option value="<?php echo $value['id']; ?>">
                        <?php echo $value['filename'] ?>
                        <?php if ($value['status'] == "current") echo ' :' . $value['status']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Сделать текущим</button>
    </form>
</div>

</body>
</html>
