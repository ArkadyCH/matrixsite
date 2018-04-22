<?php
/**
 * Маршруты ,возвращает массив с маршрутами в виде "путь для сравнения с url из адресной строки' => 'Имя контроллера / Имя экшена'
 */
return array(
    'welcome' => 'matrix/welcome',

    'download/soft/([a-zA-Z0-9]+).([a-z]+)' => 'soft/download/$1/$2',
    'download' => 'soft/index',
    'upload/soft' => 'soft/upload',
    'delete/soft' => 'soft/delete',
    'edit/soft' => 'soft/edit',

    'login' => 'user/login',
    'sign' => 'user/sign',
    'logout' => 'user/logout',
    'user/edit/([0-9]+)' => 'user/edit/$1',
    'user/delete' => 'user/delete',

    'category/create/category' => 'category/create',
    'category/([0-9]+)' => 'category/view/$1',
    'category/delete' => 'category/delete',
    'category/edit' => 'category/edit',

    'topic/create/([0-9]+)' => 'topic/create/$1',
    'topic/([0-9]+)' => 'topic/view/$1',

    'forum' => 'forum/view',

    'cabinet' => 'matrix/cabinet',
    'admin' => 'matrix/admin',
    'infographic' => 'matrix/infographic'
);