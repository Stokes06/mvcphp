<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/"> Epicerie</a>
        </div>
        <!-- Pour le header, j'ai une fonction qui active le bon suivant la page -->
        <ul class="nav navbar-nav">
            <li class="<?= \Dev\Tool::isActive($url, '/') ?>"><a href="/"> Home</a></li>

            <li class="<?= \Dev\Tool::isActive($url, '/product/create') ?>">
                <a href="/product/create">Ajouter un produit</a>
            </li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php if (!empty($_SESSION['user'])): ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown"><?= $user->getPseudo()?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a onclick="return confirm('êtes-vous sûr de vouloir vous déconnecter ?');"
                               href="/connexion/logout">Logout</a></li>
                    </ul>
                </li>
            <?php else : ?>
                <li class="<?= \Dev\Tool::isActive($url, '/connexion') ?>"><a href="/connexion/login"><span
                                class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>