<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <title><?= $title ?? 'Sistema' ?></title>

    <link rel="stylesheet"
          href="/assets/css/app.css">
</head>

<body>

<?php require __DIR__ .
    '/../partials/app/header.php'; ?>

<?php require __DIR__ .
    '/../partials/app/sidebar.php'; ?>

<main>

    <?= $content ?>

</main>

<?php require __DIR__ .
    '/../partials/app/footer.php'; ?>

<script src="/assets/js/app.js"></script>

<?php if (isset($_SESSION['usuario'])): ?>
    <script src="/assets/js/session-timeout.js"></script>
<?php endif; ?>

</body>

</html>