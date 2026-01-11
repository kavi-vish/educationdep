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
            <i class="fas fa-shield-alt me-2"></i> Admin Panel
        </h5>
    </div>

    <ul class="nav nav-pills flex-column flex-grow-1">
        <li class="nav-item">
            <a href="{{ route('admin.projects.index') }}" 
               class="nav-link d-flex align-items-center p-3 rounded {{ request()->is('admin/projects*') ? 'active' : '' }}">
                <i class="fa fa-calendar-alt"></i>
                <span>Annual Budget</span>
            </a>
        </li>

        <div class="nav-divider"></div>

        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}"
               class="nav-link d-flex align-items-center p-3 rounded {{ request()->is('admin/users*') ? 'active' : '' }}">
                <i class="fa fa-users"></i>
                <span>User Management</span>
            </a>
        </li>

        <div class="nav-divider"></div>

        <li class="nav-item">
            <a href="{{ route('admin.estimated.list') }}"
               class="nav-link d-flex align-items-center p-3 rounded {{ request()->is('admin/estimated*') ? 'active' : '' }}">
                <i class="fa fa-file-alt"></i>
                <span>Estimated Proposal Management</span>
            </a>
        </li>

        <div class="nav-divider"></div>

        <li class="nav-item">
            <a href="{{ route('admin.actual.list') }}"
               class="nav-link d-flex align-items-center p-3 rounded {{ request()->is('admin/actual*') ? 'active' : '' }}">
                <i class="fa fa-file-alt"></i>
                <span>Actual Proposal Management</span>
            </a>
        </li>

        <div class="nav-divider"></div>

        <li class="nav-item">
            <a href="{{ route('admin.votes.index') }}"
               class="nav-link d-flex align-items-center p-3 rounded {{ request()->is('admin/funds*') ? 'active' : '' }}">
                <i class="fa fa-file-alt"></i>
                <span>Votes Fund Management</span>
            </a>
        </li>

        <div class="nav-divider"></div>

        <li class="nav-item">
            <a href="#" 
               class="nav-link d-flex align-items-center p-3 rounded">
                <i class="fa fa-chart-bar"></i>
                <span>Reports</span>
            </a>
        </li>
    </ul>
</nav>