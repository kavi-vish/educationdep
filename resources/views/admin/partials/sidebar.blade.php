<div class="w-64 h-screen bg-gray-100 border-r">
    <div class="p-4 text-lg font-semibold border-b">
        Admin Panel
    </div>
    <ul class="mt-4 space-y-2">
        <li>
            <a href="{{ route('admin.projects.index') }}" 
            class="flex items-center p-3 rounded-lg transition-colors
                      {{ request()->is('admin/projects*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-200 text-gray-700' }}">
                <i class="fa fa-calendar-alt mr-2"></i> Annual Budget
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center p-2 rounded-lg transition-colors
                      {{ request()->is('admin/users*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-200 text-gray-700' }}">
                <i class="fa fa-users mr-2"></i> User Management
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center p-2 hover:bg-gray-200">
                <i class="fa fa-file-alt mr-2"></i> Proposal Management
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center p-2 hover:bg-gray-200">
                <i class="fa fa-money-bill-wave mr-2"></i> Expense Management
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center p-2 hover:bg-gray-200">
                <i class="fa fa-chart-bar mr-2"></i> Reports
            </a>
        </li>
    </ul>
</div>
