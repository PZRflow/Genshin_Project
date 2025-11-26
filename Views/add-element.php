<?php $this->layout('template', ['title' => 'Ajouter un élément']); ?>

<a href="index.php" class="btn-back"><span>⬅</span> Retour à l'accueil</a>

<h1>Ajouter un élément</h1>

<?php if (isset($message)): ?>
    <div class="alert alert-<?= is_object($message) ? $message->getColor() : 'info' ?>">
        <?= is_object($message) ? $message->getMessage() : $message ?>
    </div>
<?php endif; ?>

<form action="index.php?action=add-element" method="post">
    <div class="form-group">
        <label for="type">Type d'élément :</label>
        <select name="type" id="type" required>
            <option value="element">Élément</option>
            <option value="origin">Origine</option>
            <option value="unitclass">Classe d'unité</option>
        </select>
    </div>

    <div class="form-group">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div class="form-group">
        <label for="url_img">URL de l'image :</label>
        <input type="text" name="url_img" id="url_img" required>
    </div>

    <button type="submit" class="btn-submit">Ajouter</button>
</form>