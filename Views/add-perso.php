<?php $this->layout('template', ['title' => 'Ajouter un personnage']); ?>

<a href="index.php" class="btn-back"><span>⬅</span> Retour à l'accueil</a>

<h1>Ajouter un personnage</h1>

<?php if (isset($message)): ?>
    <div class="alert alert-<?= is_object($message) ? $message->getColor() : ($message['color'] ?? 'info') ?>">
        <?= is_object($message) ? $message->getMessage() : ($message['message'] ?? '') ?>
    </div>
<?php endif; ?>

<form action="index.php?action=add-perso" method="post">

    <div class="form-group">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="element">Élément :</label>
        <select id="element" name="element" required>
            <?php foreach ($elements as $element): ?>
                <option value="<?= $element['id'] ?>"><?= $this->e($element['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="unitclass">Classe :</label>
        <select id="unitclass" name="unitclass" required>
            <?php foreach ($unitClasses as $unitClass): ?>
                <option value="<?= $unitClass['id'] ?>"><?= $this->e($unitClass['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="rarity">Rareté :</label>
        <input type="number" id="rarity" name="rarity" min="4" max="5" required>
    </div>

    <div class="form-group">
        <label for="origin">Origine :</label>
        <select id="origin" name="origin">
            <option value="">-- Sélectionner une origine --</option>
            <?php foreach ($origins as $origin): ?>
                <option value="<?= $origin['id'] ?>"><?= $this->e($origin['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="url_img">URL de l'image :</label>
        <input type="url" id="url_img" name="url_img" required>
    </div>
    <button type="submit" class="btn-submit">Ajouter</button>
</form>