<?php
// On génère le vrai hash pour le mot de passe "admin"
$hash = password_hash("admin", PASSWORD_DEFAULT);
echo "Le hash valide est : " . $hash;
?>