<?php
$title = "Erreur de traitement";
require_once dirname(__DIR__) . '/layout/header.php';
?>

<div style="max-width: 600px; margin: 3rem auto;">
    <div class="card" style="padding: 2.5rem;">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; color: var(--danger);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: var(--danger-50); display: flex; align-items: center; justify-content: center;">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            <div>
                <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--slate-900); margin: 0;">Erreur de traitement</h1>
                <p class="page-subtitle" style="margin: 0;">Une anomalie est survenue lors de l'opération</p>
            </div>
        </div>

        <div class="alert alert-danger" style="margin-bottom: 1.75rem;">
            <?= htmlspecialchars($message ?? "Une erreur inattendue est survenue.", ENT_QUOTES, 'UTF-8') ?>
        </div>

        <?php if (!empty($errors)): ?>
            <ul style="margin-left: 1.5rem; margin-bottom: 1.75rem; color: var(--slate-700);">
                <?php foreach ((array)$errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="javascript:history.back()" class="btn btn-secondary">Retourner en arrière</a>
            <a href="/copies" class="btn btn-primary">Tableau de bord</a>
        </div>
    </div>
</div>

<?php require_once dirname(__DIR__) . '/layout/footer.php'; ?>
