<div
    class="bg-white border-l-4 border-{{ $type == 'success' ? 'green' : ($type == 'danger' ? 'red' : 'yellow') }}-500 shadow-lg rounded-lg p-4 mb-6 relative overflow-hidden">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            @if ($type == 'success')
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="bi bi-check-circle-fill text-green-600 text-lg"></i>
                </div>
            @elseif ($type == 'danger')
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="bi bi-exclamation-circle-fill text-red-600 text-lg"></i>
                </div>
            @elseif ($type == 'warning')
                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="bi bi-exclamation-triangle-fill text-yellow-600 text-lg"></i>
                </div>
            @else
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="bi bi-info-circle-fill text-blue-600 text-lg"></i>
                </div>
            @endif
        </div>
        <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-gray-900">{{ $msg }}</p>
        </div>
        <div class="ml-4 flex-shrink-0">
            <button type="button"
                class="inline-flex text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600 transition-colors duration-200"
                onclick="this.parentElement.parentElement.parentElement.remove()">
                <i class="bi bi-x-lg text-lg"></i>
            </button>
        </div>
    </div>

    <!-- Animated background -->
    <div
        class="absolute inset-0 bg-gradient-to-r from-{{ $type == 'success' ? 'green' : ($type == 'danger' ? 'red' : 'yellow') }}-50 to-transparent opacity-50">
    </div>
</div>
