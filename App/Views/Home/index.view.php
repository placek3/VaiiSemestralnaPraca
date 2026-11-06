<?php

/** @var \Framework\Support\LinkGenerator $link */
?>
<main class="main-content">
    <section class="welcome" aria-labelledby="welcome-title">
        <p class="eyebrow">Váš pracovný priestor</p>
        <h1 id="welcome-title">Pokračujte vo svojom príbehu</h1>
        <p>Všetky kapitoly, postavy a poznámky k projektu nájdete na jednom mieste.</p>
        <a class="primary-link" href="<?= $link->url('home.editor') ?>">Otvoriť editor</a>
    </section>

    <section class="project-summary" aria-labelledby="summary-title">
        <h2 id="summary-title">Aktuálny projekt</h2>
        <p class="project-title">Príbeh bez názvu</p>
        <p>Rozpracované kapitoly: 3</p>
        <p>Počet slov: 32</p>
        <a href="<?= $link->url('home.editor') ?>">Pokračovať v kapitole „Stretnutie“ →</a>
    </section>
</main>

<aside class="quick-tools" aria-labelledby="tools-title">
    <h2 id="tools-title">Rýchle nástroje</h2>
    <a href="<?= $link->url('home.editor') ?>">Pokračovať v písaní</a>
    <a id="outline" href="#outline">Otvoriť osnovu</a>
    <a href="<?= $link->url('world.index') ?>">Databáza sveta</a>
    <a id="research" href="#research">Pozrieť poznámky</a>
    <a id="settings" href="#settings">Nastavenia projektu</a>
</aside>
