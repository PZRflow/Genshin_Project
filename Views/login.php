<?php $this->layout('template', ['title' => 'Connexion']); ?>

<a href="index.php" class="btn-back"><span>⬅</span> Retour à l'accueil</a>

<h1>Connexion</h1>

<?php if (isset($message) || isset($error)): ?>
    <?php $msg = $message ?? $error; ?>
    <div class="alert alert-<?= is_object($msg) ? $msg->getColor() : 'error' ?>" style="font-weight: bold;">
        <?= is_object($msg) ? $msg->getMessage() : $this->e($msg) ?>
    </div>
<?php endif; ?>

<form action="index.php?action=login" method="post">
    <div class="form-group">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
    </div>

    <button type="submit" class="btn-submit">Se connecter</button>
</form>