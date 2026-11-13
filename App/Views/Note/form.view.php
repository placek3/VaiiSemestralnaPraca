<?php

/** @var \App\Models\WorldNote $note */
/** @var \App\Models\WorldEntity[] $entities */
/** @var bool $isEdit */
/** @var \Framework\Support\LinkGenerator $link */
$escape = static fn(mixed $value): string => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
$action = $isEdit
    ? $link->url('note.edit', ['id' => $note->id])
    : $link->url('note.create');
?>
<main class="world-page">
    <header class="world-heading">
        <div>
            <p class="eyebrow">Poznámky k svetu</p>
            <h1><?= $isEdit ? 'Upraviť poznámku' : 'Pridať poznámku' ?></h1>
            <p>Každá poznámka patrí k jednému záznamu databázy sveta.</p>
        </div>
    </header>

    <?php if ($entities === []): ?>
        <section class="world-empty">
            <h2>Najprv vytvorte záznam sveta</h2>
            <p>Poznámku je možné priradiť k postave, lokalite, predmetu alebo pojmu.</p>
            <a class="world-button" href="<?= $link->url('world.create') ?>">Pridať záznam sveta</a>
        </section>
    <?php else: ?>
        <form class="world-form" method="post" action="<?= $action ?>">
            <label for="worldEntityId">Priradiť k záznamu</label>
            <select id="worldEntityId" name="worldEntityId" required>
                <?php foreach ($entities as $entity): ?>
                    <option value="<?= $escape($entity->id) ?>"
                        <?= (string)$note->worldEntityId === (string)$entity->id ? 'selected' : '' ?>>
                        <?= $escape($entity->type . ': ' . $entity->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="title">Názov poznámky</label>
            <input id="title" name="title" type="text" value="<?= $escape($note->title) ?>" required>

            <label for="content">Obsah</label>
            <textarea id="content" name="content" rows="6" required><?= $escape($note->content) ?></textarea>

            <div class="world-form-actions">
                <button class="world-button" type="submit"><?= $isEdit ? 'Uložiť zmeny' : 'Pridať poznámku' ?></button>
                <a class="world-secondary" href="<?= $link->url('note.index') ?>">Zrušiť</a>
            </div>
        </form>
    <?php endif; ?>
</main>
