<?php
$title = "Tableau de bord — Copies d'examen";
require_once dirname(__DIR__) . '/layout/header.php';

$totalCopies = count($copies ?? []);
$copiesEnRetard = 0;
$copiesATemps = 0;
$sommeNotes = 0.0;

foreach ($copies as $c) {
    if ($c->isPenaliteAppliquee()) {
        $copiesEnRetard++;
    } else {
        $copiesATemps++;
    }
    $sommeNotes += $c->getNoteFinale();
}

$moyenne = $totalCopies > 0 ? round($sommeNotes / $totalCopies, 2) : 0.0;
?>

<div class="page-header">
    <div>
        <h1>Copies d'examen</h1>
        <p class="page-subtitle">Suivi des soumissions, calcul automatique des pénalités et notes finales</p>
    </div>
    <a href="/copies/create" class="btn btn-primary">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Soumettre une copie
    </a>
</div>

<!-- KPI Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon primary">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
        </div>
        <div>
            <div class="stat-label">Total copies</div>
            <div class="stat-value"><?= $totalCopies ?></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon success">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
        </div>
        <div>
            <div class="stat-label">À temps</div>
            <div class="stat-value"><?= $copiesATemps ?></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon danger">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
        </div>
        <div>
            <div class="stat-label">Pénalisées</div>
            <div class="stat-value"><?= $copiesEnRetard ?></div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon warning">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="7"></circle>
                <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
            </svg>
        </div>
        <div>
            <div class="stat-label">Moyenne finale</div>
            <div class="stat-value"><?= number_format($moyenne, 2) ?> <span style="font-size: 0.95rem; font-weight: 500; color: var(--slate-500);">/20</span></div>
        </div>
    </div>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--slate-200); display: flex; justify-content: space-between; align-items: center;">
        <h2 style="font-size: 1.15rem; font-weight: 700; margin: 0; color: var(--slate-900);">Historique des copies</h2>
        <span style="font-size: 0.85rem; color: var(--slate-500);"><?= $totalCopies ?> enregistrement<?= $totalCopies > 1 ? 's' : '' ?></span>
    </div>

    <?php if (empty($copies)): ?>
        <div style="text-align: center; padding: 4rem 1.5rem;">
            <div style="background: var(--slate-100); width: 64px; height: 64px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem; color: var(--slate-400);">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
            </div>
            <h3 style="font-size: 1.1rem; color: var(--slate-800); margin-bottom: 0.5rem;">Aucune copie enregistrée</h3>
            <p style="color: var(--slate-500); font-size: 0.925rem; margin-bottom: 1.5rem;">Commencez par soumettre votre première copie d'examen.</p>
            <a href="/copies/create" class="btn btn-primary">Soumettre une copie</a>
        </div>
    <?php else: ?>
        <div class="table-responsive" style="border: none; border-radius: 0;">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dépôt</th>
                        <th>Date Limite</th>
                        <th>Note Brute</th>
                        <th>Statut / Pénalité</th>
                        <th>Note Finale</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($copies as $copie): ?>
                        <tr>
                            <td>
                                <span style="font-weight: 700; color: var(--primary); background: var(--primary-50); padding: 0.2rem 0.55rem; border-radius: 6px;">
                                    #<?= htmlspecialchars((string)$copie->getId(), ENT_QUOTES, 'UTF-8') ?>
                                </span>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: var(--slate-800);">
                                    <?= htmlspecialchars($copie->getDateDepot()->format('d/m/Y'), ENT_QUOTES, 'UTF-8') ?>
                                </div>
                                <div style="font-size: 0.8rem; color: var(--slate-500);">
                                    <?= htmlspecialchars($copie->getDateDepot()->format('H:i:s'), ENT_QUOTES, 'UTF-8') ?>
                                </div>
                            </td>
                            <td>
                                <div style="color: var(--slate-700);">
                                    <?= htmlspecialchars($copie->getDateLimite()->format('d/m/Y'), ENT_QUOTES, 'UTF-8') ?>
                                </div>
                                <div style="font-size: 0.8rem; color: var(--slate-400);">
                                    <?= htmlspecialchars($copie->getDateLimite()->format('H:i:s'), ENT_QUOTES, 'UTF-8') ?>
                                </div>
                            </td>
                            <td>
                                <span style="font-weight: 600; color: var(--slate-700);">
                                    <?= htmlspecialchars(number_format($copie->getNoteBrute(), 2), ENT_QUOTES, 'UTF-8') ?>
                                </span>
                                <span style="font-size: 0.8rem; color: var(--slate-400);">/20</span>
                            </td>
                            <td>
                                <?php if ($copie->isPenaliteAppliquee()): ?>
                                    <span class="badge badge-danger">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>
                                        Retard (-2 pts)
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-success">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        À temps (0 pt)
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span style="font-size: 1.05rem; font-weight: 800; color: <?= $copie->getNoteFinale() >= 10 ? 'var(--slate-900)' : 'var(--danger)' ?>;">
                                    <?= htmlspecialchars(number_format($copie->getNoteFinale(), 2), ENT_QUOTES, 'UTF-8') ?>
                                </span>
                                <span style="font-size: 0.8rem; color: var(--slate-400);">/20</span>
                            </td>
                            <td style="text-align: right;">
                                <a href="/copies/<?= htmlspecialchars((string)$copie->getId(), ENT_QUOTES, 'UTF-8') ?>" class="btn btn-secondary btn-sm">
                                    Consulter
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once dirname(__DIR__) . '/layout/footer.php'; ?>
