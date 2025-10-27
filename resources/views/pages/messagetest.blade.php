<x-layout-dashboard title="Test Messages">

    <!-- Breadcrumb -->
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-dark-blue-600">
                        <i class="bi bi-house-fill mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-gray-400 mx-1"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Test Messages</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Alerts -->
    @if (session()->has('alert'))
        <x-alert>
            @slot('type', session('alert')['type'])
            @slot('msg', session('alert')['msg'])
        </x-alert>
    @endif

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 shadow-lg rounded-lg p-4 mb-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="bi bi-exclamation-circle-fill text-red-600 text-lg"></i>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-sm font-medium text-red-800">Validation Error</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="ml-4 flex-shrink-0">
                    <button type="button"
                        class="inline-flex text-red-400 hover:text-red-600 focus:outline-none focus:text-red-600 transition-colors duration-200"
                        onclick="this.parentElement.parentElement.parentElement.remove()">
                        <i class="bi bi-x-lg text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif
    <!-- Main Content -->
    <div class="max-w-4xl mx-auto">
        <!-- Header Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-dark-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="bi bi-chat-left-dots-fill text-dark-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Test Message</h2>
                        <p class="text-sm text-gray-600">Send test messages to verify your WhatsApp connection</p>
                    </div>
                </div>
            </div>

            @if (!session()->has('selectedDevice'))
                <div class="p-6">
                    <div class="bg-amber-50 border-l-4 border-amber-400 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-exclamation-triangle-fill text-amber-600 text-lg"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-amber-800">No Device Selected</h3>
                                <div class="mt-2 text-sm text-amber-700">
                                    <p>Please select a device from the sidebar to start testing messages.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="p-6">
                    <!-- Test Message Form -->
                    <form action="{{ route('messagetest') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Sender Info -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bi bi-phone mr-2"></i>Sender Device
                            </label>
                            <div class="flex items-center">
                                <input name="sender" value="{{ session()->get('selectedDevice')['device_body'] }}"
                                    type="text"
                                    class="flex-1 bg-white border border-gray-300 rounded-lg px-3 py-2 text-gray-900 cursor-not-allowed"
                                    readonly>
                                <div class="ml-3">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <div class="w-2 h-2 bg-green-400 rounded-full mr-1"></div>
                                        {{ session()->get('selectedDevice')['device_status'] ?? 'Connected' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Receiver Numbers -->
                        <div>
                            <label for="number" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bi bi-people mr-2"></i>Receiver Numbers
                            </label>
                            <textarea name="number" id="number" placeholder="628xxx|628xxx|628xxx (separate multiple numbers with |)"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
                                rows="3" required></textarea>
                            <p class="mt-1 text-xs text-gray-500">Enter phone numbers with country code (e.g.,
                                6281234567890)</p>
                        </div>

                        <!-- Message Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bi bi-chat-square-text mr-2"></i>Message Type
                            </label>
                            <div class="relative">
                                <button type="button" id="messageTypeDropdown"
                                    class="w-full flex items-center justify-between border border-gray-300 rounded-lg px-3 py-2 text-gray-900 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
                                    onclick="toggleMessageTypeDropdown()">
                                    <span id="selectedMessageType" class="flex items-center">
                                        <i class="bi bi-chat-square-text mr-2 text-gray-400"></i>
                                        Select Message Type
                                    </span>
                                    <i class="bi bi-chevron-down text-gray-400 transition-transform duration-200"
                                        id="messageTypeIcon"></i>
                                </button>

                                <!-- Hidden select for form submission -->
                                <select name="type" id="type" class="hidden" required>
                                    <option value="" selected disabled>Select Message Type</option>
                                    <option value="text">Text Message</option>
                                    <option value="media">Media Message</option>
                                    <option value="poll">Poll Message</option>
                                    <option value="vcard">Vcard Message</option>
                                    <option value="location">Location Message</option>
                                    <option value="sticker">Sticker Message</option>
                                    <option value="list">List Message (Unstable, requires image)</option>
                                    <option value="button">Button Message (Unstable, requires image)</option>
                                </select>

                                <!-- Dropdown Menu -->
                                <div class="absolute top-full left-0 right-0 mt-1 bg-white border border-gray-300 rounded-lg shadow-lg z-50 hidden"
                                    id="messageTypeDropdownMenu">
                                    <div class="py-2">
                                        <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer flex items-center"
                                            onclick="selectMessageType('text', 'Text Message', 'bi-chat-text')">
                                            <i class="bi bi-chat-text text-gray-600 mr-3"></i>
                                            <span class="text-gray-900">Text Message</span>
                                        </div>
                                        <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer flex items-center"
                                            onclick="selectMessageType('media', 'Media Message', 'bi-image')">
                                            <i class="bi bi-image text-gray-600 mr-3"></i>
                                            <span class="text-gray-900">Media Message</span>
                                        </div>
                                        <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer flex items-center"
                                            onclick="selectMessageType('poll', 'Poll Message', 'bi-bar-chart')">
                                            <i class="bi bi-bar-chart text-gray-600 mr-3"></i>
                                            <span class="text-gray-900">Poll Message</span>
                                        </div>
                                        <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer flex items-center"
                                            onclick="selectMessageType('vcard', 'Vcard Message', 'bi-person')">
                                            <i class="bi bi-person text-gray-600 mr-3"></i>
                                            <span class="text-gray-900">Vcard Message</span>
                                        </div>
                                        <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer flex items-center"
                                            onclick="selectMessageType('location', 'Location Message', 'bi-geo-alt')">
                                            <i class="bi bi-geo-alt text-gray-600 mr-3"></i>
                                            <span class="text-gray-900">Location Message</span>
                                        </div>
                                        <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer flex items-center"
                                            onclick="selectMessageType('sticker', 'Sticker Message', 'bi-emoji-smile')">
                                            <i class="bi bi-emoji-smile text-gray-600 mr-3"></i>
                                            <span class="text-gray-900">Sticker Message</span>
                                        </div>
                                        <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer flex items-center"
                                            onclick="selectMessageType('list', 'List Message', 'bi-list-ul')">
                                            <i class="bi bi-list-ul text-gray-600 mr-3"></i>
                                            <span class="text-gray-900">List Message</span>
                                            <span class="ml-auto text-xs text-amber-600">(Unstable)</span>
                                        </div>
                                        <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer flex items-center"
                                            onclick="selectMessageType('button', 'Button Message', 'bi-hand-index')">
                                            <i class="bi bi-hand-index text-gray-600 mr-3"></i>
                                            <span class="text-gray-900">Button Message</span>
                                            <span class="ml-auto text-xs text-amber-600">(Unstable)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic Form Fields -->
                        <div class="ajaxplace">
                            <!-- Dynamic content will be loaded here based on message type -->
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-dark-blue-600 hover:bg-dark-blue-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-dark-blue-500 focus:ring-offset-2">
                                <i class="bi bi-send mr-2"></i>
                                Send Test Message
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- External Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"></script>
    <script src="https://woody180.github.io/vanilla-javascript-emoji-picker/vanillaEmojiPicker.js"></script>

    <script>
        // Toggle message type dropdown
        function toggleMessageTypeDropdown() {
            const dropdown = document.getElementById('messageTypeDropdownMenu');
            const icon = document.getElementById('messageTypeIcon');

            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                dropdown.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // Select message type
        function selectMessageType(value, text, iconClass) {
            // Update hidden select
            document.getElementById('type').value = value;

            // Update display
            const selectedElement = document.getElementById('selectedMessageType');
            selectedElement.innerHTML = `
                <i class="bi ${iconClass} mr-2 text-dark-blue-600"></i>
                ${text}
            `;

            // Close dropdown
            document.getElementById('messageTypeDropdownMenu').classList.add('hidden');
            document.getElementById('messageTypeIcon').style.transform = 'rotate(0deg)';

            // Trigger form loading
            loadMessageForm(value);
        }

        // Load message form based on type
        function loadMessageForm(type) {
            // Show loading state
            $('.ajaxplace').html(`
                <div class="flex items-center justify-center py-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-dark-blue-600"></div>
                    <span class="ml-3 text-gray-600">Loading form...</span>
                </div>
            `);

            // Make AJAX request
            $.ajax({
                url: `/form-message/${type}`,
                type: "GET",
                dataType: "html",
                success: function(result) {
                    $(".ajaxplace").html(result);
                },
                error: function(xhr, status, error) {
                    console.error('Error loading form:', error);
                    $('.ajaxplace').html(`
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="bi bi-exclamation-circle-fill text-red-600 mr-2"></i>
                                <span class="text-red-800">Error loading form. Please try again.</span>
                            </div>
                        </div>
                    `);
                }
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('messageTypeDropdownMenu');
            const trigger = event.target.closest('#messageTypeDropdown');

            if (!trigger && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
                document.getElementById('messageTypeIcon').style.transform = 'rotate(0deg)';
            }
        });

        // Form validation
        $('form').on('submit', function(e) {
            const type = $('#type').val();
            const number = $('#number').val().trim();

            if (!type) {
                e.preventDefault();
                showNotification('error', 'Error', 'Please select a message type');
                return false;
            }

            if (!number) {
                e.preventDefault();
                showNotification('error', 'Error', 'Please enter receiver numbers');
                return false;
            }

            // Show loading state on submit button
            const submitBtn = $(this).find('button[type="submit"]');
            const originalText = submitBtn.html();
            submitBtn.html('<i class="bi bi-hourglass-split mr-2"></i>Sending...').prop('disabled', true);

            // Re-enable button after 5 seconds (fallback)
            setTimeout(() => {
                submitBtn.html(originalText).prop('disabled', false);
            }, 5000);
        });
    </script>
</x-layout-dashboard>
