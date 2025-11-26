<?php $this->layout('template', ['title' => 'Modifier un personnage']); ?>

<a href="index.php" class="btn-back"><span>⬅</span> Retour à l'accueil</a>

<h1>Modifier un personnage</h1>

<?php if (isset($message)): ?>
    <div class="alert alert-<?= is_object($message) ? $message->getColor() : ($message['color'] ?? 'info') ?>">
        <?= is_object($message) ? $message->getMessage() : ($message['message'] ?? '') ?>
    </div>
<?php endif; ?>

<form action="index.php?action=edit-perso" method="post">

    <input type="hidden" name="id" value="<?= $personnage->getId() ?>">

    <div class="form-group">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="<?= $this->e($personnage->getName()) ?>" required>
    </div>

    <div class="form-group">
        <label for="element">Élément :</label>
        <select id="element" name="element" required>
            <?php foreach ($elements as $element): ?>
                <option value="<?= $element['id'] ?>"
                    <?= $personnage->getElement() == $element['id'] ? 'selected' : '' ?>>
                    <?= $this->e($element['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="unitclass">Classe :</label>
        <select id="unitclass" name="unitclass" required>
            <?php foreach ($unitClasses as $unitClass): ?>
                <option value="<?= $unitClass['id'] ?>"
                    <?= $personnage->getUnitclass() == $unitClass['id'] ? 'selected' : '' ?>>
                    <?= $this->e($unitClass['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="rarity">Rareté :</label>
        <input type="number" id="rarity" name="rarity" min="4" max="5" value="<?= $personnage->getRarity() ?>" required>
    </div>

    <div class="form-group">
        <label for="origin">Origine (optionnel) :</label>
        <select id="origin" name="origin">
            <option value="">-- Sélectionner une origine --</option>
            <?php foreach ($origins as $origin): ?>
                <option value="<?= $origin['id'] ?>"
                    <?= $personnage->getOrigin() == $origin['id'] ? 'selected' : '' ?>>
                    <?= $this->e($origin['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="url_img">URL de l'image :</label>
        <input type="url" id="url_img" name="url_img" value="<?= $this->e($personnage->getUrlImg()) ?>" required>
    </div>

    <button type="submit" class="btn-submit">Modifier</button>
</form>