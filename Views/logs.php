<?php $this->layout('template', ['title' => 'Logs Système']) ?>

<a href="index.php" class="btn-back"><span>⬅</span> Retour à l'accueil</a>

<h1>📜 Historique des logs</h1>

<div style="display: flex; gap: 20px; align-items: flex-start;">

    <div style="flex: 1; max-width: 250px;">
        <h3 style="color: gold; border-bottom: 1px solid gold; padding-bottom: 10px;">Fichiers disponibles</h3>
        <ul>
            <?php foreach ($logFiles as $file): ?>
                <li style="margin-bottom: 10px; list-style: none;">
                    <a href="index.php?action=logs&file=<?= urlencode($file) ?>"
                       class="btn"
                       style="display:block; text-align:left; background: <?= (isset($currentFile) && $currentFile === $file) ? '#4CAF50' : '#333' ?>;">
                        📄 <?= $this->e($file) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div style="flex: 3;">
        <?php if (isset($logContent)): ?>
            <h3 style="color: gold;">Contenu du fichier : <?= isset($currentFile) ? $this->e($currentFile) : '' ?></h3>

            <div class="log-container">
                <?= htmlspecialchars($logContent) ?>
            </div>
        <?php else: ?>
            <div style="background: rgba(0,0,0,0.5); padding: 20px; border-radius: 10px; text-align: center; color: #aaa;">
                <p>Sélectionnez un fichier dans la liste de gauche pour voir son contenu.</p>
            </div>
        <?php endif; ?>
    </div>
</div>