<?php

/** @var \App\Models\WorldEntity[] $entities */
/** @var \Framework\Support\LinkGenerator $link */
$escape = static fn(mixed $value): string => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
?>
<main class="world-page">
    <header class="world-heading">
        <div>
            <p class="eyebrow">Príbeh bez názvu</p>
            <h1>Databáza sveta</h1>
            <p>Spravujte postavy, lokality a predmety svojho príbehu.</p>
        </div>
        <a class="world-button" href="<?= $link->url('world.create') ?>">+ Pridať záznam</a>
    </header>

    <?php if ($entities === []): ?>
        <section class="world-empty">
            <h2>Zatiaľ tu nie sú žiadne záznamy</h2>
            <p>Pridajte prvú postavu, lokalitu alebo predmet do databázy sveta.</p>
            <a class="world-button" href="<?= $link->url('world.create') ?>">Pridať prvý záznam</a>
        </section>
    <?php else: ?>
        <?php
        $types = array_values(array_unique(array_map(
            static fn(WorldEntity $entity): string => (string)$entity->type,
            $entities
        )));
        ?>
        <section class="world-tools" data-world-browser aria-label="Vyhľadávanie a filtrovanie záznamov">
            <label>
                Vyhľadať záznam
                <input data-world-search type="search" placeholder="Názov, typ alebo opis" autocomplete="off">
            </label>
            <label>
                Typ
                <select data-world-type>
                    <option value="">Všetky typy</option>
                    <?php foreach ($types as $type): ?>
                        <option value="<?= $escape($type) ?>"><?= $escape($type) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>
                Zoradiť
                <select data-world-sort>
                    <option value="original">Pôvodné poradie</option>
                    <option value="name-asc">Názov A–Z</option>
                    <option value="name-desc">Názov Z–A</option>
                    <option value="type">Typ A–Z</option>
                </select>
            </label>
            <p data-world-count role="status" aria-live="polite"></p>
        </section>

        <section class="world-list" data-world-list aria-label="Záznamy databázy sveta">
            <?php foreach ($entities as $entity): ?>
                <article
                    class="world-card"
                    data-world-card
                    data-name="<?= $escape($entity->name) ?>"
                    data-type="<?= $escape($entity->type) ?>"
                    data-description="<?= $escape($entity->description) ?>"
                >
                    <div class="world-card-copy">
                        <span class="world-type"><?= $escape($entity->type) ?></span>
                        <h2><?= $escape($entity->name) ?></h2>
                        <p><?= nl2br($escape($entity->description)) ?></p>
                    </div>
                    <div class="world-actions">
                        <a class="world-secondary" href="<?= $link->url('world.edit', ['id' => $entity->id]) ?>">Upraviť</a>
                        <form method="post" action="<?= $link->url('world.delete') ?>">
                            <input type="hidden" name="id" value="<?= $escape($entity->id) ?>">
                            <button class="world-danger" type="submit">Odstrániť</button>
                        </form>
                    </div>
                </article>
            <?php endforeach; ?>
            <p class="world-no-results" data-world-empty hidden>Nenašli sa žiadne záznamy zodpovedajúce filtru.</p>
        </section>
    <?php endif; ?>
</main>
