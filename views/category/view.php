<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT . '/views/matrix/link.php'; ?>
</head>
<body>
<?php include ROOT . '/views/matrix/header.php'; ?>

<div class="forum-box center">
    <h1 class="text-align">Форум</h1>
    <?php foreach ($listSections as $key => $value): ?>
        <div class="section">
            <table class="table shadow" style="height: 100px;">
                <tbody>
                <tr class="table-info">
                    <td colspan="4">
                        <?php echo $value['title_name']; ?>
                        <?php if ($isLogged && ($isTopics || !$listCategories) && $value['type_id'] != 1): ?>
                            <a class="float-right" href="/topic/create/<?php echo $value['id']; ?>">Создать
                                тему</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php if (isset($listCategories) && $listCategories[$key]['type_id'] == 2): ?>
                    <tr class="table-active">
                        <td class="forumNameTd"></td>
                        <td>Темы</td>
                        <td>Сообщения</td>
                        <td>Описание</td>
                    </tr>
                    <?php foreach ($listCategories as $categories => $category): ?>
                        <tr>
                            <td class="align-middle">
                                <a href="/category/<?php echo $category['id']; ?>"><?php echo $category['title_name'] ?></a>
                            </td>
                            <td class="align-middle text-align">
                                <?php echo Topic::getCountTopic($category['id']); ?>
                            </td>
                            <td class="align-middle text-align">
                                <?php echo Forum::getCountAllMessages($value['id']); ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $category['description'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php elseif ($listCategories[$key]['type_id'] == 3): ?>
                    <tr class="table-active">
                        <td class="forumNameTd"></td>
                        <td class="align-middle text-align">Ответов</td>
                        <td colspan="2">Автор</td>
                    </tr>
                    <?php foreach ($listCategories as $categories => $topic): ?>
                        <tr>
                            <td class="align-middle">
                                <a href="/topic/<?php echo $topic['id']; ?>"><?php echo $topic['title_name'] ?></a>
                            </td>
                            <td class="align-middle text-align">
                                <?php echo Forum::getCountMessages($topic['id']); ?>
                            </td>
                            <td class="align-middle">
                                <?php echo User::getUserNameById($topic['user_id']); ?>
                            </td>
                            <?php if(Admin::isAdmin()): ?>
                            <td>
                                <a class="" href="/topic/delete/<?php echo $topic['id']; ?>">Удалить <i class="fa fa-trash-o "></i></a>
                                <a class="" href="/topic/edit/<?php echo $topic['id']; ?>">Редактировать <i class="fa fa-edit"></i></a>
                            </td>
                            <?php endif;?>
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
