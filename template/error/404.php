<?php
$title = "Page introuvable — Erreur 404";
require_once dirname(__DIR__) . '/layout/header.php';
?>

<div style="max-width: 540px; margin: 3rem auto; text-align: center;">
    <div class="card" style="padding: 3.5rem 2rem;">
        <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--danger-50); color: var(--danger); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
        </div>
        <h1 style="font-size: 2.5rem; font-weight: 900; color: var(--slate-900); margin-bottom: 0.5rem; letter-spacing: -0.04em;">404</h1>
        <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--slate-700); margin-bottom: 1rem;">Page introuvable</h2>
        <p style="color: var(--slate-500); font-size: 0.95rem; margin-bottom: 2rem; line-height: 1.6;">
            <?= htmlspecialchars($message ?? "La page ou la ressource que vous recherchez n'existe pas ou a été déplacée.", ENT_QUOTES, 'UTF-8') ?>
        </p>
        <a href="/copies" class="btn btn-primary" style="padding: 0.75rem 1.75rem;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            Retour au tableau de bord
        </a>
    </div>
</div>

<?php require_once dirname(__DIR__) . '/layout/footer.php'; ?>
