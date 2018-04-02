<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="">Matrix / Site</a>
    </div>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/download">Скачать</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Форум</a>
                </li>
            <?php if(!User::checkUserSession()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Вход</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Выход</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>