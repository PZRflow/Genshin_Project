<?php $this->layout('template', ['title' => 'Erreur']) ?>

<h1>Erreur</h1>
<p><?= $this->e($message) ?></p>
<a href="index.php">Retour à l'accueil</a>
