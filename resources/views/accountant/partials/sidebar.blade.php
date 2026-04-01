<style>
    .admin-sidebar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                    0 2px 4px -1px rgba(0, 0, 0, 0.06);
        min-height: 100vh;
    top: 64px;
    left: 0;
    width: 250px;
    overflow-y: auto;
    z-index: 1000;
    }

    .sidebar-header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 1.25rem;
        margin: 1.5rem 1rem 1.5rem 1rem;
    }

    .sidebar-title {
        color: white;
        font-size: 1.25rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .admin-sidebar .nav-link {
        color: rgba(255, 255, 255, 0.85);
        transition: all 0.3s ease;
        margin: 0.5rem 1rem;
        font-weight: 500;
        border-left: 3px solid transparent;
        border-radius: 8px;
    }

    .admin-sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border-left-color: white;
        transform: translateX(5px);
    }

    .admin-sidebar .nav-link.active {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        border-left-color: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .admin-sidebar .nav-link i {
        width: 20px;
        text-align: center;
        opacity: 0.9;
        margin-right: 12px;
    }

    .nav-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.2);
        margin: 1rem 1.5rem;
    }
</style>

<nav class="admin-sidebar p-4 d-flex flex-column">
    <div class="sidebar-header">
        <h5 class="sidebar-title mb-0">
            <i class="fas fa-shield-alt me-2"></i> Accountant Panel
        </h5>
    </div>

    <ul class="nav nav-pills flex-column flex-grow-1">
        <li>
           <a href="{{ route('accountant.estimated.approved') }}" 
           class="flex items-center px-6 py-4 text-white hover:bg-blue-50 rounded-xl {{ request()->routeIs('accountant.estimated.approved') ? 'bg-blue-100 text-blue-700' : '' }}">
           <i class="fas fa-check-circle mr-4"></i>
        Approved Estimated Budgets
    </a>
</li>
    </ul>
</nav>