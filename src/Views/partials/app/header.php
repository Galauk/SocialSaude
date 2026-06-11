<header>

    <h1>Sistema</h1>

    <div>

        Bem-vindo,
        <?= htmlspecialchars(
            $_SESSION['usuario_nome']
        ) ?>

        |
        <a href="/logout">
            Sair
        </a>

    </div>

</header>