<?php
$title = "Détail de la copie #" . ($copie ? $copie->getId() : '');
require_once dirname(__DIR__) . '/layout/header.php';

$isLate = $copie->isPenaliteAppliquee();
?>

<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
        <a href="/copies" style="display: inline-flex; align-items: center; gap: 0.4rem; color: var(--slate-500); text-decoration: none; font-size: 0.9rem; font-weight: 600;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
            Retour à la liste des copies
        </a>
        <span style="font-size: 0.85rem; color: var(--slate-400);">Enregistrement #<?= htmlspecialchars((string)$copie->getId(), ENT_QUOTES, 'UTF-8') ?></span>
    </div>

    <!-- Main Card -->
    <div class="card" style="padding: 2.25rem;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--slate-200);">
            <div>
                <span class="badge badge-primary" style="margin-bottom: 0.5rem;">Document universitaire</span>
                <h1 style="font-size: 1.75rem; font-weight: 800; color: var(--slate-900); margin: 0;">Copie d'examen #<?= htmlspecialchars((string)$copie->getId(), ENT_QUOTES, 'UTF-8') ?></h1>
            </div>
            <div>
                <?php if ($isLate): ?>
                    <span class="badge badge-danger" style="font-size: 0.95rem; padding: 0.5rem 1rem;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        Dépôt en retard (-2 pts)
                    </span>
                <?php else: ?>
                    <span class="badge badge-success" style="font-size: 0.95rem; padding: 0.5rem 1rem;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        Remis dans les délais
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Grade Summary Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; margin-bottom: 2rem;">
            <div style="background: var(--slate-50); border: 1px solid var(--slate-200); border-radius: var(--radius-md); padding: 1.25rem; text-align: center;">
                <span style="font-size: 0.8rem; font-weight: 700; color: var(--slate-500); text-transform: uppercase; letter-spacing: 0.05em;">Note brute</span>
                <div style="font-size: 2rem; font-weight: 800; color: var(--slate-800); margin-top: 0.25rem;">
                    <?= htmlspecialchars(number_format($copie->getNoteBrute(), 2), ENT_QUOTES, 'UTF-8') ?>
                    <span style="font-size: 1rem; color: var(--slate-400); font-weight: 500;">/20</span>
                </div>
            </div>

            <div style="background: <?= $isLate ? 'var(--danger-50)' : 'var(--slate-50)' ?>; border: 1px solid <?= $isLate ? '#fecaca' : 'var(--slate-200)' ?>; border-radius: var(--radius-md); padding: 1.25rem; text-align: center;">
                <span style="font-size: 0.8rem; font-weight: 700; color: <?= $isLate ? 'var(--danger)' : 'var(--slate-500)' ?>; text-transform: uppercase; letter-spacing: 0.05em;">Pénalité</span>
                <div style="font-size: 2rem; font-weight: 800; color: <?= $isLate ? 'var(--danger)' : 'var(--slate-600)' ?>; margin-top: 0.25rem;">
                    <?= $isLate ? '- 2.00' : '0.00' ?>
                    <span style="font-size: 1rem; color: <?= $isLate ? 'var(--danger)' : 'var(--slate-400)' ?>; font-weight: 500;">pts</span>
                </div>
            </div>

            <div style="background: linear-gradient(135deg, var(--primary-50), #f5f3ff); border: 1.5px solid var(--primary-light); border-radius: var(--radius-md); padding: 1.25rem; text-align: center;">
                <span style="font-size: 0.8rem; font-weight: 700; color: var(--primary-dark); text-transform: uppercase; letter-spacing: 0.05em;">Note finale</span>
                <div style="font-size: 2.2rem; font-weight: 900; color: var(--primary-dark); margin-top: 0.25rem;">
                    <?= htmlspecialchars(number_format($copie->getNoteFinale(), 2), ENT_QUOTES, 'UTF-8') ?>
                    <span style="font-size: 1.1rem; color: var(--primary); font-weight: 600;">/20</span>
                </div>
            </div>
        </div>

        <!-- Details List -->
        <h3 style="font-size: 1.05rem; font-weight: 700; color: var(--slate-900); margin-bottom: 1rem;">Chronologie de soumission</h3>
        <div style="border: 1px solid var(--slate-200); border-radius: var(--radius-md); overflow: hidden; margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 1.25rem; background: white; border-bottom: 1px solid var(--slate-200);">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 36px; height: 36px; border-radius: 8px; background: var(--slate-100); display: flex; align-items: center; justify-content: center; color: var(--slate-600);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600; color: var(--slate-800);">Date de dépôt effective</div>
                        <div style="font-size: 0.8rem; color: var(--slate-500);">Moment où la copie a été enregistrée</div>
                    </div>
                </div>
                <div style="font-weight: 700; color: var(--slate-900); font-size: 0.95rem;">
                    <?= htmlspecialchars($copie->getDateDepot()->format('d/m/Y à H:i:s'), ENT_QUOTES, 'UTF-8') ?>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 1.25rem; background: var(--slate-50);">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 36px; height: 36px; border-radius: 8px; background: var(--slate-100); display: flex; align-items: center; justify-content: center; color: var(--slate-600);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600; color: var(--slate-800);">Date limite de remise</div>
                        <div style="font-size: 0.8rem; color: var(--slate-500);">Délai maximum autorisé</div>
                    </div>
                </div>
                <div style="font-weight: 700; color: var(--slate-900); font-size: 0.95rem;">
                    <?= htmlspecialchars($copie->getDateLimite()->format('d/m/Y à H:i:s'), ENT_QUOTES, 'UTF-8') ?>
                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap;">
            <a href="/copies" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Retour aux copies
            </a>
            <a href="/copies/create" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Soumettre une autre copie
            </a>
        </div>
    </div>
</div>

<?php require_once dirname(__DIR__) . '/layout/footer.php'; ?>
