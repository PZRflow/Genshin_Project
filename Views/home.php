<?php
// On récupère l'utilisateur connecté via le Service
use Services\AuthService;
$userId = AuthService::getCurrentUserId();
$persoDao = new \Models\PersonnageDAO();
?>

<?php $this->layout('template', ['title' => 'Collection Genshin Impact']) ?>

<h1>
    <?= isset($isCollectionPage) && $isCollectionPage ? "Ma Collection" : "Tous les Personnages" ?>
</h1>

<div style="text-align: center; margin-bottom: 20px;">

    <a href="index.php" class="btn btn-global">Catalogue Global</a>

    <?php if ($userId): ?>
        <a href="index.php?action=my-collection" class="btn btn-my-collec">Voir ma Collection</a>

        <a href="index.php?action=logout" class="btn btn-logout">
            Se déconnecter (<?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Moi' ?>)
        </a>

    <?php else: ?>
        <a href="index.php?action=login" class="btn btn-login">Se connecter</a>
    <?php endif; ?>

</div>

<div class="personnages">
    <?php foreach ($personnages as $perso): ?>

        <?php
        $isOwned = false;
        if ($userId) {
            $isOwned = $persoDao->isInCollection($userId, $perso->getId());
        }
        ?>

        <div class="perso-card <?= $isOwned ? 'owned' : '' ?>">

            <?php if ($isOwned): ?>
                <div class="owned-badge">✓ POSSÉDÉ</div>
            <?php endif; ?>

            <div>
                <h2 style="color: gold; text-align: center; margin-top:0;"><?= $this->e($perso->getName()) ?></h2>
                <img src="<?= $this->e($perso->getUrlImg()) ?>" alt="<?= $this->e($perso->getName()) ?>" class="perso-image">

                <div class="attribute">
                    <strong style="color: #ffcc00; width: 80px;">Élément :</strong>
                    <?php if ($perso->getElementObj()): ?>
                        <img src="<?= $this->e($perso->getElementObj()->getUrlImg()) ?>" class="attribute-icon">
                        <span><?= $this->e($perso->getElementObj()->getName()) ?></span>
                    <?php endif; ?>
                </div>

                <div class="attribute">
                    <strong style="color: #ffcc00; width: 80px;">Classe :</strong>
                    <?php if ($perso->getUnitClassObj()): ?>
                        <img src="<?= $this->e($perso->getUnitClassObj()->getUrlImg()) ?>" class="attribute-icon">
                        <span><?= $this->e($perso->getUnitClassObj()->getName()) ?></span>
                    <?php endif; ?>
                </div>

                <div class="attribute">
                    <strong style="color: #ffcc00; width: 80px;">Origine :</strong>
                    <?php if ($perso->getOriginObj()): ?>
                        <img src="<?= $this->e($perso->getOriginObj()->getUrlImg()) ?>" class="attribute-icon">
                        <span><?= $this->e($perso->getOriginObj()->getName()) ?></span>
                    <?php endif; ?>
                </div>

                <div class="attribute">
                    <strong style="color: #ffcc00; width: 80px;">Rareté :</strong>
                    <div class="rarity-stars">
                        <?php for ($i = 0; $i < $perso->getRarity(); $i++): ?>⭐<?php endfor; ?>
                    </div>
                </div>
            </div>

            <div class="actions">
                <?php if ($userId): ?>
                    <a href="index.php?action=toggle-collection&id=<?= $this->e($perso->getId()) ?>"
                       class="btn btn-collection <?= $isOwned ? 'btn-remove' : 'btn-add' ?>">
                        <?= $isOwned ? "Retirer de ma collection" : "Ajouter à ma collection" ?>
                    </a>
                <?php endif; ?>

                <div class="admin-actions">
                    <a href="index.php?action=edit-perso&id=<?= $this->e($perso->getId()) ?>" class="btn btn-edit">Éditer</a>
                    <a href="index.php?action=del-perso&id=<?= $this->e($perso->getId()) ?>" class="btn btn-delete" onclick="return confirm('Supprimer ce personnage ?')">🗑️</a>
                </div>
            </div>

        </div>
    <?php endforeach; ?>

    <?php if(empty($personnages)): ?>
        <p style="width: 100%; text-align: center; font-size: 1.5em; margin-top: 50px;">
            Aucun personnage trouvé... <br>
            <a href="index.php" style="color: gold;">Retourner au catalogue global</a>
        </p>
    <?php endif; ?>
</div>