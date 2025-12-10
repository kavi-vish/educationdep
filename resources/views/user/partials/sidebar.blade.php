<!-- resources/views/layouts/partials/user-sidebar.blade.php or wherever you keep it -->

<nav class="bg-white shadow-sm h-100 p-3 d-flex flex-column">
    <div class="mb-4">
        <h5 class="text-primary fw-bold">
            <i class="fas fa-user-circle me-2"></i> User Panel
        </h5>
    </div>

    <ul class="nav nav-pills flex-column gap-1">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" 
               class="nav-link d-flex align-items-center p-2 rounded {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'hover-bg-gray-100' }}">
                <i class="fa fa-home me-3"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('user.estimated-budget.create') }}" 
               class="nav-link d-flex align-items-center p-2 rounded {{ request()->routeIs('user.estimated-budget.*') && !request()->routeIs('user.estimated-budget.my-list') ? 'bg-primary text-white' : 'hover-bg-gray-100' }}">
                <i class="fa fa-file-invoice-dollar me-3"></i> Create Estimated Budget
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('user.estimated-budget.my-list') }}" 
               class="nav-link d-flex align-items-center p-2 rounded {{ request()->routeIs('user.estimated-budget.my-list') ? 'bg-primary text-white' : 'hover-bg-gray-100' }}">
                <i class="fa fa-list-alt me-3"></i> My Budgets
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link d-flex align-items-center p-2 rounded hover-bg-gray-100">
                <i class="fa fa-receipt me-3"></i> Submit Actual Expenses
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link d-flex align-items-center p-2 rounded hover-bg-gray-100">
                <i class="fa fa-chart-bar me-3"></i> Reports
            </a>
        </li>
    </ul>
</nav>