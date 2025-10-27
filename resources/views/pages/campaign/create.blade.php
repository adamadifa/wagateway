<x-layout-dashboard title="Create Campaign">
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
                                            <i class="bi bi-plus-circle text-purple-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h1 class="text-2xl font-bold text-gray-900">Create Campaign</h1>
                                            <p class="text-sm text-gray-600">Create a new WhatsApp campaign with
                                                step-by-step wizard</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500">Device</p>
                                            <p class="text-lg font-semibold text-gray-900">
                                                {{ session('selectedDevice')['device_body'] ?? 'Not Selected' }}
                                            </p>
                                        </div>
                                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                            <i class="bi bi-whatsapp text-green-600 text-xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step Navigation -->
                            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                                <div class="flex items-center justify-center space-x-8">
                                    <!-- Step 1 -->
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-purple-600 text-white rounded-full flex items-center justify-center text-sm font-semibold step-indicator"
                                            data-step="1">1</div>
                                        <span class="text-sm font-medium text-gray-700">Campaign Info</span>
                                    </div>

                                    <!-- Connector -->
                                    <div class="w-8 h-0.5 bg-gray-300"></div>

                                    <!-- Step 2 -->
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold step-indicator"
                                            data-step="2">2</div>
                                        <span class="text-sm font-medium text-gray-500">Message & Target</span>
                                    </div>

                                    <!-- Connector -->
                                    <div class="w-8 h-0.5 bg-gray-300"></div>

                                    <!-- Step 3 -->
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold step-indicator"
                                            data-step="3">3</div>
                                        <span class="text-sm font-medium text-gray-500">Schedule & Settings</span>
                                    </div>
                                </div>
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

                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-400 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-exclamation-triangle-fill text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Please correct the following
                                        errors:</h3>
                                    <div class="mt-2 text-sm text-red-700">
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

                    @if (!session()->has('selectedDevice'))
                        <div class="bg-red-50 border-l-4 border-red-400 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-exclamation-triangle-fill text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Device Not Selected</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <p>Please select a device first before creating a campaign.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Campaign Creation Wizard -->
            @if (!session()->has('selectedDevice'))
                <div class="row">
                    <div class="col-12">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                            <div class="p-12 text-center">
                                <div
                                    class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="bi bi-exclamation-triangle text-red-500 text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Device Not Selected</h3>
                                <p class="text-gray-500 mb-6">Please select a WhatsApp device first before creating
                                    a campaign.</p>
                                <a href="{{ route('home') }}"
                                    class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition-colors">
                                    <i class="bi bi-arrow-left mr-2"></i>
                                    Go to Device Selection
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                            <!-- Wizard Header -->
                            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <i class="bi bi-magic text-purple-600 text-sm"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900">Campaign Creation Wizard</h3>
                                </div>
                            </div>

                            <!-- Wizard Content -->
                            <div class="p-6">
                                <!-- Step Content -->
                                <div id="step-content" style="height: 100%;">

                                    <div class="tab-content mt-6">
                                        <!-- Step 1: Campaign Information -->
                                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                            <div class="space-y-6">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        <i class="bi bi-whatsapp mr-2"></i>
                                                        Sender Number / Device
                                                    </label>
                                                    <input type="text"
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed"
                                                        id="campaignName" name="sender"
                                                        placeholder="Enter campaign name"
                                                        value="{{ session('selectedDevice')['device_body'] }}" disabled>
                                                    <input type="hidden" name="device_id" id="device_id"
                                                        value="{{ session('selectedDevice')['device_id'] }}">
                                                    <p class="mt-2 text-sm text-gray-500">
                                                        <i class="bi bi-info-circle mr-1"></i>
                                                        This is the WhatsApp device that will send the campaign
                                                        messages
                                                    </p>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        <i class="bi bi-tag mr-2"></i>
                                                        Campaign Name
                                                    </label>
                                                    <input type="text"
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                                                        id="campaign_name" name="campaign_name"
                                                        placeholder="Enter campaign name">
                                                    <p class="mt-2 text-sm text-gray-500">
                                                        <i class="bi bi-info-circle mr-1"></i>
                                                        Choose a descriptive name for your campaign
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 2: Message & Target -->
                                        <div id="step-2" class="tab-pane" role="tabpanel"
                                            aria-labelledby="step-2" style="height: 400px; overflow-y: scroll;">
                                            <div class="space-y-6">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        <i class="bi bi-book mr-2"></i>
                                                        Select PhoneBook
                                                    </label>
                                                    <select id="phonebook_id" name="phonebook_id"
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors single-select phonebook-option">
                                                    </select>
                                                    <p class="mt-2 text-sm text-gray-500">
                                                        <i class="bi bi-info-circle mr-1"></i>
                                                        Choose the phonebook containing your target contacts
                                                    </p>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        <i class="bi bi-chat-dots mr-2"></i>
                                                        Message Type
                                                    </label>
                                                    <select name="type" id="type"
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                                                        required>
                                                        <option value="" selected disabled>Select Message
                                                            Type</option>
                                                        <option value="text">Text Message</option>
                                                        <option value="media">Media Message</option>
                                                        <option value="list">List Message (Unstable, must with
                                                            image)</option>
                                                        <option value="button">Button Message (Unstable, must with
                                                            image)</option>
                                                    </select>
                                                    <p class="mt-2 text-sm text-gray-500">
                                                        <i class="bi bi-info-circle mr-1"></i>
                                                        Choose the type of message you want to send
                                                    </p>
                                                </div>

                                                <div class="form-group ajaxplace">
                                                    <!-- Dynamic content will be loaded here -->
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 3: Schedule & Settings -->
                                        <div id="step-3" class="tab-pane" role="tabpanel"
                                            aria-labelledby="step-3" style="height: 100%;">
                                            <div class="space-y-6">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        <i class="bi bi-hourglass-split mr-2"></i>
                                                        Delay Per Message (Seconds)
                                                    </label>
                                                    <input type="number" name="delay" id="delay"
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors"
                                                        placeholder="Delay Per Message (Seconds)" value="10"
                                                        min="1" max="60">
                                                    <p class="mt-2 text-sm text-gray-500">
                                                        <i class="bi bi-info-circle mr-1"></i>
                                                        Time delay between sending each message (1-60 seconds)
                                                    </p>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        <i class="bi bi-calendar-event mr-2"></i>
                                                        Campaign Type
                                                    </label>
                                                    <select name="tipe" id="tipe"
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors">
                                                        <option value="immediately">Send Immediately</option>
                                                        <option value="schedule">Schedule for Later</option>
                                                    </select>
                                                    <p class="mt-2 text-sm text-gray-500">
                                                        <i class="bi bi-info-circle mr-1"></i>
                                                        Choose when to start the campaign
                                                    </p>
                                                </div>

                                                <div class="form-group d-none" id="datetime">
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        <i class="bi bi-calendar-check mr-2"></i>
                                                        Schedule Date & Time
                                                    </label>
                                                    <input type="datetime-local" id="datetime2" name="datetime"
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors">
                                                    <p class="mt-2 text-sm text-gray-500">
                                                        <i class="bi bi-info-circle mr-1"></i>
                                                        Select when you want the campaign to start
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                                <button
                                    class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                    id="prev-btn" type="button">
                                    <i class="bi bi-arrow-left mr-2"></i>
                                    Previous
                                </button>

                                <div class="flex items-center space-x-3">
                                    <button
                                        class="inline-flex items-center px-6 py-3 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition-colors"
                                        id="next-btn" type="button">
                                        Next
                                        <i class="bi bi-arrow-right ml-2"></i>
                                    </button>

                                    <button
                                        class="inline-flex items-center px-6 py-3 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors d-none buttonsubmit"
                                        id="finish-btn" type="button">
                                        <i class="bi bi-check-circle mr-2"></i>
                                        Create Campaign
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @endif
    </div>
    </div>
    </div>
    <script src="{{ asset('js/autoreply.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-select2.js') }}"></script>


    <style>
        /* Hide all tab panes by default */
        .tab-pane {
            display: none !important;
        }

        /* Show active tab pane */
        .tab-pane.active {
            display: block !important;
        }

        /* Disabled button styles */
        .disabled {
            opacity: 0.5 !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
        }

        /* Progress indicator animations */
        .step-indicator {
            transition: all 0.3s ease;
        }

        .w-8.h-0\\.5 {
            transition: all 0.3s ease;
        }

        /* Wizard step animations */
        .tab-pane {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Form field focus states */
        .form-control:focus,
        .single-select:focus {
            border-color: #8b5cf6 !important;
            box-shadow: 0 0 0 0.2rem rgba(139, 92, 246, 0.25) !important;
        }

        /* Button hover effects */
        #prev-btn:hover:not(.disabled),
        #next-btn:hover:not(.disabled),
        #finish-btn:hover:not(.disabled) {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Loading state for buttons */
        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::after {
            content: "";
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-left: -8px;
            margin-top: -8px;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Enhanced form styling */
        .form-control,
        .single-select {
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .single-select:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.15);
        }

        /* Step indicator hover effects */
        .step-indicator:hover {
            transform: scale(1.1);
        }

        /* Wizard navigation animations */
        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            transform: translateX(5px);
        }

        /* Success animation for form completion */
        .form-success {
            animation: successPulse 0.6s ease-in-out;
        }

        @keyframes successPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Error state styling */
        .form-error {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.25) !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .step-indicator {
                width: 2rem;
                height: 2rem;
                font-size: 0.75rem;
            }

            .nav-link {
                padding: 0.75rem;
            }

            .nav-link .flex {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

    <script>
        // Global functions (accessible everywhere)

        // load phonebook when step 2 is selected
        function loadPhonebook(page = 1, search = '') {
            let option = $('.phonebook-option');
            option.html('<option value="" selected disabled>Loading...</option>');
            $.ajax({
                url: "/get-phonebook-list" + "?page=" + page + "&search=" + search,
                method: 'GET',
                dataType: 'html',
                success: function(data) {
                    option.html(data);
                    return true;
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }

        // Get current step number
        function getCurrentStep() {
            let activeStep = $('.tab-pane.active').attr('id');
            if (activeStep) {
                return parseInt(activeStep.replace('step-', ''));
            }
            return 1;
        }

        // Simple validation for step navigation
        function validateCurrentStep() {
            let currentStep = getCurrentStep();
            console.log('Validating step:', currentStep);

            switch (currentStep) {
                case 1: // Step 1: Campaign Info
                    if (!$('#campaign_name').val().trim()) {
                        showNotification('Campaign name is required', 'warning');
                        return false;
                    }
                    console.log('Step 1 validation passed');
                    return true;

                case 2: // Step 2: Message & Target
                    if (!$('#phonebook_id').val()) {
                        showNotification('Please select a phonebook', 'warning');
                        return false;
                    }
                    if (!$('#type').val()) {
                        showNotification('Please select a message type', 'warning');
                        return false;
                    }
                    return true;

                case 3: // Step 3: Schedule & Settings
                    if (!$('#delay').val() || $('#delay').val() < 1 || $('#delay').val() > 60) {
                        showNotification('Delay must be between 1 and 60 seconds', 'warning');
                        return false;
                    }
                    if ($('#tipe').val() === 'schedule' && !$('#datetime2').val()) {
                        showNotification('Please select a schedule date and time', 'warning');
                        return false;
                    }
                    return true;

                default:
                    return true;
            }
        }

        // Manual step navigation functions
        function goToStep(stepNumber) {
            console.log('Going to step:', stepNumber);

            // Hide all steps
            $('.tab-pane').removeClass('active').hide();

            // Show target step
            $(`#step-${stepNumber}`).addClass('active').show();

            console.log('Step', stepNumber, 'should be visible:', $(`#step-${stepNumber}`).is(':visible'));

            // Update progress indicator
            updateProgressIndicator(stepNumber);

            // Update button states
            if (stepNumber === 1) {
                $('#prev-btn').addClass('disabled').prop('disabled', true);
                $('#next-btn').removeClass('disabled').prop('disabled', false);
                $('.buttonsubmit').addClass('d-none');
            } else if (stepNumber === 3) {
                $('#prev-btn').removeClass('disabled').prop('disabled', false);
                $('#next-btn').addClass('disabled').prop('disabled', true);
                $('.buttonsubmit').removeClass('d-none');
            } else {
                $('#prev-btn').removeClass('disabled').prop('disabled', false);
                $('#next-btn').removeClass('disabled').prop('disabled', false);
                $('.buttonsubmit').addClass('d-none');
            }

            console.log('Button states updated for step', stepNumber);

            // Call step change handler
            handleStepChange(stepNumber);
        }

        // Simple step change handler (no SmartWizard needed)
        function handleStepChange(stepNumber) {
            console.log('Step changed to:', stepNumber);
            updateProgressIndicator(stepNumber);

            // Load phonebook when step 2 is shown
            if (stepNumber === 2) {
                loadPhonebook();
            }
        }

        // Custom Notification System
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
                case 'warning':
                    notification.className += ' bg-yellow-500 text-white';
                    notification.innerHTML = `
                        <div class="flex items-center">
                            <i class="bi bi-exclamation-triangle mr-2"></i>
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

        // Update progress indicator
        function updateProgressIndicator(currentStep) {
            // Reset all indicators
            document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
                const stepNumber = index + 1;
                const stepText = indicator.parentElement.querySelector('span');

                if (stepNumber <= currentStep) {
                    // Active step
                    indicator.className =
                        'w-8 h-8 bg-purple-600 text-white rounded-full flex items-center justify-center text-sm font-semibold step-indicator';
                    if (stepText) {
                        stepText.className = 'text-sm font-medium text-gray-700';
                    }
                } else {
                    // Inactive step
                    indicator.className =
                        'w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-semibold step-indicator';
                    if (stepText) {
                        stepText.className = 'text-sm font-medium text-gray-500';
                    }
                }
            });

            // Update progress lines - simplified approach
            $('div[class*="w-8"][class*="h-0"]').each(function(index) {
                if (index < currentStep - 1) {
                    $(this).removeClass('bg-gray-300').addClass('bg-purple-600');
                } else {
                    $(this).removeClass('bg-purple-600').addClass('bg-gray-300');
                }
            });
        }

        // Initialize progress indicator
        updateProgressIndicator(1);

        // Form reset function
        function resetForm() {
            // Reset all form fields
            $('input[type="text"], input[type="number"], textarea').val('');
            $('select').prop('selectedIndex', 0);

            // Reset wizard to first step
            goToStep(1);

            // Clear dynamic content
            $('.ajaxplace').empty();

            // Reload phonebook
            loadPhonebook();
        }

        // validation 
        function requiredInput(id) {
            const value = $(`#${id}`).val();
            if (value === ' ' || value === undefined || value.length === 0) {
                showNotification(`${id} must be filled`, 'warning');
                return false;
            }
            return true;
        }

        function checkMultipleForm(type, count = 3, template = false) {
            let success = false;
            let firstElement = $(`input[name='${type}[1]']`).val();
            // Periksa apakah ada elemen pertama yang diisi
            if (firstElement === undefined) {
                showNotification(`Please add at least one ${type} input`, 'warning');
            } else {
                // Periksa apakah semua elemen diisi
                let isAllFilled = true;
                for (let i = 1; i <= count; i++) {
                    let element = $(`input[name='${type}[${i}]']`).val();
                    if (element !== undefined && element === '') {
                        isAllFilled = false;
                        break;
                    }
                    if (template) {
                        try {
                            let format = element.split('|');

                            if (format.length < 3 || (format[0] !== 'call' && format[0] !== 'url')) {
                                showNotification(
                                    `Invalid ${type} ${i} format, format must be like this: call|number|text or url|url|text, first element must be call or url`,
                                    'warning'
                                );
                                return false;
                                break;
                            }
                        } catch (e) {

                        }
                    }
                }

                if (isAllFilled) {
                    success = true;
                } else {
                    showNotification(`All ${type} inputs must be filled`, 'warning');
                }
            }

            return success;
        }

        function validation(step) {
            if (step == 0) {
                return requiredInput('campaign_name');
            }
            if (step == 1) {
                let phonebook = $('.phonebook-option').val();
                const type = $('#type').val();
                if (phonebook == null) {
                    showNotification('Please select phonebook', 'warning');
                    return false;
                }
                if (type == 'text') {
                    return requiredInput('message');
                } else if (type == 'media') {

                    let image = $('#thumbnail').val();
                    let caption = $('#caption').val();
                    if (image.length < 5) {
                        showNotification('Please fill all field needed', 'warning');
                        return false;
                    }
                    return true;
                } else if (type == 'button') {
                    if (!requiredInput('message')) {
                        return false;
                    }

                    // Manual validation for buttons
                    let isValid = true;
                    let buttonCount = $('.buttoninput').length;
                    if (buttonCount < 1 || buttonCount > 5) {
                        showNotification('You must have between 1 and 5 buttons.', 'warning');
                        return false;
                    }

                    $('.buttoninput').each(function(index) {
                        let buttonType = $(this).find('.buttonType').val();
                        let displayText = $(this).find(`#buttonDisplayText${index + 1}`).val();

                        if (!buttonType || ['reply', 'call', 'url', 'copy'].indexOf(buttonType) === -1) {
                            showNotification(
                                `Button ${index + 1} must have a valid type (reply, call, url, copy).`,
                                'warning'
                            );
                            isValid = false;
                            return false;
                        }

                        if (!displayText) {
                            showNotification(`Button ${index + 1} must have display text.`, 'warning');
                            isValid = false;
                            return false;
                        }

                        if (buttonType === 'call') {
                            let phoneNumber = $(this).find(`#phoneNumber${index + 1}`).val();
                            if (!phoneNumber) {
                                showNotification(
                                    `Button ${index + 1} with type 'call' must have a phone number.`,
                                    'warning'
                                );
                                isValid = false;
                                return false;
                            }
                        }

                        if (buttonType === 'url') {
                            let url = $(this).find(`#url${index + 1}`).val();
                            if (!url) {
                                showNotification(
                                    `Button ${index + 1} with type 'url' must have a valid URL.`,
                                    'warning'
                                );
                                isValid = false;
                                return false;
                            }
                        }

                        if (buttonType === 'copy') {
                            let copyText = $(this).find(`#copyText${index + 1}`).val();
                            if (!copyText) {
                                showNotification(
                                    `Button ${index + 1} with type 'copy' must have copy text.`,
                                    'warning'
                                );
                                isValid = false;
                                return false;
                            }
                        }
                    });

                    return isValid;

                } else if (type == 'list') {
                    return requiredInput('message') && requiredInput('buttonlist') && requiredInput(
                        'namelist') && requiredInput('titlelist') && checkMultipleForm('list', 5);
                } else {
                    showNotification('Please select message type', 'warning');
                    return false;
                }

            }
        }

        // handle change tipe campaign
        $('#tipe').change(function() {
            if ($(this).val() == 'schedule') {
                $('#datetime').removeClass('d-none');
            } else {
                $('#datetime').addClass('d-none');
            }
        });

        // Handle message type change
        $('#type').change(function() {
            const messageType = $(this).val();
            const ajaxPlace = $('.ajaxplace');

            if (messageType) {
                ajaxPlace.html(
                    '<div class="text-center py-4"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600 mx-auto"></div><p class="text-sm text-gray-500 mt-2">Loading form...</p></div>'
                );

                // Load dynamic form based on message type
                $.ajax({
                    url: '/form-message/' + messageType,
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        ajaxPlace.html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.error('Response:', xhr.responseText);
                        ajaxPlace.html(
                            '<div class="text-center py-4 text-red-500">Failed to load form. Please try again.<br><small>Error: ' +
                            error + '</small></div>'
                        );
                    }
                });
            } else {
                ajaxPlace.empty();
            }
        });

        $('.buttonsubmit').click(function() {
            if (!requiredInput('delay')) {
                return false;
            }
            if ($('#tipe').val() == 'schedule') {
                if (!requiredInput('datetime2')) {
                    return false;
                }
            }

            // Add loading state
            const submitBtn = $(this);
            const originalText = submitBtn.html();
            submitBtn.addClass('btn-loading').prop('disabled', true);
            submitBtn.html('<i class="bi bi-hourglass-split mr-2"></i>Creating Campaign...');

            // find input and select in tab-content
            const input = $('.tab-content').find('input');
            const select = $('.tab-content').find('select');
            const textarea = $('.tab-content').find('textarea');
            let data = {};

            // Safe datetime handling
            var datetimeInput = document.getElementById('datetime2');
            var datetimeValue = datetimeInput ? datetimeInput.value : '';

            data['device_id'] = $('#device_id').val();
            data['delay'] = $('#delay').val();
            data['datetime'] = datetimeValue;

            // get name and value from input and select
            $('input[type="text"]').each(function() {
                const name = $(this).attr('name');
                if (name) {
                    data[name] = $(this).val();
                }
            });

            $('input[type="radio"]:checked').each(function() {
                const name = $(this).attr('name');
                if (name) {
                    data[name] = $(this).val();
                }
            });

            select.each(function() {
                const name = $(this).attr('name');
                if (name) {
                    data[name] = $(this).val();
                }
            });

            textarea.each(function() {
                const name = $(this).attr('name');
                if (name) {
                    data[name] = $(this).val();
                }
            });

            const formData = new FormData();
            for (const key in data) {
                if (data[key] !== undefined && data[key] !== null) {
                    if (key == 'thumbnail')
                        formData.append('image', data[key]);
                    else {
                        formData.append(key, data[key]);
                    }
                }
            }

            $.ajax({
                url: "/campaign/store",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    // Reset loading state
                    submitBtn.removeClass('btn-loading').prop('disabled', false);
                    submitBtn.html(originalText);

                    if (result.error) {
                        showNotification(result.message, 'error');
                    } else {
                        showNotification(result.message, 'success');
                        // reset wizard form
                        goToStep(1);
                        input.each(function() {
                            $(this).val('');
                        });
                        select.each(function() {
                            $(this).val('');
                        });
                        textarea.each(function() {
                            $(this).val('');
                        });
                    }
                },
                error: function(err) {
                    // Reset loading state
                    submitBtn.removeClass('btn-loading').prop('disabled', false);
                    submitBtn.html(originalText);

                    console.log(err);
                    showNotification(
                        'An error occurred while creating the campaign. Please try again.',
                        'error');
                }
            });
        });

        $(document).ready(function() {
            // Simple Step Navigation (No SmartWizard dependency)
            console.log('Initializing simple step navigation...');

            // Initialize first step as active
            $('#step-1').addClass('active').show();
            $('#step-2').removeClass('active').hide();
            $('#step-3').removeClass('active').hide();

            // Initialize button states
            $('#prev-btn').addClass('disabled').prop('disabled', true);
            $('#next-btn').removeClass('disabled').prop('disabled', false);
            $('.buttonsubmit').addClass('d-none');

            console.log('Wizard initialized - Step 1 should be active');
            console.log('Step 1 visible:', $('#step-1').is(':visible'));
            console.log('Step 2 visible:', $('#step-2').is(':visible'));
            console.log('Step 3 visible:', $('#step-3').is(':visible'));

            // External Button Events
            $("#prev-btn").on("click", function() {
                let currentStep = getCurrentStep();
                console.log('Previous clicked, current step:', currentStep);
                if (currentStep > 1) {
                    goToStep(currentStep - 1);
                }
                return true;
            });

            $("#next-btn").on("click", function() {
                let currentStep = getCurrentStep();
                console.log('Next clicked, current step:', currentStep);
                if (validateCurrentStep()) {
                    goToStep(currentStep + 1);
                    return true;
                }
            });
        });
    </script>
</x-layout-dashboard>
