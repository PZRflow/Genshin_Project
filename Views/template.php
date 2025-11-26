<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="public/css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?></title>
</head>
<body>
<header>
</header>

<main id="contenu">
        <nav class="main-nav">
            <a href="index.php?action=add-perso" class="btn btn-nav">+ Ajouter un personnage</a>
            <a href="index.php?action=add-element" class="btn btn-nav">+ Ajouter un élément</a>
            <a href="index.php?action=logs" class="btn btn-nav" style="background-color: #333;">📜 Voir les Logs</a>
        </nav>


    <?=$this->section('content')?>

</main>
</body>
</html>