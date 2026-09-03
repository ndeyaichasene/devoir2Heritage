<?php
$title = "Liste des copies d'examen";
require_once dirname(__DIR__) . '/layout/header.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <h1>Liste des copies d'examen</h1>
        <a href="/copies/create" class="btn btn-primary">+ Soumettre une copie</a>
    </div>

    <?php if (empty($copies)): ?>
        <p>Aucune copie enregistrée pour le moment.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date de dépôt</th>
                    <th>Date limite</th>
                    <th>Note brute</th>
                    <th>Pénalité</th>
                    <th>Note finale</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($copies as $copie): ?>
                    <tr>
                        <td>#<?= htmlspecialchars((string)$copie->getId(), ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($copie->getDateDepot()->format('d/m/Y H:i'), ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($copie->getDateLimite()->format('d/m/Y H:i'), ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars(number_format($copie->getNoteBrute(), 2), ENT_QUOTES, 'UTF-8') ?> / 20</td>
                        <td>
                            <?php if ($copie->isPenaliteAppliquee()): ?>
                                <span class="badge badge-danger">Retard (-2 pts)</span>
                            <?php else: ?>
                                <span class="badge badge-success">À temps (0 pt)</span>
                            <?php endif; ?>
                        </td>
                        <td><strong><?= htmlspecialchars(number_format($copie->getNoteFinale(), 2), ENT_QUOTES, 'UTF-8') ?> / 20</strong></td>
                        <td>
                            <a href="/copies/<?= htmlspecialchars((string)$copie->getId(), ENT_QUOTES, 'UTF-8') ?>" class="btn btn-secondary" style="padding: 0.35rem 0.75rem; font-size: 0.9rem;">
                                Voir détail
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once dirname(__DIR__) . '/layout/footer.php'; ?>
