<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Système de notation universitaire', ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #6366f1;
            --primary-dark: #4338ca;
            --primary-50: #eef2ff;
            --success: #10b981;
            --success-50: #ecfdf5;
            --danger: #ef4444;
            --danger-50: #fef2f2;
            --warning: #f59e0b;
            --warning-50: #fffbeb;
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-300: #cbd5e1;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-600: #475569;
            --slate-700: #334155;
            --slate-800: #1e293b;
            --slate-900: #0f172a;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.07), 0 2px 4px -2px rgb(0 0 0 / 0.07);
            --shadow-md: 0 10px 15px -3px rgb(0 0 0 / 0.08), 0 4px 6px -4px rgb(0 0 0 / 0.04);
            --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.05);
            --radius-lg: 16px;
            --radius-md: 10px;
            --radius-sm: 6px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f8fafc;
            color: var(--slate-800);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navigation Bar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--slate-200);
            position: sticky;
            top: 0;
            z-index: 50;
            padding: 0.875rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--slate-900);
            font-weight: 800;
            font-size: 1.2rem;
            letter-spacing: -0.02em;
        }

        .brand-icon {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .nav-link {
            color: var(--slate-600);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.925rem;
            padding: 0.5rem 0.875rem;
            border-radius: var(--radius-sm);
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: var(--primary);
            background-color: var(--primary-50);
        }

        .btn-nav-action {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            text-decoration: none;
            padding: 0.55rem 1.1rem;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.25);
            transition: all 0.2s ease;
        }

        .btn-nav-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
        }

        /* Container */
        .main-content {
            flex: 1;
            max-width: 1080px;
            width: 100%;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        /* Hero / Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--slate-900);
            letter-spacing: -0.03em;
        }

        .page-subtitle {
            color: var(--slate-500);
            font-size: 0.95rem;
            margin-top: 0.25rem;
        }

        /* Cards */
        .card {
            background: #ffffff;
            border-radius: var(--radius-lg);
            border: 1px solid var(--slate-200);
            box-shadow: var(--shadow-sm);
            padding: 1.75rem;
            margin-bottom: 1.75rem;
        }

        /* KPI / Stat Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: #ffffff;
            border-radius: var(--radius-md);
            border: 1px solid var(--slate-200);
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: var(--shadow-sm);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .stat-icon.primary { background-color: var(--primary-50); color: var(--primary); }
        .stat-icon.success { background-color: var(--success-50); color: var(--success); }
        .stat-icon.danger { background-color: var(--danger-50); color: var(--danger); }
        .stat-icon.warning { background-color: var(--warning-50); color: var(--warning); }

        .stat-label {
            font-size: 0.825rem;
            font-weight: 600;
            color: var(--slate-500);
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .stat-value {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--slate-900);
            line-height: 1.2;
        }

        /* Tables */
        .table-responsive {
            overflow-x: auto;
            border-radius: var(--radius-md);
            border: 1px solid var(--slate-200);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.925rem;
        }

        .table th {
            background-color: var(--slate-50);
            color: var(--slate-600);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.06em;
            padding: 0.9rem 1.25rem;
            border-bottom: 1px solid var(--slate-200);
        }

        .table td {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--slate-200);
            color: var(--slate-700);
            vertical-align: middle;
        }

        .table tbody tr {
            transition: background-color 0.15s ease;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.3rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.01em;
        }

        .badge-success {
            background-color: var(--success-50);
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .badge-danger {
            background-color: var(--danger-50);
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .badge-primary {
            background-color: var(--primary-50);
            color: var(--primary-dark);
            border: 1px solid #c7d2fe;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.65rem 1.25rem;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.925rem;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            box-shadow: 0 2px 6px rgba(79, 70, 229, 0.25);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);
        }

        .btn-secondary {
            background-color: white;
            color: var(--slate-700);
            border: 1px solid var(--slate-300);
            box-shadow: var(--shadow-sm);
        }

        .btn-secondary:hover {
            background-color: var(--slate-50);
            border-color: var(--slate-400);
            color: var(--slate-900);
        }

        .btn-sm {
            padding: 0.4rem 0.75rem;
            font-size: 0.825rem;
            border-radius: var(--radius-sm);
        }

        /* Forms */
        .form-card {
            max-width: 650px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 0.925rem;
            color: var(--slate-700);
        }

        .form-hint {
            font-size: 0.8rem;
            color: var(--slate-500);
            margin-top: 0.35rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--slate-300);
            border-radius: var(--radius-md);
            font-size: 0.95rem;
            font-family: inherit;
            color: var(--slate-900);
            background-color: #ffffff;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
        }

        /* Alerts */
        .alert {
            display: flex;
            gap: 0.875rem;
            padding: 1rem 1.25rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.75rem;
            font-size: 0.925rem;
        }

        .alert-danger {
            background-color: var(--danger-50);
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-success {
            background-color: var(--success-50);
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        /* Footer */
        .footer {
            background: #ffffff;
            border-top: 1px solid var(--slate-200);
            padding: 1.5rem 2rem;
            text-align: center;
            font-size: 0.85rem;
            color: var(--slate-500);
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <a href="/copies" class="navbar-brand">
            <div class="brand-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                </svg>
            </div>
            <span>UnivGrade</span>
        </a>
        <nav class="nav-links">
            <a href="/copies" class="nav-link">Toutes les copies</a>
            <a href="/copies/create" class="btn-nav-action">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Nouvelle copie
            </a>
        </nav>
    </header>
    <main class="main-content">
