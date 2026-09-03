<?php
$title = "Soumettre une copie d'examen";
require_once dirname(__DIR__) . '/layout/header.php';
?>

<div class="card">
    <h1>Soumettre une copie d'examen</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul style="margin-left: 1.25rem;">
                <?php foreach ((array)$errors as $err): ?>
                    <li><?= htmlspecialchars($err, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/copies" method="POST">
        <div class="form-group">
            <label for="note_brute">Note brute (sur 20) :</label>
            <input type="number" step="0.25" min="0" max="20" id="note_brute" name="note_brute"
                   value="<?= htmlspecialchars((string)($old['note_brute'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="form-group">
            <label for="date_depot">Date et heure de dépôt :</label>
            <input type="datetime-local" id="date_depot" name="date_depot"
                   value="<?= htmlspecialchars((string)($old['date_depot'] ?? date('Y-m-d\TH:i')), ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="form-group">
            <label for="date_limite">Date et heure limite :</label>
            <input type="datetime-local" id="date_limite" name="date_limite"
                   value="<?= htmlspecialchars((string)($old['date_limite'] ?? date('Y-m-d\TH:i')), ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Soumettre la copie</button>
            <a href="/copies" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<?php require_once dirname(__DIR__) . '/layout/footer.php'; ?>
