<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HandymanPro')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --hp-primary: #f97316;
            --hp-primary-dark: #ea580c;
            --hp-primary-light: #ffedd5;
            --hp-secondary: #3b82f6;
            --hp-success: #22c55e;
            --hp-warning: #f59e0b;
            --hp-danger: #ef4444;
            --hp-dark: #1f2937;
            --hp-gray-100: #f3f4f6;
            --hp-gray-200: #e5e7eb;
            --hp-gray-500: #6b7280;
            --hp-gray-700: #374151;
            --hp-radius: 0.75rem;
            --hp-radius-lg: 1rem;
        }
        
        body { 
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; 
            background: #f8fafc; 
        }
        
        .btn-hp-primary {
            background: linear-gradient(135deg, var(--hp-primary) 0%, var(--hp-primary-dark) 100%);
            border: none; color: white; padding: 0.75rem 1.5rem;
            border-radius: var(--hp-radius); font-weight: 600;
            box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
            transition: all 0.3s ease;
        }
        .btn-hp-primary:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 8px 25px rgba(249, 115, 22, 0.4); 
            color: white; 
        }
        
        .btn-hp-secondary {
            background: white; border: 2px solid var(--hp-gray-200);
            color: var(--hp-gray-700); padding: 0.75rem 1.5rem;
            border-radius: var(--hp-radius); font-weight: 600;
        }
        .btn-hp-secondary:hover { 
            border-color: var(--hp-primary); 
            color: var(--hp-primary); 
        }
        
        .card-hp {
            background: white; border: 1px solid var(--hp-gray-200);
            border-radius: var(--hp-radius-lg); 
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .card-hp:hover { 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
        }
        
        .form-control-hp {
            border: 2px solid var(--hp-gray-200); border-radius: var(--hp-radius);
            padding: 0.875rem 1rem; transition: all 0.3s ease;
        }
        .form-control-hp:focus {
            border-color: var(--hp-primary);
            box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
        }
        
        .badge-hp-verified {
            background: #f0fdf4; color: var(--hp-success);
            border: 1px solid rgba(34, 197, 94, 0.2);
            padding: 0.5rem 1rem; border-radius: 50rem;
            font-weight: 600; font-size: 0.75rem;
        }
        
        .badge-hp-pending {
            background: #fffbeb; color: var(--hp-warning);
            border: 1px solid rgba(245, 158, 11, 0.2);
            padding: 0.5rem 1rem; border-radius: 50rem;
            font-weight: 600; font-size: 0.75rem;
        }
        
        .sidebar-hp {
            background: var(--hp-dark); min-height: 100vh;
            width: 260px; position: fixed; left: 0; top: 0; z-index: 1040;
        }
        .sidebar-hp .nav-link {
            color: var(--hp-gray-500); padding: 0.875rem 1.5rem;
            border-left: 3px solid transparent; transition: all 0.3s;
            display: flex; align-items: center; gap: 0.75rem;
        }
        .sidebar-hp .nav-link:hover, .sidebar-hp .nav-link.active {
            color: white; background: rgba(255,255,255,0.05);
            border-left-color: var(--hp-primary);
        }
        
        .main-content { margin-left: 260px; padding: 2rem; }
        
        .stat-card-hp {
            background: white; border-radius: var(--hp-radius-lg);
            padding: 1.5rem; border: 1px solid var(--hp-gray-200);
            position: relative; overflow: hidden;
        }
        .stat-card-hp::before {
            content: ''; position: absolute; top: 0; left: 0;
            width: 4px; height: 100%; background: var(--hp-primary);
        }
        
        .map-container-hp {
            width: 100%; height: 400px;
            border-radius: var(--hp-radius-lg);
            border: 2px solid var(--hp-gray-200);
        }
        
        .steps-hp {
            display: flex; justify-content: space-between;
            position: relative; margin-bottom: 2rem;
        }
        .steps-hp::before {
            content: ''; position: absolute; top: 20px; left: 0; right: 0;
            height: 2px; background: var(--hp-gray-200); z-index: 0;
        }
        .step-hp { 
            display: flex; flex-direction: column; 
            align-items: center; position: relative; z-index: 1; 
        }
        .step-hp .step-circle {
            width: 42px; height: 42px; border-radius: 50%;
            background: white; border: 3px solid var(--hp-gray-300);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: var(--hp-gray-400);
        }
        .step-hp.active .step-circle {
            border-color: var(--hp-primary); background: var(--hp-primary);
            color: white; box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.2);
        }
        .step-hp.completed .step-circle {
            border-color: var(--hp-success); background: var(--hp-success); color: white;
        }
        
        .upload-zone {
            border: 2px dashed var(--hp-gray-300); border-radius: var(--hp-radius-lg);
            padding: 2rem; text-align: center; transition: all 0.3s;
            cursor: pointer; background: var(--hp-gray-100);
        }
        .upload-zone:hover, .upload-zone.dragover {
            border-color: var(--hp-primary); background: var(--hp-primary-light);
        }
        
        @media (max-width: 991.98px) {
            .sidebar-hp { transform: translateX(-100%); }
            .sidebar-hp.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    @yield('content')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>