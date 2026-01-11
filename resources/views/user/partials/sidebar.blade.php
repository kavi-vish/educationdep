<style>
.sidebar-nav {
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
        margin-bottom: 1.5rem;
    }
    
    .sidebar-title {
        color: white;
        font-size: 1.25rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .sidebar-nav .nav-link {
        color: rgba(255, 255, 255, 0.85);
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
        font-weight: 500;
        border-left: 3px solid transparent;
    }
    
    .sidebar-nav .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border-left-color: white;
        transform: translateX(5px);
    }
    
    .sidebar-nav .nav-link.active {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        border-left-color: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .sidebar-nav .nav-link i {
        width: 20px;
        text-align: center;
        opacity: 0.9;
    }
    
    .nav-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.2);
        margin: 1rem 0;
    }
</style>

<nav class="sidebar-nav h-100 p-4 d-flex flex-column">
    <div class="sidebar-header">
        <h5 class="sidebar-title mb-0">
            <i class="fas fa-user-circle me-2"></i> User Panel
        </h5>
    </div>

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" 
               class="nav-link d-flex align-items-center p-3 rounded {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa fa-home me-3"></i> Dashboard
            </a>
        </li>

        <div class="nav-divider"></div>

        <li class="nav-item">
            <a href="{{ route('user.estimated-budget.create') }}" 
               class="nav-link d-flex align-items-center p-3 rounded {{ request()->routeIs('user.estimated-budget.create')  ? 'active' : '' }}">
                <i class="fa fa-file-invoice-dollar me-3"></i> Create Estimated Budget
            </a>
        </li>
        <div class="nav-divider"></div>
        <li class="nav-item">
            <a href="{{ route('user.estimated-budget.my-list') }}" 
               class="nav-link d-flex align-items-center p-3 rounded {{ request()->routeIs('user.estimated-budget.my-list') ? 'active' : '' }}">
                <i class="fa fa-list-alt me-3"></i> Estimated Budgets List
            </a>
        </li>

        <div class="nav-divider"></div>

        <li class="nav-item">
            <a href="{{ route('user.actual-budget.create') }}" 
               class="nav-link d-flex align-items-center p-3 rounded {{ request()->routeIs('user.actual-budget.create') ? 'active' : '' }}">
                <i class="fa fa-receipt me-3"></i> Submit Actual Expenses
            </a>
        </li>
            <div class="nav-divider"></div>
        <li class="nav-item">
            <a href="{{ route('user.actual-budget.my-list') }}" 
               class="nav-link d-flex align-items-center p-3 rounded {{ request()->routeIs('user.actual-budget.my-list') ? 'active' : '' }}">
                <i class="fa fa-receipt me-3"></i> Actual Expenses List
            </a>
        </li>

        <div class="nav-divider"></div>

        <li class="nav-item">
            <a href="#" 
               class="nav-link d-flex align-items-center p-3 rounded {{ request()->routeIs('user.reports.*') ? 'active' : '' }}">
                <i class="fa fa-chart-bar me-3"></i> Reports
            </a>
        </li>
    </ul>
</nav>