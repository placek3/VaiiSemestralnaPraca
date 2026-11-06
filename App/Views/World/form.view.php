<?php

/** @var \App\Models\WorldEntity $entity */
/** @var bool $isEdit */
/** @var \Framework\Support\LinkGenerator $link */
$escape = static fn(mixed $value): string => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
$types = ['postava' => 'Postava', 'lokalita' => 'Lokalita', 'predmet' => 'Predmet', 'pojem' => 'Pojem'];
$action = $isEdit
    ? $link->url('world.edit', ['id' => $entity->id])
    : $link->url('world.create');
?>
<main class="world-page">
    <header class="world-heading">
        <div>
            <p class="eyebrow">Databáza sveta</p>
            <h1><?= $isEdit ? 'Upraviť záznam' : 'Pridať záznam' ?></h1>
            <p>Vyplňte údaje o postave, lokalite alebo predmete.</p>
        </div>
    </header>

    <form class="world-form" method="post" action="<?= $action ?>">
        <label for="type">Typ záznamu</label>
        <select id="type" name="type" required>
            <?php foreach ($types as $value => $label): ?>
                <option value="<?= $escape($value) ?>" <?= $entity->type === $value ? 'selected' : '' ?>>
                    <?= $escape($label) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="name">Názov</label>
        <input id="name" name="name" type="text" value="<?= $escape($entity->name) ?>" required>

        <label for="description">Opis</label>
        <textarea id="description" name="description" rows="6" required><?= $escape($entity->description) ?></textarea>

        <div class="world-form-actions">
            <button class="world-button" type="submit"><?= $isEdit ? 'Uložiť zmeny' : 'Pridať záznam' ?></button>
            <a class="world-secondary" href="<?= $link->url('world.index') ?>">Zrušiť</a>
        </div>
    </form>
</main>
