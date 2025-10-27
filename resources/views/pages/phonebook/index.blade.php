<x-layout-dashboard title="Phonebook">
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
                                            class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                            <i class="bi bi-telephone text-green-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h1 class="text-2xl font-bold text-gray-900">Phonebook</h1>
                                            <p class="text-sm text-gray-600">Manage your contacts and phone numbers</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500">Total Contacts</p>
                                            <p class="text-lg font-semibold text-gray-900" id="total-contacts">-</p>
                                        </div>
                                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <i class="bi bi-people text-blue-600 text-xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="px-6 py-4">
                                <div class="flex flex-wrap items-center gap-3">
                                    <form action="{{ route('fetch.groups') }}" method="post" class="inline">
                                        @csrf
                                        <input type="hidden" name="device"
                                            value="{{ Session::has('selectedDevice') ? Session::get('selectedDevice')['device_id'] : '' }}">
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                                            <i class="bi bi-whatsapp mr-2"></i>
                                            Fetch From Device
                                        </button>
                                    </form>

                                    <button type="button" onclick="clearPhonebook()"
                                        class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors">
                                        <i class="bi bi-trash mr-2"></i>
                                        Clear All
                                    </button>

                                    <button type="button" onclick="openPhonebookModal()"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                        <i class="bi bi-plus-lg mr-2"></i>
                                        New Phonebook
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
                    </div>
                </div>
                <!-- Main Content Area - Full Width Split Layout -->
                <div class="phonebook-layout">
                    <!-- Phonebook Sidebar - Left Half -->
                    <div class="phonebook-sidebar">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 phonebook-panel">
                            <!-- Sidebar Header -->
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900">Phonebooks</h3>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="bi bi-folder mr-1"></i>
                                        Groups
                                    </span>
                                </div>
                            </div>

                            <!-- Search -->
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-search text-gray-400"></i>
                                    </div>
                                    <input type="text"
                                        class="search-phonebook w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Search phonebooks...">
                                </div>
                            </div>

                            <!-- Phonebook List -->
                            <div class="phonebook-list-container px-6 py-4">
                                <div class="phone-book-list h-full">
                                    <div
                                        class="d-flex justify-content-center align-items-center load-phonebook text-gray-500 py-8">
                                        <div class="text-center">
                                            <i class="bi bi-folder text-4xl mb-2"></i>
                                            <p>No phonebooks found</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Load More -->
                            <div class="px-6 py-4 border-t border-gray-200">
                                <button
                                    class="load-more w-full py-2 px-4 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors"
                                    data-page="1">
                                    <i class="bi bi-arrow-down mr-2"></i>
                                    Load More
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Contacts Main Content - Right Half -->
                    <div class="phonebook-content">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-200 phonebook-panel">
                            <!-- Content Header -->
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <h3 class="text-lg font-semibold text-gray-900">Contacts</h3>
                                        <button onclick="deleteAllContact()"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors">
                                            <i class="bi bi-trash mr-1"></i>
                                            Delete All
                                        </button>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button
                                            class="add-contact p-2 text-gray-400 hover:text-gray-600 transition-colors"
                                            onclick="addContact()" title="Add Contact">
                                            <i class="bi bi-person-plus"></i>
                                        </button>
                                        <button
                                            class="import-contact p-2 text-gray-400 hover:text-gray-600 transition-colors"
                                            onclick="importContact()" title="Import">
                                            <i class="bi bi-upload"></i>
                                        </button>
                                        <button
                                            class="export-contact p-2 text-gray-400 hover:text-gray-600 transition-colors"
                                            onclick="exportContact()" title="Export">
                                            <i class="bi bi-download"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Search Bar -->
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-search text-gray-400"></i>
                                    </div>
                                    <input type="text"
                                        class="search-contact w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Search contacts...">
                                </div>
                            </div>

                            <!-- Contacts List -->
                            <div class="contacts-list-container px-6 py-4">
                                <div class="contacts-list email-list h-full">
                                    <!-- Contacts will be loaded here -->
                                </div>

                                <!-- Loading/Empty State -->
                                <div
                                    class="d-flex justify-content-center align-items-center h-full process-get-contact text-gray-500">
                                    <div class="text-center">
                                        <i class="bi bi-people text-4xl mb-2"></i>
                                        <p>Please select a phonebook to show contacts</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    {{-- Modal Add Phonebook --}}
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" id="addTag">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-t-xl p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <i class="bi bi-folder-plus text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold">Create New Phonebook</h3>
                        </div>
                        <button type="button" onclick="closePhonebookModal()"
                            class="text-white hover:text-gray-200 transition-colors">
                            <i class="bi bi-x-lg text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <form action="{{ route('tag.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bi bi-folder mr-2"></i>Phonebook Name
                            </label>
                            <input type="text" name="name" id="name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                                placeholder="Enter phonebook name">
                            <p class="mt-2 text-sm text-gray-500 flex items-center">
                                <i class="bi bi-info-circle mr-1"></i>
                                Choose a descriptive name for your phonebook
                            </p>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bi bi-text-paragraph mr-2"></i>Description (Optional)
                            </label>
                            <textarea name="description" id="description" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                                placeholder="Enter a description for this phonebook"></textarea>
                        </div>

                        <div class="flex items-center justify-end space-x-3 pt-4">
                            <button type="button" onclick="closePhonebookModal()"
                                class="px-6 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                <i class="bi bi-x-circle mr-2"></i>Cancel
                            </button>
                            <button type="submit" name="submit"
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 flex items-center">
                                <i class="bi bi-check-circle mr-2"></i>Create Phonebook
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Add Contact --}}
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" id="addContact">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-t-xl p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <i class="bi bi-person-plus text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold">Add New Contact</h3>
                        </div>
                        <button type="button" onclick="closeContactModal()"
                            class="text-white hover:text-gray-200 transition-colors">
                            <i class="bi bi-x-lg text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <form class="add-contact-form" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label for="contact-name" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bi bi-person mr-2"></i>Contact Name
                            </label>
                            <input type="text" name="name" id="contact-name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-200"
                                placeholder="Enter contact name">
                        </div>

                        <div>
                            <label for="contact-number" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bi bi-phone mr-2"></i>Phone Number
                            </label>
                            <input type="number" name="number" id="contact-number" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-200"
                                placeholder="Enter phone number">
                        </div>

                        <input type="hidden" class="input_phonebookid" name="tag_id" value="">

                        <div class="flex items-center justify-end space-x-3 pt-4">
                            <button type="button" onclick="closeContactModal()"
                                class="px-6 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                <i class="bi bi-x-circle mr-2"></i>Cancel
                            </button>
                            <button type="submit" name="submit"
                                class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200 flex items-center add-contact">
                                <i class="bi bi-check-circle mr-2"></i>Add Contact
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Import Contacts --}}
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" id="importContacts">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-orange-600 to-orange-700 text-white rounded-t-xl p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <i class="bi bi-upload text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold">Import Contacts</h3>
                        </div>
                        <button type="button" onclick="closeImportModal()"
                            class="text-white hover:text-gray-200 transition-colors">
                            <i class="bi bi-x-lg text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <form id="import-contact-form" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label for="fileContacts" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bi bi-file-earmark-excel mr-2"></i>Excel File (.xlsx)
                            </label>
                            <input accept=".xlsx" type="file" name="fileContacts" id="fileContacts" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors duration-200">
                            <p class="mt-2 text-sm text-gray-500 flex items-center">
                                <i class="bi bi-info-circle mr-1"></i>
                                Please upload an Excel file (.xlsx) with contact data
                            </p>
                        </div>

                        <input type="hidden" name="tag_id" value="" class="import_phonebookid">

                        <div class="flex items-center justify-end space-x-3 pt-4">
                            <button type="button" onclick="closeImportModal()"
                                class="px-6 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                <i class="bi bi-x-circle mr-2"></i>Cancel
                            </button>
                            <button type="submit" name="submit"
                                class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg transition-colors duration-200 flex items-center">
                                <i class="bi bi-check-circle mr-2"></i>Import Contacts
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <style>
        /* Phonebook Layout - Full Width Split */
        .phonebook-layout {
            display: flex;
            gap: 1.5rem;
            width: 100%;
            height: calc(100vh - 200px);
            min-height: 600px;
        }

        /* Phonebook Sidebar - Left Half */
        .phonebook-sidebar {
            flex: 0 0 calc(50% - 0.75rem);
            max-width: calc(50% - 0.75rem);
            display: flex;
            flex-direction: column;
        }

        /* Phonebook Content - Right Half */
        .phonebook-content {
            flex: 0 0 calc(50% - 0.75rem);
            max-width: calc(50% - 0.75rem);
            display: flex;
            flex-direction: column;
        }

        /* Panel Styling */
        .phonebook-panel {
            height: 100%;
            display: flex;
            flex-direction: column;
            min-height: 600px;
        }

        /* List Containers */
        .phonebook-list-container {
            flex: 1;
            overflow: hidden;
            min-height: 0;
        }

        .contacts-list-container {
            flex: 1;
            overflow: hidden;
            min-height: 0;
        }

        /* Scrollable Lists */
        .phone-book-list {
            height: 100%;
            overflow-y: auto;
        }

        .contacts-list {
            height: 100%;
            overflow-y: auto;
            max-height: 100%;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .phonebook-layout {
                gap: 1rem;
            }

            .phonebook-sidebar,
            .phonebook-content {
                flex: 0 0 calc(50% - 0.5rem);
                max-width: calc(50% - 0.5rem);
            }
        }

        @media (max-width: 992px) {
            .phonebook-layout {
                flex-direction: column;
                height: auto;
                min-height: auto;
            }

            .phonebook-sidebar,
            .phonebook-content {
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 1rem;
            }

            .phonebook-panel {
                min-height: 400px;
            }
        }

        @media (max-width: 768px) {
            .phonebook-layout {
                gap: 0.75rem;
            }

            .phonebook-panel {
                min-height: 350px;
            }
        }

        /* Custom Scrollbar */
        .phone-book-list::-webkit-scrollbar,
        .contacts-list::-webkit-scrollbar {
            width: 6px;
        }

        .phone-book-list::-webkit-scrollbar-track,
        .contacts-list::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .phone-book-list::-webkit-scrollbar-thumb,
        .contacts-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .phone-book-list::-webkit-scrollbar-thumb:hover,
        .contacts-list::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Ensure proper spacing */
        .phonebook-layout>div {
            position: relative;
        }

        /* Shadow and border improvements */
        .phonebook-panel {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: box-shadow 0.3s ease;
        }

        .phonebook-panel:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>

    <script src="{{ asset('js/phonebook.js') }}"></script>

    <script>
        // Custom Modal Functions (like in home page)
        function openPhonebookModal() {
            document.getElementById('addTag').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePhonebookModal() {
            document.getElementById('addTag').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openContactModal() {
            document.getElementById('addContact').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeContactModal() {
            document.getElementById('addContact').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openImportModal() {
            document.getElementById('importContacts').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImportModal() {
            document.getElementById('importContacts').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Close modal when clicking outside
            document.getElementById('addTag').addEventListener('click', function(e) {
                if (e.target === this) {
                    closePhonebookModal();
                }
            });

            document.getElementById('addContact').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeContactModal();
                }
            });

            document.getElementById('importContacts').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeImportModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closePhonebookModal();
                    closeContactModal();
                    closeImportModal();
                }
            });


            // Add Contact function
            window.addContact = function() {
                openContactModal();
            };

            // Import Contact function
            window.importContact = function() {
                openImportModal();
            };

            // Export Contact function - using existing function from phonebook.js
            // The exportContact() function is already defined in phonebook.js

            // Debug: Check if exportContact function exists
            console.log('exportContact function exists:', typeof exportContact);

            // Clear Phonebook function - using existing function from phonebook.js
            // The clearPhonebook() function is already defined in phonebook.js

            // Delete All Contact function - using existing function from phonebook.js
            // The deleteAllContact() function is already defined in phonebook.js

            // Form validation for Add Phonebook
            const addPhonebookForm = document.querySelector('#addTag form');
            if (addPhonebookForm) {
                addPhonebookForm.addEventListener('submit', function(e) {
                    const nameInput = document.getElementById('name');
                    const name = nameInput.value.trim();

                    if (!name) {
                        e.preventDefault();
                        alert('Please enter a phonebook name');
                        nameInput.focus();
                        return false;
                    }

                    if (name.length < 3) {
                        e.preventDefault();
                        alert('Phonebook name must be at least 3 characters long');
                        nameInput.focus();
                        return false;
                    }

                    // Show loading state
                    const submitBtn = addPhonebookForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split mr-2"></i>Creating...';
                    submitBtn.disabled = true;

                    // Re-enable button after 3 seconds (fallback)
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 3000);
                });
            }

            // Form validation for Add Contact
            const addContactForm = document.querySelector('#addContact form');
            if (addContactForm) {
                addContactForm.addEventListener('submit', function(e) {
                    const nameInput = document.querySelector('#addContact input[name="name"]');
                    const numberInput = document.querySelector('#addContact input[name="number"]');

                    if (!nameInput.value.trim()) {
                        e.preventDefault();
                        alert('Please enter a contact name');
                        nameInput.focus();
                        return false;
                    }

                    if (!numberInput.value.trim()) {
                        e.preventDefault();
                        alert('Please enter a phone number');
                        numberInput.focus();
                        return false;
                    }
                });
            }

            // Search functionality
            document.querySelectorAll('.search-phonebook, .search-contact').forEach(input => {
                input.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    console.log('Searching for:', searchTerm);
                    // Add search logic here
                });
            });

        });
    </script>
</x-layout-dashboard>
