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
                <li class="nav-item">
                    <a class="nav-link" href="/profile/<?php echo $_SESSION['user_id'];?>"><?php echo User::getUserNameById($_SESSION['user_id']);?> <i class="fa fa-user"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/message">Сообщения</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Выход <i class="fa fa-sign-out"></i></a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>