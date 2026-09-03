<?php
$title = "Page non trouvée - Erreur 404";
require_once dirname(__DIR__) . '/layout/header.php';
?>

<div class="card" style="text-align: center; padding: 3rem 1rem;">
    <h1 style="font-size: 3rem; color: var(--danger); margin-bottom: 0.5rem;">404</h1>
    <h2>Page non trouvée</h2>
    <p style="color: var(--gray-700); margin: 1.5rem 0;">
        <?= htmlspecialchars($message ?? "La ressource demandée n'existe pas ou a été déplacée.", ENT_QUOTES, 'UTF-8') ?>
    </p>
    <div style="margin-top: 1.5rem;">
        <a href="/copies" class="btn btn-primary">Retour aux copies</a>
    </div>
</div>

<?php require_once dirname(__DIR__) . '/layout/footer.php'; ?>
