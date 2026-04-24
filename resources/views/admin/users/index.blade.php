@extends('admin.admin_master')

@section('admin')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                    <span>👥</span>
                    <span>User Management</span>
                </h2>
                <p class="text-sm text-gray-500 mt-1">Manage user accounts, roles, approvals, and access permissions</p>
            </div>
            <div class="text-right">
                <div class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-medium">
                    Total Users: <span class="font-bold">{{ count($users) }}</span>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Users Table -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center">
                                                <span class="text-emerald-600 font-bold">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->status === 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @elseif($user->status === 'approved')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Approved
                                            </span>
                                        @elseif($user->status === 'denied')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Denied
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ $user->getRoleDisplayName() }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            <!-- Approve Button with Dropdown -->
                                            @if($user->status === 'pending')
                                                <div class="relative group">
                                                    <button type="button" class="approve-btn inline-flex items-center gap-1 px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors" data-user-id="{{ $user->id }}">
                                                        <span>✓</span>
                                                        <span>Approve</span>
                                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                                                    </button>
                                                    <!-- Dropdown Menu -->
                                                    <div id="approve-dropdown-{{ $user->id }}" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 z-50 overflow-hidden">
                                                        <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="p-4">
                                                            @csrf
                                                            <label class="block text-xs font-bold text-gray-700 mb-3 uppercase tracking-wide">Select Role to Assign:</label>
                                                            <select name="role" class="block w-full text-sm px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent mb-3" required>
                                                                <option value="">-- Choose a role --</option>
                                                                <option value="doctor">👨‍⚕️ Doctor</option>
                                                                <option value="nurse">👩‍⚕️ Nurse</option>
                                                                <option value="midwife">🤰 Midwife</option>
                                                                <option value="encoder">💻 Encoder</option>
                                                            </select>
                                                            <button type="submit" class="w-full inline-flex justify-center items-center gap-2 px-3 py-2 border border-transparent text-xs font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 transition-colors">
                                                                <span>✓</span>
                                                                <span>Confirm Approval</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>

                                                <!-- Deny Button -->
                                                <form action="{{ route('admin.users.deny', $user->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors" onclick="return confirm('Are you sure you want to deny this user?')">
                                                        <span>✕</span>
                                                        <span>Deny</span>
                                                    </button>
                                                </form>
                                            @endif

                                            <!-- Update Role Button -->
                                            @if($user->status === 'approved')
                                                <div class="relative group">
                                                    <button type="button" class="role-btn inline-flex items-center gap-1 px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors" data-user-id="{{ $user->id }}">
                                                        <span>🔄</span>
                                                        <span>Update Role</span>
                                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                                                    </button>
                                                    <!-- Role Dropdown Menu -->
                                                    <div id="role-dropdown-{{ $user->id }}" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 z-50 overflow-hidden">
                                                        <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" class="p-4">
                                                            @csrf
                                                            @method('PUT')
                                                            <label class="block text-xs font-bold text-gray-700 mb-3 uppercase tracking-wide">Change Role:</label>
                                                            <select name="role" class="block w-full text-sm px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent mb-3" required>
                                                                <option value="">-- Select role --</option>
                                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>👑 Administrator</option>
                                                                <option value="doctor" {{ $user->role === 'doctor' ? 'selected' : '' }}>👨‍⚕️ Doctor</option>
                                                                <option value="nurse" {{ $user->role === 'nurse' ? 'selected' : '' }}>👩‍⚕️ Nurse</option>
                                                                <option value="midwife" {{ $user->role === 'midwife' ? 'selected' : '' }}>🤰 Midwife</option>
                                                                <option value="encoder" {{ $user->role === 'encoder' ? 'selected' : '' }}>💻 Encoder</option>
                                                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>👤 Patient</option>
                                                            </select>
                                                            <button type="submit" class="w-full inline-flex justify-center items-center gap-2 px-3 py-2 border border-transparent text-xs font-medium rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 transition-colors">
                                                                <span>✓</span>
                                                                <span>Update Role</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Edit Role Button (for all users) -->
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 border border-blue-300 text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                <span>Edit</span>
                                            </a>

                                            <!-- Delete Button -->
                                            @if(Auth::id() !== $user->id)
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors" onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                                        <span>🗑</span>
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Handle Approve dropdowns
    document.querySelectorAll('.approve-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const userId = this.getAttribute('data-user-id');
            const dropdown = document.getElementById('approve-dropdown-' + userId);

            // Hide all other dropdowns
            document.querySelectorAll('[id^="approve-dropdown-"]').forEach(d => {
                if (d.id !== 'approve-dropdown-' + userId) d.classList.add('hidden');
            });
            document.querySelectorAll('[id^="role-dropdown-"]').forEach(d => d.classList.add('hidden'));

            dropdown.classList.toggle('hidden');
        });
    });

    // Handle Role Update dropdowns
    document.querySelectorAll('.role-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const userId = this.getAttribute('data-user-id');
            const dropdown = document.getElementById('role-dropdown-' + userId);

            // Hide all other dropdowns
            document.querySelectorAll('[id^="role-dropdown-"]').forEach(d => {
                if (d.id !== 'role-dropdown-' + userId) d.classList.add('hidden');
            });
            document.querySelectorAll('[id^="approve-dropdown-"]').forEach(d => d.classList.add('hidden'));

            dropdown.classList.toggle('hidden');
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function() {
        document.querySelectorAll('[id^="approve-dropdown-"], [id^="role-dropdown-"]').forEach(d => {
            d.classList.add('hidden');
        });
    });
</script>
@endpush
@endsection
