<?php
$title = "Détail de la copie #" . ($copie ? $copie->getId() : '');
require_once dirname(__DIR__) . '/layout/header.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h1>Détail de la copie #<?= htmlspecialchars((string)$copie->getId(), ENT_QUOTES, 'UTF-8') ?></h1>
        <a href="/copies" class="btn btn-secondary">← Retour à la liste</a>
    </div>

    <div class="detail-row">
        <span class="detail-label">Identifiant :</span>
        <span>#<?= htmlspecialchars((string)$copie->getId(), ENT_QUOTES, 'UTF-8') ?></span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Date et heure de dépôt :</span>
        <span><?= htmlspecialchars($copie->getDateDepot()->format('d/m/Y H:i:s'), ENT_QUOTES, 'UTF-8') ?></span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Date et heure limite :</span>
        <span><?= htmlspecialchars($copie->getDateLimite()->format('d/m/Y H:i:s'), ENT_QUOTES, 'UTF-8') ?></span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Statut du dépôt :</span>
        <span>
            <?php if ($copie->isPenaliteAppliquee()): ?>
                <span class="badge badge-danger">En retard</span>
            <?php else: ?>
                <span class="badge badge-success">Dans les délais</span>
            <?php endif; ?>
        </span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Note brute :</span>
        <span><?= htmlspecialchars(number_format($copie->getNoteBrute(), 2), ENT_QUOTES, 'UTF-8') ?> / 20</span>
    </div>

    <div class="detail-row">
        <span class="detail-label">Pénalité de retard :</span>
        <span>
            <?php if ($copie->isPenaliteAppliquee()): ?>
                <strong style="color: var(--danger);">-2.00 points</strong>
            <?php else: ?>
                <span>Aucune pénalité (0 point)</span>
            <?php endif; ?>
        </span>
    </div>

    <div class="detail-row" style="background-color: var(--gray-100); padding: 1rem; border-radius: 6px; margin-top: 1rem;">
        <span class="detail-label" style="font-size: 1.2rem;">Note finale :</span>
        <span style="font-size: 1.25rem; font-weight: 700; color: var(--primary);">
            <?= htmlspecialchars(number_format($copie->getNoteFinale(), 2), ENT_QUOTES, 'UTF-8') ?> / 20
        </span>
    </div>

    <div class="actions">
        <a href="/copies/create" class="btn btn-primary">Soumettre une autre copie</a>
        <a href="/copies" class="btn btn-secondary">Retour à la liste</a>
    </div>
</div>

<?php require_once dirname(__DIR__) . '/layout/footer.php'; ?>
