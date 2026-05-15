@extends('admin.admin_master')

@section('admin')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                    <span>📋</span>
                    <span>Activity Logs</span>
                </h2>
                <p class="text-sm text-gray-500 mt-1">Track all system activities and user actions for security and compliance</p>
            </div>
            <div class="text-right">
                <div class="inline-block bg-emerald-100 text-emerald-800 px-4 py-2 rounded-lg font-medium">
                    Total Logs: <span class="font-bold">{{ $logs->total() }}</span>
                </div>
            </div>
        </div>

        <!-- Search Form -->
        <div class="mb-6 flex gap-2 items-center">
            <form action="{{ route('admin.logs.index') }}" method="GET" class="flex gap-2 flex-1">
                <div class="relative flex-1">
                    <svg class="absolute left-3 top-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Search by user, action, or description..."
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                    >
                </div>
                <button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Search
                    </span>
                </button>
                @if($search)
                    <a href="{{ route('admin.logs.index') }}" class="px-6 py-2.5 bg-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <!-- Logs Table -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="overflow-x-auto min-w-full w-full block whitespace-nowrap">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($logs as $log)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                                <span class="text-emerald-600 text-xs font-bold">{{ substr($log->user->name ?? 'Unknown', 0, 1) }}</span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">{{ $log->user->name ?? 'Unknown' }}</div>
                                                <div class="text-xs text-gray-500">{{ $log->user->email ?? '' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
    @php
        // Define settings based on the action string
        $action = $log->action ?? '';

        if (str_contains($action, 'Approved')) {
            $class = 'bg-green-100 text-green-800';
            $icon = '✓';
        } elseif (str_contains($action, 'Denied')) {
            $class = 'bg-red-100 text-red-800';
            $icon = '✕';
        } elseif (str_contains($action, 'Deleted')) {
            $class = 'bg-red-100 text-red-800';
            $icon = '🗑';
        } elseif (str_contains($action, 'Updated')) {
            $class = 'bg-blue-100 text-blue-800';
            $icon = '🔄';
        } else {
            $class = 'bg-purple-100 text-purple-800';
            $icon = '📝';
        }
    @endphp

    <span class="px-3 py-1 inline-flex items-center gap-1 text-xs leading-5 font-semibold rounded-full {{ $class }}">
        <span>{{ $icon }}</span>
        <span>{{ $action }}</span>
    </span>
</td>

                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $log->description }}">
                                            {{ $log->description ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $log->ip_address ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">
                                            {{ $log->created_at->format('M d, Y h:i A') }}
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            {{ $log->created_at->diffForHumans() }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No activity logs found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
