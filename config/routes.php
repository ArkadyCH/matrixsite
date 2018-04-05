<?php
/**
 * Маршруты ,возвращает массив с маршрутами в виде "путь для сравнения с url из адресной строки' => 'Имя контроллера / Имя экшена'
 */
return array(
    'download' => 'matrix/download',

    'login' => 'user/login',
    'sign' => 'user/sign',
    'logout' => 'user/logout',

    'forum/create' => 'forum/createCategory',
    'forum/([0-9]+)' => 'forum/viewCategory/$1',
    'forum' => 'forum/view',
);