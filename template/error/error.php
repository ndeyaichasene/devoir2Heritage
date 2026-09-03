<?php
$title = "Une erreur est survenue";
require_once dirname(__DIR__) . '/layout/header.php';
?>

<div class="card">
    <h1 style="color: var(--danger);">Erreur</h1>
    <div class="alert alert-danger">
        <p><?= htmlspecialchars($message ?? "Une erreur inattendue est survenue lors du traitement.", ENT_QUOTES, 'UTF-8') ?></p>
    </div>

    <?php if (!empty($errors)): ?>
        <ul style="margin-left: 1.5rem; margin-bottom: 1.5rem;">
            <?php foreach ((array)$errors as $error): ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="actions">
        <a href="javascript:history.back()" class="btn btn-secondary">Page précédente</a>
        <a href="/copies" class="btn btn-primary">Retour à la liste</a>
    </div>
</div>

<?php require_once dirname(__DIR__) . '/layout/footer.php'; ?>
