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
                    <td colspan="4">
                        <?php echo $value['title_name']; ?>
                            <a class="float-right" href="/forum/create/topic/<?php echo $value['id'];?>">Создать тему</a>
                    </td>
                </tr>
                <?php if(isset($listCategories) && $listCategories[$key]['type_id'] == 2): ?>
                <tr class="table-active">
                    <td class="forumNameTd"></td>
                    <td>Темы</td>
                    <td>Сообщения</td>
                    <td>Описание</td>
                </tr>
                    <?php foreach ($listCategories as $categories => $category): ?>
                        <tr>
                            <td class="align-middle">
                                <a href="/forum/<?php echo $category['id'];?>"><?php echo $category['title_name']?></a>
                            </td>
                            <td class="align-middle text-align">
                                <?php echo Forum::getCountTopic($category['id']);?>
                            </td>
                            <td class="align-middle text-align">
                                0
                            </td>
                            <td class="align-middle">
                                <?php echo $category['description']?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php elseif($listCategories[$key]['type_id'] == 3): ?>
                    <tr class="table-active">
                        <td class="forumNameTd"></td>
                        <td>Ответов</td>
                        <td>Автор</td>
                    </tr>
                    <?php foreach ($listCategories as $categories => $topic): ?>
                        <tr>
                            <td class="align-middle">
                                <a href="/topic/<?php echo $topic['id'];?>"><?php echo $topic['title_name']?></a>
                            </td>
                            <td class="align-middle text-align">
                                0
                            </td>
                            <td class="align-middle text-align">
                                <?php echo Forum::getUserNameById($value['user_id']);?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="table-danger">
                        <td> В этой секции нету категорий и тем</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
