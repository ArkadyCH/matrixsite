<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT.'/views/matrix/link.php';?>
</head>
<body>
<?php include ROOT.'/views/matrix/header.php';?>

<div class="forum-box center">
    <h1 class="text-align">Форум</h1>
<?php foreach($listSections as $key => $value): ?>
    <div class="section">
        <table class="table shadow" style="height: 100px;">
            <tbody>
                <tr class="table-info">
                    <td colspan="4"><?php echo $value['title_name']; ?></td>
                </tr>
                <?php $listCategories = Forum::getCategoriesBySectionId($value['id']) ?>
                <?php if(isset($listCategories) && is_array($listCategories)): ?>
                    <?php foreach ($listCategories as $key => $value): ?>
                    <tr class="table-active">
                        <td class="forumNameTd"></td>
                        <td>Темы</td>
                        <td>Сообщения</td>
                        <td>Описание</td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <a href="/forum/<?php echo $value['id'];?>"><?php echo $value['title_name']?></a>
                        </td>
                        <td class="align-middle text-align">
                            0
                        </td>
                        <td class="align-middle text-align">
                            0
                        </td>
                        <td class="align-middle">
                            <?php echo $value['description']?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="table-danger">
                        <td> В этой секции нету категорий</td>
                    </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php endforeach; ?>
    <a class="btn btn-link" href="/forum/create">Создать категорию</a>
</div>

</body>
</html>
