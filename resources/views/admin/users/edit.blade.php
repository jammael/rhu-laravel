@extends('admin.admin_master')

@section('admin')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                <span>Edit User Role</span>
            </h2>
            <p class="text-sm text-gray-500 mt-2">Change the role for {{ $user->name }}</p>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- User Information -->
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- User Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">User Name</label>
                            <div class="px-4 py-3 bg-gray-50 rounded-lg border border-gray-200">
                                <p class="text-gray-900 font-medium">{{ $user->name }}</p>
                            </div>
                        </div>

                        <!-- User Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <div class="px-4 py-3 bg-gray-50 rounded-lg border border-gray-200">
                                <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                            </div>
                        </div>

                        <!-- User Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Account Status</label>
                            <div class="px-4 py-3 bg-gray-50 rounded-lg border border-gray-200">
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
                            </div>
                        </div>

                        <!-- Current Role -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Role</label>
                            <div class="px-4 py-3 bg-gray-50 rounded-lg border border-gray-200">
                                <p class="text-gray-900 font-medium">{{ $user->getRoleDisplayName() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Role Selection Form -->
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Role Dropdown -->
                    <div class="mb-6">
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-3">
                            Select New Role
                        </label>
                        <select name="role" id="role" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" required>
                            <option value="">-- Choose a role --</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                👑 Administrator - Full system access and control
                            </option>
                            <option value="doctor" {{ $user->role === 'doctor' ? 'selected' : '' }}>
                                👨‍⚕️ Doctor - Medical professional access
                            </option>
                            <option value="nurse" {{ $user->role === 'nurse' ? 'selected' : '' }}>
                                👩‍⚕️ Nurse - Healthcare worker access
                            </option>
                            <option value="midwife" {{ $user->role === 'midwife' ? 'selected' : '' }}>
                                🤰 Midwife - Maternal care specialist access
                            </option>
                            <option value="encoder" {{ $user->role === 'encoder' ? 'selected' : '' }}>
                                💻 Encoder - Data entry access
                            </option>
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                👤 Patient - Patient access only
                            </option>
                        </select>
                        @error('role')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between gap-4">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 px-6 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            <span>Cancel</span>
                        </a>

                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Update Role</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Box -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex gap-3">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-sm text-blue-800">
                        <strong>Note:</strong> Changing a user's role will update their access permissions and system capabilities immediately. This action is logged in the Activity Log.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
