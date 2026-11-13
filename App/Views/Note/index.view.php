<?php

/** @var \App\Models\WorldNote[] $notes */
/** @var array<string, \App\Models\WorldEntity> $entitiesById */
/** @var \Framework\Support\LinkGenerator $link */
$escape = static fn(mixed $value): string => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
?>
<main class="world-page">
    <header class="world-heading">
        <div>
            <p class="eyebrow">Databáza sveta</p>
            <h1>Poznámky</h1>
            <p>Ukladajte poznámky priradené k postavám, lokalitám a predmetom.</p>
        </div>
        <a class="world-button" href="<?= $link->url('note.create') ?>">+ Pridať poznámku</a>
    </header>

    <?php if ($notes === []): ?>
        <section class="world-empty">
            <h2>Zatiaľ tu nie sú žiadne poznámky</h2>
            <p>Vytvorte poznámku a priraďte ju k záznamu v databáze sveta.</p>
            <a class="world-button" href="<?= $link->url('note.create') ?>">Pridať prvú poznámku</a>
        </section>
    <?php else: ?>
        <section class="world-list" aria-label="Poznámky k svetu">
            <?php foreach ($notes as $note): ?>
                <?php $entity = $entitiesById[(string)$note->worldEntityId] ?? null; ?>
                <article class="world-card">
                    <div class="world-card-copy">
                        <span class="world-type">
                            <?= $entity === null ? 'Nepriradený záznam' : $escape($entity->type . ': ' . $entity->name) ?>
                        </span>
                        <h2><?= $escape($note->title) ?></h2>
                        <p><?= nl2br($escape($note->content)) ?></p>
                    </div>
                    <div class="world-actions">
                        <a class="world-secondary" href="<?= $link->url('note.edit', ['id' => $note->id]) ?>">Upraviť</a>
                        <form method="post" action="<?= $link->url('note.delete') ?>">
                            <input type="hidden" name="id" value="<?= $escape($note->id) ?>">
                            <button class="world-danger" type="submit">Odstrániť</button>
                        </form>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
</main>
