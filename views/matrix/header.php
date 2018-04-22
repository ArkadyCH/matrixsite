<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="">Matrix / Site</a>
    </div>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/download">Скачать</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/forum">Форум</a>
                </li>
            <?php if(!User::checkUserSession()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Вход <i class="fa fa-sign-in"></i></a>
                </li>
            <?php else: ?>
            <?php $user = User::getUserById($_SESSION['user_id']);?>
                <li class="nav-item">
                    <a class="nav-link" href="/profile/<?php echo $user['id'];?>"><?php echo $user['name'];?> <i class="fa fa-user"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Выход <i class="fa fa-sign-out"></i></a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>