<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Système de notation universitaire', ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --danger: #dc2626;
            --success: #16a34a;
            --warning: #d97706;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-700: #374151;
            --gray-900: #111827;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: var(--gray-900);
            line-height: 1.6;
        }
        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid var(--gray-200);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--primary);
            text-decoration: none;
        }
        .nav-links a {
            margin-left: 1.5rem;
            color: var(--gray-700);
            text-decoration: none;
            font-weight: 500;
        }
        .nav-links a:hover { color: var(--primary); }
        .container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 1.5rem;
        }
        h1, h2 { margin-bottom: 1.25rem; color: var(--gray-900); }
        .form-group {
            margin-bottom: 1.25rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--gray-700);
        }
        input[type="number"], input[type="datetime-local"], input[type="text"] {
            width: 100%;
            padding: 0.65rem 0.75rem;
            border: 1px solid var(--gray-200);
            border-radius: 6px;
            font-size: 1rem;
        }
        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        }
        .btn {
            display: inline-block;
            padding: 0.65rem 1.25rem;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            font-size: 1rem;
        }
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        .btn-primary:hover { background-color: var(--primary-dark); }
        .btn-secondary {
            background-color: var(--gray-200);
            color: var(--gray-700);
        }
        .btn-secondary:hover { background-color: #cbd5e1; }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        .table th, .table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }
        .table th {
            background-color: var(--gray-100);
            font-weight: 600;
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .badge-danger { background-color: #fee2e2; color: var(--danger); }
        .badge-success { background-color: #dcfce7; color: var(--success); }
        .alert {
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
        }
        .alert-danger { background-color: #fee2e2; color: #991b1b; border: 1px solid #f87171; }
        .alert-success { background-color: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--gray-200);
        }
        .detail-label { font-weight: 600; color: var(--gray-700); }
        .actions { margin-top: 1.5rem; display: flex; gap: 1rem; }
    </style>
</head>
<body>
    <header class="navbar">
        <a href="/copies" class="navbar-brand">🎓 Système de Notation</a>
        <nav class="nav-links">
            <a href="/copies">Toutes les copies</a>
            <a href="/copies/create">Soumettre une copie</a>
        </nav>
    </header>
    <main class="container">
