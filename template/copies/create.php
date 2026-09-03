<?php
$title = "Nouvelle soumission — Système de notation";
require_once dirname(__DIR__) . '/layout/header.php';
?>

<div style="max-width: 680px; margin: 0 auto;">
    <div style="margin-bottom: 1.5rem;">
        <a href="/copies" style="display: inline-flex; align-items: center; gap: 0.4rem; color: var(--slate-500); text-decoration: none; font-size: 0.9rem; font-weight: 600;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
            Retour aux copies
        </a>
    </div>

    <div class="card">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; padding-bottom: 1.25rem; border-bottom: 1px solid var(--slate-200);">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: var(--primary-50); color: var(--primary); display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
            </div>
            <div>
                <h1 style="font-size: 1.4rem; font-weight: 800; color: var(--slate-900); margin: 0;">Soumettre une copie</h1>
                <p class="page-subtitle" style="margin-top: 0.15rem;">Saisissez les données d'examen pour le calcul automatique de la note</p>
            </div>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 0.15rem;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <div style="flex: 1;">
                    <strong style="display: block; margin-bottom: 0.25rem;">Erreur de validation :</strong>
                    <ul style="margin-left: 1.2rem;">
                        <?php foreach ((array)$errors as $err): ?>
                            <li><?= htmlspecialchars($err, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <!-- Info box règlement -->
        <div style="background: var(--slate-50); border: 1px solid var(--slate-200); border-radius: var(--radius-md); padding: 1rem 1.25rem; margin-bottom: 1.75rem; display: flex; gap: 0.75rem; align-items: flex-start;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 0.15rem;">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            <div style="font-size: 0.85rem; color: var(--slate-600); line-height: 1.5;">
                <strong style="color: var(--slate-800);">Règlement universitaire :</strong> La note brute doit être comprise entre 0 et 20. Si la date de dépôt est postérieure à la date limite, une pénalité forfaitaire de <strong>2 points</strong> est déduite (la note finale ne peut être inférieure à 0).
            </div>
        </div>

        <form action="/copies" method="POST">
            <div class="form-group">
                <label class="form-label" for="note_brute">Note brute attribuée (/20) :</label>
                <input type="number" step="0.25" min="0" max="20" id="note_brute" name="note_brute"
                       class="form-control"
                       placeholder="Ex: 15.50"
                       value="<?= htmlspecialchars((string)($old['note_brute'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                <p class="form-hint">Doit être comprise strictement entre 0 et 20.</p>
            </div>

            <div class="form-group">
                <label class="form-label" for="date_depot">Date et heure de dépôt de la copie :</label>
                <input type="datetime-local" id="date_depot" name="date_depot"
                       class="form-control"
                       value="<?= htmlspecialchars((string)($old['date_depot'] ?? date('Y-m-d\TH:i')), ENT_QUOTES, 'UTF-8') ?>" required>
                <p class="form-hint">Date et heure à laquelle l'étudiant a remis le document.</p>
            </div>

            <div class="form-group">
                <label class="form-label" for="date_limite">Date et heure limite autorisée :</label>
                <input type="datetime-local" id="date_limite" name="date_limite"
                       class="form-control"
                       value="<?= htmlspecialchars((string)($old['date_limite'] ?? date('Y-m-d\TH:i')), ENT_QUOTES, 'UTF-8') ?>" required>
                <p class="form-hint">Délai d'expiration fixé par le sujet d'examen.</p>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem; padding-top: 1.25rem; border-top: 1px solid var(--slate-200);">
                <a href="/copies" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    Enregistrer la copie
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once dirname(__DIR__) . '/layout/footer.php'; ?>
