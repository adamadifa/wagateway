<x-layout-dashboard title="Campaigns">
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
                                            class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                            <i class="bi bi-broadcast text-purple-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h1 class="text-2xl font-bold text-gray-900">Campaigns</h1>
                                            <p class="text-sm text-gray-600">Manage your WhatsApp campaigns and
                                                broadcasts</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500">Total Campaigns</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $campaigns->total() }}</p>
                                        </div>
                                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <i class="bi bi-megaphone text-blue-600 text-xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="px-6 py-4">
                                <div class="flex flex-wrap items-center gap-3">
                                    <a href="{{ route('campaign.create') }}"
                                        class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition-colors">
                                        <i class="bi bi-plus-lg mr-2"></i>
                                        Create Campaign
                                    </a>

                                    <button onclick="clearCampaign()" type="button"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                                        <i class="bi bi-trash mr-2"></i>
                                        Clear All Campaigns
                                    </button>

                                    <button type="button"
                                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                        <i class="bi bi-download mr-2"></i>
                                        Export Data
                                    </button>

                                    <button type="button"
                                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                        <i class="bi bi-funnel mr-2"></i>
                                        Advanced Filter
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

                <!-- Filter Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                            <!-- Filter Header -->
                            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <i class="bi bi-funnel text-purple-600 text-sm"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900">Filter Campaigns</h3>
                                </div>
                            </div>

                            <!-- Filter Form -->
                            <div class="p-6">
                                <form class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="bi bi-whatsapp mr-1"></i>
                                                Device
                                            </label>
                                            <input value="{{ request()->has('device') ? request()->device : '' }}"
                                                type="number" name="device"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                                                placeholder="Enter device number">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="bi bi-flag mr-1"></i>
                                                Status
                                            </label>
                                            <select name="status"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors">
                                                <option
                                                    {{ request()->has('status') && request()->status == 'all' ? 'selected' : '' }}
                                                    value="all">
                                                    All Status
                                                </option>
                                                <option
                                                    {{ request()->has('status') && request()->status == 'completed' ? 'selected' : '' }}
                                                    value="completed">
                                                    Completed
                                                </option>
                                                <option
                                                    {{ request()->has('status') && request()->status == 'processing' ? 'selected' : '' }}
                                                    value="processing">
                                                    Processing
                                                </option>
                                                <option
                                                    {{ request()->has('status') && request()->status == 'waiting' ? 'selected' : '' }}
                                                    value="waiting">
                                                    Waiting
                                                </option>
                                                <option
                                                    {{ request()->has('status') && request()->status == 'paused' ? 'selected' : '' }}
                                                    value="paused">
                                                    Paused
                                                </option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="bi bi-calendar mr-1"></i>
                                                Start Date
                                            </label>
                                            <input type="date" name="start_date"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                                                placeholder="Start Date">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="bi bi-calendar mr-1"></i>
                                                End Date
                                            </label>
                                            <input type="date" name="end_date"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                                                placeholder="End Date">
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                        <div class="flex items-center space-x-3">
                                            <button type="submit"
                                                class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition-colors">
                                                <i class="bi bi-funnel mr-2"></i>
                                                Apply Filter
                                            </button>

                                            <button type="button"
                                                class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                                <i class="bi bi-arrow-clockwise mr-2"></i>
                                                Reset Filter
                                            </button>
                                        </div>

                                        <div class="text-sm text-gray-500">
                                            <span>Showing {{ $campaigns->total() }} campaigns</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Campaigns Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                            <!-- Table Header -->
                            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <h3 class="text-lg font-semibold text-gray-900">Campaign List</h3>
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                <i class="bi bi-broadcast mr-1"></i>
                                                Active Campaigns
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
                                                Device</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Campaign Name</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Message</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Schedule</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Summary</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @if ($campaigns->total() == 0)
                                            <tr>
                                                <td colspan="7" class="px-6 py-12 text-center">
                                                    <div class="flex flex-col items-center">
                                                        <div
                                                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                            <i class="bi bi-broadcast text-2xl text-gray-400"></i>
                                                        </div>
                                                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Campaigns
                                                            Found</h3>
                                                        <p class="text-gray-500 mb-4">Create your first campaign to get
                                                            started</p>
                                                        <a href="{{ route('campaign.create') }}"
                                                            class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition-colors">
                                                            <i class="bi bi-plus-lg mr-2"></i>
                                                            Create Campaign
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($campaigns as $campaign)
                                                <tr class="hover:bg-gray-50 transition-colors">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div
                                                                class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                                                <i class="bi bi-whatsapp text-green-600 text-sm"></i>
                                                            </div>
                                                            <div>
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ $campaign->device->body }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $campaign->name }}</div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <button onclick="viewMessage('{{ $campaign->id }}')"
                                                            class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-800 text-xs font-medium rounded-lg hover:bg-blue-200 transition-colors">
                                                            <i class="bi bi-eye mr-1"></i>
                                                            {{ $campaign->type }}
                                                        </button>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $campaign->schedule }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="space-y-1">
                                                            <div class="flex items-center space-x-2">
                                                                <span
                                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                    <i class="bi bi-list-ul mr-1"></i>
                                                                    {{ $campaign->blasts_count }} Total
                                                                </span>
                                                            </div>
                                                            <div class="flex items-center space-x-2">
                                                                <span
                                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                    <i class="bi bi-check-circle mr-1"></i>
                                                                    {{ $campaign->blasts_success }} Success
                                                                </span>
                                                            </div>
                                                            <div class="flex items-center space-x-2">
                                                                <span
                                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                    <i class="bi bi-x-circle mr-1"></i>
                                                                    {{ $campaign->blasts_failed }} Failed
                                                                </span>
                                                            </div>
                                                            <div class="flex items-center space-x-2">
                                                                <span
                                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                                    <i class="bi bi-clock mr-1"></i>
                                                                    {{ $campaign->blasts_pending }} Waiting
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if ($campaign->status == 'completed')
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                <i class="bi bi-check-circle mr-1"></i>
                                                                Completed
                                                            </span>
                                                        @elseif ($campaign->status == 'paused')
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                                <i class="bi bi-pause-circle mr-1"></i>
                                                                Paused
                                                            </span>
                                                        @elseif ($campaign->status == 'waiting')
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                                <i class="bi bi-clock mr-1"></i>
                                                                Waiting
                                                            </span>
                                                        @elseif ($campaign->status == 'processing')
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                <i class="bi bi-hourglass-split mr-1"></i>
                                                                Processing
                                                            </span>
                                                        @else
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                <i class="bi bi-exclamation-triangle mr-1"></i>
                                                                {{ ucfirst($campaign->status) }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <div class="flex items-center space-x-2">
                                                            <a href="{{ route('campaign.blasts', $campaign->id) }}"
                                                                class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors"
                                                                title="View Blasts">
                                                                <i class="bi bi-eye"></i>
                                                            </a>

                                                            @if ($campaign->status == 'processing' || $campaign->status == 'waiting')
                                                                <button onclick="pauseCampaign('{{ $campaign->id }}')"
                                                                    class="p-2 text-yellow-600 hover:text-yellow-800 hover:bg-yellow-50 rounded-lg transition-colors"
                                                                    title="Pause Campaign">
                                                                    <i class="bi bi-pause-fill"></i>
                                                                </button>
                                                            @endif

                                                            @if ($campaign->status == 'paused')
                                                                <button
                                                                    onclick="resumeCampaign('{{ $campaign->id }}')"
                                                                    class="p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors"
                                                                    title="Resume Campaign">
                                                                    <i class="bi bi-play-fill"></i>
                                                                </button>
                                                            @endif

                                                            <button onclick="deleteCampaign('{{ $campaign->id }}')"
                                                                class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors"
                                                                title="Delete Campaign">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            @if ($campaigns->hasPages())
                                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                                    <nav class="flex items-center justify-between">
                                        <div class="flex items-center text-sm text-gray-700">
                                            <span>Showing {{ $campaigns->firstItem() }} to
                                                {{ $campaigns->lastItem() }} of {{ $campaigns->total() }}
                                                results</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            @if ($campaigns->previousPageUrl())
                                                <a href="{{ $campaigns->previousPageUrl() }}"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700 transition-colors">
                                                    <i class="bi bi-chevron-left mr-1"></i>
                                                    Previous
                                                </a>
                                            @endif

                                            @for ($i = max(1, $campaigns->currentPage() - 2); $i <= min($campaigns->lastPage(), $campaigns->currentPage() + 2); $i++)
                                                <a href="{{ $campaigns->url($i) }}"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium {{ $campaigns->currentPage() == $i ? 'bg-purple-600 text-white' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 hover:text-gray-700' }} rounded-lg transition-colors">
                                                    {{ $i }}
                                                </a>
                                            @endfor

                                            @if ($campaigns->nextPageUrl())
                                                <a href="{{ $campaigns->nextPageUrl() }}"
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
            {{-- end table --}}

        </div>
    </div>
    </div>
    </div>

    <!-- Modal Preview Message -->
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" id="previewMessage">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-t-xl p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <i class="bi bi-eye text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold">Campaign Message Preview</h3>
                        </div>
                        <button type="button" onclick="closePreviewModal()"
                            class="text-white hover:text-gray-200 transition-colors">
                            <i class="bi bi-x-lg text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <div class="preview-message-area">
                        <!-- Content will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout-dashboard>
<script>
    function viewMessage(id) {
        // Show loading state
        const modal = document.getElementById('previewMessage');
        const contentArea = document.querySelector('.preview-message-area');
        contentArea.innerHTML = `
                <div class="flex items-center justify-center py-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div>
                    <span class="ml-3 text-gray-600">Loading message preview...</span>
                </div>
            `;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        $.ajax({
            url: `/preview-message`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: {
                id: id,
                table: 'campaigns',
                column: 'message'
            },
            dataType: 'html',
            success: (result) => {
                contentArea.innerHTML = result;
            },
            error: (error) => {
                console.log(error);
                contentArea.innerHTML = `
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="bi bi-exclamation-triangle text-red-500 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Failed to Load Preview</h3>
                            <p class="text-gray-500">Something went wrong while loading the message preview</p>
                        </div>
                    `;
                showNotification('Failed to load message preview', 'error');
            }
        });
    }

    function closePreviewModal() {
        document.getElementById('previewMessage').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function pauseCampaign(id) {
        if (!confirm('Are you sure you want to pause this campaign?')) {
            showNotification('Operation cancelled', 'info');
            return;
        }

        $.ajax({
            url: `/campaign/pause/${id}`,
            type: 'POST',
            dataType: 'json',
            success: (result) => {
                showNotification('Campaign paused successfully', 'success');
                setTimeout(() => {
                    location.reload();
                }, 1500);
            },
            error: (error) => {
                showNotification('Failed to pause campaign. Please try again.', 'error');
            }
        });
    }

    function resumeCampaign(id) {
        if (!confirm('Are you sure you want to resume this campaign?')) {
            showNotification('Operation cancelled', 'info');
            return;
        }

        $.ajax({
            url: `/campaign/resume/${id}`,
            type: 'POST',
            dataType: 'json',
            success: (result) => {
                showNotification('Campaign resumed successfully', 'success');
                setTimeout(() => {
                    location.reload();
                }, 1500);
            },
            error: (error) => {
                showNotification('Failed to resume campaign. Please try again.', 'error');
            }
        });
    }

    function deleteCampaign(id) {
        if (!confirm('Are you sure you want to delete this campaign? This action cannot be undone.')) {
            showNotification('Operation cancelled', 'info');
            return;
        }

        $.ajax({
            url: `/campaign/delete/${id}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            dataType: 'json',
            success: (result) => {
                showNotification('Campaign deleted successfully', 'success');
                setTimeout(() => {
                    location.reload();
                }, 1500);
            },
            error: (error) => {
                showNotification('Failed to delete campaign. Please try again.', 'error');
            }
        });
    }

    function clearCampaign() {
        if (!confirm('Are you sure you want to clear all campaigns? This action cannot be undone.')) {
            showNotification('Operation cancelled', 'info');
            return;
        }

        // Show loading state
        const button = event.target;
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="bi bi-hourglass-split mr-2"></i>Clearing...';
        button.disabled = true;

        $.ajax({
            url: `/campaign/clear`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            dataType: 'json',
            success: (result) => {
                showNotification('All campaigns cleared successfully', 'success');
                setTimeout(() => {
                    location.reload();
                }, 1500);
            },
            error: (error) => {
                showNotification('Failed to clear campaigns. Please try again.', 'error');
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
            case 'warning':
                notification.className += ' bg-yellow-500 text-white';
                notification.innerHTML = `
                        <div class="flex items-center">
                            <i class="bi bi-exclamation-triangle mr-2"></i>
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
            if (!document.querySelector('#previewMessage:not(.hidden)') && window.location.pathname.includes(
                    'campaigns')) {
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

        // Close modal when clicking outside
        document.getElementById('previewMessage').addEventListener('click', function(e) {
            if (e.target === this) {
                closePreviewModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePreviewModal();
            }
        });
    });
</script>
