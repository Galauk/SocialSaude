<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <title><?= $title ?? 'Meu Sistema' ?></title>

    <link rel="stylesheet"
          href="/assets/css/public.css">
</head>

<body>

<?php require __DIR__ .
    '/../partials/public/header.php'; ?>

<main>

    <?= $content ?>

</main>

<?php require __DIR__ .
    '/../partials/public/footer.php'; ?>

</body>

</html>