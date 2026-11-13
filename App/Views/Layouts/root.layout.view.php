<?php

/** @var string $contentHTML */
/** @var \Framework\Support\LinkGenerator $link */
$currentPage = $_GET['a'] ?? 'index';
$currentController = $_GET['c'] ?? 'home';
$isEditor = $currentPage === 'editor';
$isWorld = $currentController === 'world';
$isNotes = $currentController === 'note';
$isWorldSection = $isWorld || $isNotes;
$isHome = !$isEditor && !$isWorldSection;
$pageTitle = $isEditor ? 'Editor' : ($isWorld ? 'Databáza sveta' : ($isNotes ? 'Poznámky' : 'Prehľad'));
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= App\Configuration::APP_NAME ?> – <?= $pageTitle ?></title>
    <link rel="stylesheet" href="<?= $link->asset($isEditor ? 'css/editor.css' : 'css/style.css') ?>">
    <?php if ($isWorldSection): ?>
        <link rel="stylesheet" href="<?= $link->asset('css/world.css') ?>">
    <?php endif; ?>
</head>
<body>
    <div class="app">
        <header class="topbar">
            <a class="brand" href="<?= $link->url('home.index') ?>" aria-label="<?= App\Configuration::APP_NAME ?> – domov">
                <span class="brand-mark" aria-hidden="true">S</span>
                <span><?= App\Configuration::APP_NAME ?></span>
            </a>
            <div class="project-name">
                <span class="label">Projekt</span>
                <strong>Príbeh bez názvu</strong>
            </div>
            <form class="search" role="search">
                <label class="visually-hidden" for="search">Vyhľadávanie v projekte</label>
                <input id="search" type="search" placeholder="Vyhľadávanie">
                <button type="submit">Hľadať</button>
            </form>
            <button class="profile" type="button">
                <span class="profile-avatar" aria-hidden="true">J</span>
                <span>@Jozko3</span>
            </button>
        </header>

        <div class="workspace">
            <nav class="main-nav" aria-label="Hlavná navigácia">
                <span class="nav-heading">Pracovný priestor</span>
                <a
                    class="nav-link<?= $isHome ? ' active' : '' ?>"
                    href="<?= $link->url('home.index') ?>"
                    <?= $isHome ? 'aria-current="page"' : '' ?>
                >Prehľad</a>
                <a
                    class="nav-link<?= $isEditor ? ' active' : '' ?>"
                    href="<?= $link->url('home.editor') ?>"
                    <?= $isEditor ? 'aria-current="page"' : '' ?>
                >Editor</a>
                <a
                    class="nav-link<?= $isWorld ? ' active' : '' ?>"
                    href="<?= $link->url('world.index') ?>"
                    <?= $isWorld ? 'aria-current="page"' : '' ?>
                >Databáza sveta</a>
                <a
                    class="nav-link<?= $isNotes ? ' active' : '' ?>"
                    href="<?= $link->url('note.index') ?>"
                    <?= $isNotes ? 'aria-current="page"' : '' ?>
                >Poznámky</a>
            </nav>

            <?= $contentHTML ?>
        </div>

        <footer class="statusbar">
            <span>Aktuálny projekt: <strong>Príbeh bez názvu</strong></span>
            <span>Počet slov: <strong>32</strong></span>
            <span>Stav uloženia: <strong><span class="saved-dot"></span> Uložené</strong></span>
        </footer>
    </div>
</body>
</html>
