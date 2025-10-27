<x-layout-dashboard title="Messages History">
    <div class="app-content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Header Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div
                                            class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                            <i class="bi bi-chat-left-text text-blue-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h1 class="text-2xl font-bold text-gray-900">Messages History</h1>
                                            <p class="text-sm text-gray-600">View and manage your message history</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500">Total Messages</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $messages->total() }}</p>
                                        </div>
                                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                            <i class="bi bi-envelope text-green-600 text-xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="px-6 py-4">
                                <div class="flex flex-wrap items-center gap-3">
                                    <button onclick="clearAll()" type="button"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                                        <i class="bi bi-trash mr-2"></i>
                                        Clear All Messages
                                    </button>

                                    <button type="button"
                                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                        <i class="bi bi-download mr-2"></i>
                                        Export Data
                                    </button>

                                    <button type="button"
                                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                        <i class="bi bi-funnel mr-2"></i>
                                        Filter Messages
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alert Messages -->
                <div class="row mb-4">
                    <div class="col-12">
                        @if (session()->has('alert'))
                            <x-alert>
                                @slot('type', session('alert')['type'])
                                @slot('msg', session('alert')['msg'])
                            </x-alert>
                        @endif
                    </div>
                </div>

                <!-- Messages Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                            <!-- Table Header -->
                            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <h3 class="text-lg font-semibold text-gray-900">Message History</h3>
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="bi bi-clock mr-1"></i>
                                                Real-time
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors"
                                            title="Refresh">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                        <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors"
                                            title="Settings">
                                            <i class="bi bi-gear"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Table Content -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                ID</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Sender</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Number</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Message</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Via</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Last Updated</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @if ($messages->total() == 0)
                                            <tr>
                                                <td colspan="8" class="px-6 py-12 text-center">
                                                    <div class="flex flex-col items-center">
                                                        <div
                                                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                            <i class="bi bi-chat-left-text text-2xl text-gray-400"></i>
                                                        </div>
                                                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Messages
                                                            Found</h3>
                                                        <p class="text-gray-500">No message history available at the
                                                            moment</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($messages as $msg)
                                                <tr class="hover:bg-gray-50 transition-colors">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        #{{ $msg->id }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div
                                                                class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                                <i class="bi bi-whatsapp text-blue-600 text-sm"></i>
                                                            </div>
                                                            <div>
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ $msg->device->body ?? 'NA/Deleted' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        {{ $msg->number }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="text-sm text-gray-900">
                                                            <span
                                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2">
                                                                {{ $msg->type }}
                                                            </span>
                                                            {{ substr($msg->message, 0, 30) }}
                                                            @if (strlen($msg->message) > 30)
                                                                <span class="text-gray-500">...</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if ($msg->status == 'success')
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                <i class="bi bi-check-circle mr-1"></i>
                                                                Sent
                                                            </span>
                                                        @else
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                <i class="bi bi-x-circle mr-1"></i>
                                                                Failed
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if ($msg->send_by == 'web')
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                <i class="bi bi-globe mr-1"></i>
                                                                Web
                                                            </span>
                                                        @else
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                                <i class="bi bi-code-slash mr-1"></i>
                                                                API
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ date('d M Y, H:i', strtotime($msg->updated_at)) }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <button
                                                            onclick="resend({{ $msg->id }}, '{{ $msg->status }}')"
                                                            class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 transition-colors {{ $msg->status == 'success' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                            {{ $msg->status == 'success' ? 'disabled' : '' }}>
                                                            <i class="bi bi-arrow-clockwise mr-1"></i>
                                                            Resend
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            @if ($messages->hasPages())
                                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                                    <nav class="flex items-center justify-between">
                                        <div class="flex items-center text-sm text-gray-700">
                                            <span>Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }}
                                                of {{ $messages->total() }} results</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            @if ($messages->previousPageUrl())
                                                <a href="{{ $messages->previousPageUrl() }}"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700 transition-colors">
                                                    <i class="bi bi-chevron-left mr-1"></i>
                                                    Previous
                                                </a>
                                            @endif

                                            @for ($i = max(1, $messages->currentPage() - 2); $i <= min($messages->lastPage(), $messages->currentPage() + 2); $i++)
                                                <a href="{{ $messages->url($i) }}"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium {{ $messages->currentPage() == $i ? 'bg-blue-600 text-white' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 hover:text-gray-700' }} rounded-lg transition-colors">
                                                    {{ $i }}
                                                </a>
                                            @endfor

                                            @if ($messages->nextPageUrl())
                                                <a href="{{ $messages->nextPageUrl() }}"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700 transition-colors">
                                                    Next
                                                    <i class="bi bi-chevron-right ml-1"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </nav>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout-dashboard>
<script>
    function clearAll() {
        if (!confirm('Are you sure you want to clear all messages? This action cannot be undone.')) {
            showNotification('Operation cancelled', 'error');
            return;
        }

        // Show loading state
        const button = event.target;
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="bi bi-hourglass-split mr-2"></i>Clearing...';
        button.disabled = true;

        $.ajax({
            url: `/messages/clear`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            dataType: 'json',
            success: (result) => {
                showNotification('All messages cleared successfully', 'success');
                setTimeout(() => {
                    location.reload();
                }, 1500);
            },
            error: (error) => {
                showNotification('Failed to clear messages. Please try again.', 'error');
                // Restore button state
                button.innerHTML = originalText;
                button.disabled = false;
            }
        });
    }

    function resend(id, status) {
        if (status == 'success') {
            showNotification('Message already sent successfully', 'info');
            return;
        }

        // Show loading state
        const button = event.target;
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="bi bi-hourglass-split mr-1"></i>Sending...';
        button.disabled = true;

        $.ajax({
            url: '/resend-message',
            type: 'POST',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                if (res.error) {
                    showNotification(res.msg, 'error');
                } else {
                    showNotification(res.msg, 'success');
                    // Reload page after 2 seconds to show updated status
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                }
            },
            error: function(err) {
                showNotification('Something went wrong. Please try again.', 'error');
            },
            complete: function() {
                // Restore button state
                button.innerHTML = originalText;
                button.disabled = false;
            }
        });
    }

    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className =
            `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transform transition-all duration-300 translate-x-full`;

        // Set colors based on type
        switch (type) {
            case 'success':
                notification.className += ' bg-green-500 text-white';
                notification.innerHTML = `
                        <div class="flex items-center">
                            <i class="bi bi-check-circle mr-2"></i>
                            <span>${message}</span>
                        </div>
                    `;
                break;
            case 'error':
                notification.className += ' bg-red-500 text-white';
                notification.innerHTML = `
                        <div class="flex items-center">
                            <i class="bi bi-x-circle mr-2"></i>
                            <span>${message}</span>
                        </div>
                    `;
                break;
            case 'info':
                notification.className += ' bg-blue-500 text-white';
                notification.innerHTML = `
                        <div class="flex items-center">
                            <i class="bi bi-info-circle mr-2"></i>
                            <span>${message}</span>
                        </div>
                    `;
                break;
        }

        // Add to page
        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);

        // Remove after 4 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 4000);
    }

    // Auto-refresh functionality
    let autoRefreshInterval;

    function startAutoRefresh() {
        autoRefreshInterval = setInterval(() => {
            // Only refresh if no modal is open and user is on this page
            if (!document.querySelector('.modal.show') && window.location.pathname.includes(
                'messages-history')) {
                location.reload();
            }
        }, 30000); // Refresh every 30 seconds
    }

    function stopAutoRefresh() {
        if (autoRefreshInterval) {
            clearInterval(autoRefreshInterval);
        }
    }

    // Start auto-refresh when page loads
    document.addEventListener('DOMContentLoaded', function() {
        startAutoRefresh();

        // Stop auto-refresh when user leaves page
        window.addEventListener('beforeunload', stopAutoRefresh);
    });
</script>
