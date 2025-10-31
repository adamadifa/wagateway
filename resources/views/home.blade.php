<x-layout-dashboard title="Home">
    <!-- Alert Messages -->
    @if (session()->has('alert'))
        <x-alert>
            @slot('type', session('alert')['type'])
            @slot('msg', session('alert')['msg'])
        </x-alert>
    @endif

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="bi bi-exclamation-triangle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800 ">Please correct the following errors:
                    </h3>
                    <div class="mt-2 text-sm text-red-700 ">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Devices Card -->
        {{-- <div
            class="bg-gradient-to-br from-dark-blue-600 to-dark-blue-700 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-dark-blue-100 text-sm font-medium">Total Devices</p>
                    <p class="text-3xl font-bold mt-1">{{ $user->devices_count }}</p>
                    <p class="text-dark-blue-200 text-xs mt-2">Limit: {{ $user->limit_device }}</p>
                </div>
                <div class="bg-white/20 rounded-lg p-3">
                    <i class="bi bi-whatsapp text-2xl"></i>
                </div>
            </div>
        </div> --}}

        <!-- Blast/Bulk Card -->
        {{-- <div
            class="bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm font-medium">Blast/Bulk</p>
                    <div class="flex space-x-2 mt-2">
                        <span
                            class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full">{{ $user->blasts_pending }}
                            Wait</span>
                        <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">{{ $user->blasts_success }}
                            Sent</span>
                        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $user->blasts_failed }}
                            Fail</span>
                    </div>
                    <p class="text-emerald-200 text-xs mt-2">From {{ $user->campaigns_count }} Campaigns</p>
                </div>
                <div class="bg-white/20 rounded-lg p-3">
                    <i class="bi bi-broadcast text-2xl"></i>
                </div>
            </div>
        </div> --}}

        <!-- Subscription Status Card -->
        {{-- <div
            class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Subscription Status</p>
                    <p class="text-2xl font-bold mt-1">{{ $user->subscription_status }}</p>
                    <p class="text-blue-200 text-xs mt-2">Expired: {{ $user->expired_subscription_status }}</p>
                </div>
                <div class="bg-white/20 rounded-lg p-3">
                    <i class="bi bi-emoji-heart-eyes text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Messages Sent Card -->
        <div
            class="bg-gradient-to-br from-purple-600 to-purple-700 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Messages Sent</p>
                    <p class="text-3xl font-bold mt-1">{{ $user->message_histories_count }}</p>
                    <p class="text-purple-200 text-xs mt-2">From message histories</p>
                </div>
                <div class="bg-white/20 rounded-lg p-3">
                    <i class="bi bi-chat-left-text text-2xl"></i>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- WhatsApp Account Section -->
    <div class="bg-white  rounded-xl shadow-lg border border-gray-200 ">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 ">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="bg-dark-blue-100  p-2 rounded-lg">
                        <i class="bi bi-whatsapp text-dark-blue-600  text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 ">WhatsApp Account</h3>
                </div>
                <button type="button"
                    class="bg-dark-blue-600 hover:bg-dark-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center space-x-2"
                    onclick="openModal()">
                    <i class="bi bi-plus"></i>
                    <span>Add Device</span>
                </button>
            </div>
        </div>
        <!-- Table -->
        <div class="overflow-x-auto bg-white rounded-xl shadow-sm">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __('Number') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __('Webhook URL') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __('Read') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __('Reject Call') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __('Online') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __('Typing') }} (WH)</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __('Sent') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __('Status') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @if ($numbers->total() == 0)
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="bi bi-whatsapp text-4xl text-gray-400 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900  mb-2">No Device Added
                                        Yet</h3>
                                    <p class="text-gray-500  mb-4">Get started by adding your first
                                        WhatsApp device</p>
                                    <button type="button"
                                        class="bg-dark-blue-600 hover:bg-dark-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200"
                                        data-bs-toggle="modal" data-bs-target="#addDevice">
                                        <i class="bi bi-plus mr-2"></i>Add Device
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endif

                    @foreach ($numbers as $number)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <!-- Number -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-dark-blue-100  p-2 rounded-lg mr-3">
                                        <i class="bi bi-phone text-dark-blue-600 "></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 ">{{ $number['body'] }}</span>
                                </div>
                            </td>

                            <!-- Webhook URL -->
                            <td class="px-6 py-4">
                                <form action="" method="post">
                                    @csrf
                                    <input type="text"
                                        class="w-full px-3 py-2 border-0 bg-gray-50 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-dark-blue-500 focus:bg-white webhook-url-form transition-colors duration-200"
                                        data-id="{{ $number['body'] }}" name="" value="{{ $number['webhook'] }}"
                                        placeholder="Enter webhook URL">
                                </form>
                            </td>

                            <!-- Read Toggle -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" data-url="{{ route('setHookRead') }}" class="sr-only peer toggle-read"
                                        data-id="{{ $number['body'] }}" {{ $number['wh_read'] ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-dark-blue-300 dark:peer-focus:ring-dark-blue-800 rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-0 after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-dark-blue-600">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900 ">
                                        {{ $number['webhook_read'] ? 'Yes' : 'No' }}
                                    </span>
                                </label>
                            </td>

                            <!-- Reject Call Toggle -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" data-url="{{ route('setHookReject') }}" class="sr-only peer toggle-reject"
                                        data-id="{{ $number['body'] }}" {{ $number['reject_call'] ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-dark-blue-300 dark:peer-focus:ring-dark-blue-800 rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-0 after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-dark-blue-600">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900 ">
                                        {{ $number['reject_call'] ? 'Yes' : 'No' }}
                                    </span>
                                </label>
                            </td>

                            <!-- Online Toggle -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" data-url="{{ route('setAvailable') }}" class="sr-only peer toggle-available"
                                        data-id="{{ $number['body'] }}" {{ $number['set_available'] ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-dark-blue-300 dark:peer-focus:ring-dark-blue-800 rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-0 after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-dark-blue-600">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900 ">
                                        {{ $number['set_available'] ? 'Yes' : 'No' }}
                                    </span>
                                </label>
                            </td>

                            <!-- Typing Toggle -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" data-url="{{ route('setHookTyping') }}" class="sr-only peer toggle-typing"
                                        data-id="{{ $number['body'] }}" {{ $number['wh_typing'] ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-dark-blue-300 dark:peer-focus:ring-dark-blue-800 rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-0 after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-dark-blue-600">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900 ">
                                        {{ $number['webhook_typing'] ? 'Yes' : 'No' }}
                                    </span>
                                </label>
                            </td>

                            <!-- Messages Sent -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800  ">
                                    {{ $number['message_sent'] }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $number['status'] == 'Connected' ? 'bg-green-100 text-green-800  ' : 'bg-red-100 text-red-800  ' }}">
                                    <i class="bi bi-circle-fill mr-1"></i>
                                    {{ $number['status'] }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('connect-via-code', $number->body) }}"
                                        class="text-blue-600 hover:text-blue-900   p-2 rounded-lg hover:bg-blue-50  transition-colors duration-200"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Connect Via Code') }}">
                                        <i class="bi bi-phone"></i>
                                    </a>
                                    <a href="{{ route('scan', $number->body) }}"
                                        class="text-green-600 hover:text-green-900   p-2 rounded-lg hover:bg-green-50  transition-colors duration-200"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Connect Via QR') }}">
                                        <i class="bi bi-qr-code"></i>
                                    </a>
                                    <form action="{{ route('deleteDevice') }}" method="POST" class="inline">
                                        @method('delete')
                                        @csrf
                                        <input name="deviceId" type="hidden" value="{{ $number['id'] }}">
                                        <button type="submit" name="delete"
                                            class="text-red-600 hover:text-red-900   p-2 rounded-lg hover:bg-red-50  transition-colors duration-200"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Delete Device') }}"
                                            onclick="return confirm('Are you sure you want to delete this device?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <!-- Pagination -->
        @if ($numbers->lastPage() > 1)
            <div class="px-6 py-4 border-t border-gray-200 ">
                <nav class="flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                        @if ($numbers->currentPage() > 1)
                            <a href="{{ $numbers->previousPageUrl() }}"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300  text-sm font-medium rounded-md text-gray-700  bg-white  hover:bg-gray-50 ">
                                Previous
                            </a>
                        @endif
                        @if ($numbers->currentPage() < $numbers->lastPage())
                            <a href="{{ $numbers->nextPageUrl() }}"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300  text-sm font-medium rounded-md text-gray-700  bg-white  hover:bg-gray-50 ">
                                Next
                            </a>
                        @endif
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700 ">
                                Showing {{ $numbers->firstItem() }} to {{ $numbers->lastItem() }} of
                                {{ $numbers->total() }} results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-lg shadow-sm -space-x-px">
                                @if ($numbers->currentPage() > 1)
                                    <a href="{{ $numbers->previousPageUrl() }}"
                                        class="relative inline-flex items-center px-3 py-2 rounded-l-lg bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                        <i class="bi bi-chevron-left"></i>
                                    </a>
                                @endif

                                @for ($i = 1; $i <= $numbers->lastPage(); $i++)
                                    <a href="{{ $numbers->url($i) }}"
                                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium transition-colors duration-200 {{ $numbers->currentPage() == $i ? 'z-10 bg-dark-blue-600 text-white' : 'bg-white text-gray-500 hover:bg-gray-50' }}">
                                        {{ $i }}
                                    </a>
                                @endfor

                                @if ($numbers->currentPage() < $numbers->lastPage())
                                    <a href="{{ $numbers->nextPageUrl() }}"
                                        class="relative inline-flex items-center px-3 py-2 rounded-r-lg bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                @endif
                            </nav>
                        </div>
                    </div>
                </nav>
            </div>
        @endif
    </div>


    </div>
    </div>
    </div>





    <!-- Add Device Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" id="addDevice">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-dark-blue-600 to-dark-blue-700 text-white rounded-t-xl p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <i class="bi bi-plus-circle text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold">Add New Device</h3>
                        </div>
                        <button type="button" onclick="closeModal()" class="text-white hover:text-gray-200 transition-colors">
                            <i class="bi bi-x-lg text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <form action="{{ route('addDevice') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="sender" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bi bi-phone mr-2"></i>Phone Number
                            </label>
                            <input type="number" name="sender" id="nomor" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-dark-blue-500 focus:border-transparent transition-colors duration-200"
                                placeholder="Enter phone number with country code">
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-triangle mr-1"></i>
                                Use Country Code (without +)
                            </p>
                        </div>

                        <div>
                            <label for="urlwebhook" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bi bi-link-45deg mr-2"></i>Webhook URL
                            </label>
                            <input type="text" name="urlwebhook" id="urlwebhook"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-dark-blue-500 focus:border-transparent transition-colors duration-200"
                                placeholder="Enter webhook URL (optional)">
                            <p class="mt-2 text-sm text-gray-500 flex items-center">
                                <i class="bi bi-info-circle mr-1"></i>
                                Optional - Leave blank if not needed
                            </p>
                        </div>

                        <div class="flex items-center justify-end space-x-3 pt-4">
                            <button type="button" onclick="closeModal()"
                                class="px-6 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                <i class="bi bi-x-circle mr-2"></i>Cancel
                            </button>
                            <button type="submit" name="submit"
                                class="px-6 py-2 bg-dark-blue-600 hover:bg-dark-blue-700 text-white rounded-lg transition-colors duration-200 flex items-center">
                                <i class="bi bi-check-circle mr-2"></i>Save Device
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout-dashboard>

<script>
    // Modal functions
    function openModal() {
        document.getElementById('addDevice').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('addDevice').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('addDevice').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    var typingTimer; //timer identifier
    var doneTypingInterval = 1000;

    $('.webhook-url-form').on('keyup', function() {
        clearTimeout(typingTimer);
        let value = $(this).val();
        let number = $(this).data('id');

        typingTimer = setTimeout(function() {

            $.ajax({
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('setHook') }}',
                data: {
                    csrf: $('meta[name="csrf-token"]').attr('content'),
                    number: number,
                    webhook: value
                },
                dataType: 'json',
                success: (result) => {
                    toastr.success('Webhook URL has been updated');
                },
                error: (err) => {
                    console.log(err);
                }
            })
        }, doneTypingInterval);
    })


    $('.delay-url-form').on('keyup', function() {
        clearTimeout(typingTimer);
        let value = $(this).val();
        let number = $(this).data('id');

        typingTimer = setTimeout(function() {

            $.ajax({
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('setDelay') }}',
                data: {
                    csrf: $('meta[name="csrf-token"]').attr('content'),
                    number: number,
                    delay: value
                },
                dataType: 'json',
                success: (result) => {
                    toastr.success('{{ __('Delay has been updated') }}');
                },
                error: (err) => {
                    console.log(err);
                }
            })
        }, doneTypingInterval);
    });

    $(".toggle-read").on("click", function() {
        let dataId = $(this).data("id");
        let isChecked = $(this).is(":checked");
        let url = $(this).data("url");
        $.ajax({
            url: url,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                webhook_read: isChecked ? "1" : "0",
                id: dataId,
            },
            success: function(result) {
                if (!result.error) {
                    // find label
                    let label = $(`.toggle-read[data-id=${dataId}]`)
                        .parent()
                        .find("label");
                    // change label
                    if (isChecked) {
                        label.text("{{ __('Yes') }}");
                    } else {
                        label.text("{{ __('No') }}");
                    }
                    toastr['success'](result.msg);
                }
            },
        });
    });

    $(".toggle-reject").on("click", function() {
        let dataId = $(this).data("id");
        let isChecked = $(this).is(":checked");
        let url = $(this).data("url");
        $.ajax({
            url: url,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                webhook_reject_call: isChecked ? "1" : "0",
                id: dataId,
            },
            success: function(result) {
                if (!result.error) {
                    // find label
                    let label = $(`.toggle-reject[data-id=${dataId}]`)
                        .parent()
                        .find("label");
                    // change label
                    if (isChecked) {
                        label.text("{{ __('Yes') }}");
                    } else {
                        label.text("{{ __('No') }}");
                    }
                    toastr['success'](result.msg);
                }
            },
        });
    });

    $(".toggle-typing").on("click", function() {
        let dataId = $(this).data("id");
        let isChecked = $(this).is(":checked");
        let url = $(this).data("url");
        $.ajax({
            url: url,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                webhook_typing: isChecked ? "1" : "0",
                id: dataId,
            },
            success: function(result) {
                if (!result.error) {
                    // find label
                    let label = $(`.toggle-typing[data-id=${dataId}]`)
                        .parent()
                        .find("label");
                    // change label
                    if (isChecked) {
                        label.text("{{ __('Yes') }}");
                    } else {
                        label.text("{{ __('No') }}");
                    }
                    toastr['success'](result.msg);
                }
            },
        });
    });

    $(".toggle-available").on("click", function() {
        let dataId = $(this).data("id");
        let isChecked = $(this).is(":checked");
        let url = $(this).data("url");
        $.ajax({
            url: url,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                set_available: isChecked ? "1" : "0",
                id: dataId,
            },
            success: function(result) {
                if (!result.error) {
                    // find label
                    let label = $(`.toggle-available[data-id=${dataId}]`)
                        .parent()
                        .find("label");
                    // change label
                    if (isChecked) {
                        label.text("{{ __('Yes') }}");
                    } else {
                        label.text("{{ __('No') }}");
                    }
                    toastr['success'](result.msg);
                }
            },
        });
    });
</script>
