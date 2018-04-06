<?php
/**
 * Маршруты ,возвращает массив с маршрутами в виде "путь для сравнения с url из адресной строки' => 'Имя контроллера / Имя экшена'
 */
return array(
    'download' => 'matrix/download',

    'login' => 'user/login',
    'sign' => 'user/sign',
    'logout' => 'user/logout',

    'forum/create/category' => 'forum/createCategory',
    'forum/delete' => 'forum/delete',
    'forum/create/topic/([0-9]+)' => 'forum/createTopic/$1',
    'forum/([0-9]+)' => 'forum/viewCategory/$1',
    'topic/([0-9]+)' => 'forum/viewTopic/$1',
    'forum' => 'forum/view',
);