<x-layout-dashboard title="User Management">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
            <p class="text-gray-600 mt-1">Manage users, subscriptions, and device limits</p>
        </div>
        <div class="flex items-center space-x-2 text-sm text-gray-500">
            <i class="bi bi-people w-4 h-4"></i>
            <span>Admin Panel</span>
        </div>
    </div>
    <!-- Alert Messages -->
    @if (session()->has('alert'))
        <div
            class="mb-6 p-4 rounded-lg {{ session('alert')['type'] === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
            <div class="flex items-center">
                <i
                    class="bi bi-{{ session('alert')['type'] === 'success' ? 'check-circle' : 'exclamation-triangle' }} mr-2"></i>
                <span>{{ session('alert')['msg'] }}</span>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 border border-red-200">
            <div class="flex items-start">
                <i class="bi bi-exclamation-triangle mr-2 mt-0.5"></i>
                <div>
                    <h4 class="font-semibold mb-2">Please fix the following errors:</h4>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif




    <!-- Users Management Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg mr-3">
                        <i class="bi bi-people text-blue-600 w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Users Management</h3>
                        <p class="text-sm text-gray-600">Manage user accounts and subscriptions</p>
                    </div>
                </div>
                <button type="button" onclick="addUser()"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 flex items-center">
                    <i class="bi bi-plus-circle mr-2"></i>
                    Add User
                </button>
            </div>
            <!-- Users Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">Username</th>
                            <th scope="col" class="px-6 py-3 font-medium">Email</th>
                            <th scope="col" class="px-6 py-3 font-medium">Total Device</th>
                            <th scope="col" class="px-6 py-3 font-medium">Limit Device</th>
                            <th scope="col" class="px-6 py-3 font-medium">Subscription</th>
                            <th scope="col" class="px-6 py-3 font-medium">Expired Date</th>
                            <th scope="col" class="px-6 py-3 font-medium text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $user->username }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $user->total_device }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $user->limit_device }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        if ($user->is_expired_subscription) {
                                            $badgeClass = 'bg-red-100 text-red-800';
                                        } else {
                                            $badgeClass = 'bg-green-100 text-green-800';
                                        }
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
                                        {{ ucfirst($user->active_subscription) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    @if ($user->is_expired_subscription)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Expired
                                        </span>
                                    @else
                                        @if ($user->active_subscription == 'active')
                                            {{ $user->subscription_expired }}
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                -
                                            </span>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button onclick="editUser({{ $user->id }})"
                                            class="text-blue-600 hover:text-blue-800 transition-colors p-1 rounded"
                                            title="Edit user">
                                            <i class="bi bi-pencil-square w-4 h-4"></i>
                                        </button>
                                        <form action="{{ route('user.delete', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this user? All user data will also be deleted.')"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 transition-colors p-1 rounded"
                                                title="Delete user">
                                                <i class="bi bi-trash w-4 h-4"></i>
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
            <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
                <div class="text-sm text-gray-700">
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                </div>
                <nav class="flex items-center space-x-2">
                    @if ($users->currentPage() > 1)
                        <a href="{{ $users->previousPageUrl() }}"
                            class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700 transition-colors">
                            Previous
                        </a>
                    @endif

                    @for ($i = max(1, $users->currentPage() - 2); $i <= min($users->lastPage(), $users->currentPage() + 2); $i++)
                        <a href="{{ $users->url($i) }}"
                            class="px-3 py-2 text-sm font-medium {{ $users->currentPage() == $i ? 'text-white bg-blue-600 border border-blue-600' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-50 hover:text-gray-700' }} rounded-lg transition-colors">
                            {{ $i }}
                        </a>
                    @endfor

                    @if ($users->currentPage() < $users->lastPage())
                        <a href="{{ $users->nextPageUrl() }}"
                            class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700 transition-colors">
                            Next
                        </a>
                    @endif
                </nav>
            </div>
        </div>
    </div>


    <!-- User Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" id="modalUser">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-t-xl p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 p-2 rounded-lg">
                                <i class="bi bi-person-plus text-xl" id="modalIcon"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold" id="modalLabel">Add User</h3>
                                <p class="text-sm text-blue-100" id="modalSubtitle">Create a new user account</p>
                            </div>
                        </div>
                        <button type="button" onclick="closeUserModal()"
                            class="text-white hover:text-gray-200 transition-colors">
                            <i class="bi bi-x-lg text-xl"></i>
                        </button>
                    </div>
                </div>
                <!-- Modal Body -->
                <div class="p-6 bg-gray-50">
                    <form action="" method="POST" enctype="multipart/form-data" id="formUser"
                        class="space-y-6">
                        @csrf
                        <input type="hidden" id="iduser" name="id">

                        <!-- Basic Information Section -->
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <h6 class="text-sm font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="bi bi-person-circle mr-2 text-blue-600"></i>
                                Basic Information
                            </h6>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Username -->
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                                        Username <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-person text-gray-400"></i>
                                        </div>
                                        <input type="text" name="username" id="username"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                            placeholder="Enter username" required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-envelope text-gray-400"></i>
                                        </div>
                                        <input type="email" name="email" id="email"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                            placeholder="Enter email address" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2"
                                    id="labelpassword">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" name="password" id="password"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                        placeholder="Enter password" required>
                                </div>
                            </div>
                        </div>

                        <!-- Device & Subscription Section -->
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <h6 class="text-sm font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="bi bi-gear-circle mr-2 text-green-600"></i>
                                Device & Subscription Settings
                            </h6>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Limit Device -->
                                <div>
                                    <label for="limit_device" class="block text-sm font-medium text-gray-700 mb-2">
                                        Device Limit <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-phone text-gray-400"></i>
                                        </div>
                                        <input type="number" name="limit_device" id="limit_device" min="1"
                                            max="10"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                            placeholder="Max 10" required>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Maximum number of devices allowed</p>
                                </div>

                                <!-- Subscription Status -->
                                <div>
                                    <label for="active_subscription"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        Subscription Status <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-shield-check text-gray-400"></i>
                                        </div>
                                        <select name="active_subscription" id="active_subscription"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors appearance-none">
                                            <option value="active" selected>Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="lifetime">Lifetime</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Subscription Expired -->
                            <div class="mt-4">
                                <label for="subscription_expired"
                                    class="block text-sm font-medium text-gray-700 mb-2">
                                    Subscription Expired Date
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-calendar-event text-gray-400"></i>
                                    </div>
                                    <input type="date" name="subscription_expired" id="subscription_expired"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Leave empty for lifetime subscription</p>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal Footer -->
                <div class="bg-white border-t border-gray-200 rounded-b-xl p-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500 flex items-center">
                            <i class="bi bi-info-circle mr-1"></i>
                            <span id="modalHelpText">All fields marked with * are required</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button type="button" onclick="closeUserModal()"
                                class="px-6 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                <i class="bi bi-x-circle mr-2"></i>Cancel
                            </button>
                            <button type="submit" form="formUser" id="modalButton"
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 flex items-center">
                                <i class="bi bi-check-circle mr-2"></i>
                                <span>Add User</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <script>
        // Custom Modal Functions (like in phonebook page)
        function openUserModal() {
            document.getElementById('modalUser').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeUserModal() {
            document.getElementById('modalUser').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        $(document).ready(function() {
            // Add User Function
            function addUser() {
                $('#modalLabel').html('Add User');
                $('#modalSubtitle').html('Create a new user account');
                $('#modalIcon').removeClass('bi-person-gear').addClass('bi-person-plus');
                $('#modalButton').html('<i class="bi bi-check-circle mr-2"></i><span>Add User</span>');
                $('#modalHelpText').html('All fields marked with * are required');
                $('#formUser').attr('action', '{{ route('user.store') }}');

                // Reset form
                $('#formUser')[0].reset();
                $('#labelpassword').html(
                    '<i class="bi bi-lock mr-2"></i>Password <span class="text-red-500">*</span>');
                $('#iduser').val('');

                openUserModal();
            }

            // Edit User Function
            function editUser(id) {
                $('#modalLabel').html('Edit User');
                $('#modalSubtitle').html('Update user account information');
                $('#modalIcon').removeClass('bi-person-plus').addClass('bi-person-gear');
                $('#modalButton').html('<i class="bi bi-check-circle mr-2"></i><span>Update User</span>');
                $('#modalHelpText').html('Password field can be left blank to keep current password');
                $('#formUser').attr('action', '{{ route('user.update') }}');
                $('#labelpassword').html('<i class="bi bi-lock mr-2"></i>Password *(leave blank if not change)');

                openUserModal();

                $.ajax({
                    url: "{{ route('user.edit') }}",
                    type: "GET",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#username').val(data.username);
                        $('#email').val(data.email);
                        $('#password').val('');
                        $('#limit_device').val(data.limit_device);
                        $('#active_subscription').val(data.active_subscription);
                        $('#subscription_expired').val(data.subscription_expired);
                        $('#iduser').val(data.id);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading user data:', error);
                        alert('Failed to load user data. Please try again.');
                    }
                });
            }

            // Form validation
            $('#formUser').on('submit', function(e) {
                const submitBtn = $('#modalButton');
                const originalText = submitBtn.html();

                // Add loading state
                submitBtn.prop('disabled', true);
                submitBtn.html('<i class="bi bi-hourglass-split mr-2"></i>Processing...');

                // Re-enable button after 3 seconds (in case of errors)
                setTimeout(() => {
                    submitBtn.prop('disabled', false);
                    submitBtn.html(originalText);
                }, 3000);
            });

            // Make functions global
            window.addUser = addUser;
            window.editUser = editUser;

            // Auto-refresh table every 30 seconds
            setInterval(function() {
                console.log('Auto-refreshing user table...');
                // You can add AJAX call here to refresh table data
            }, 30000);
        });

        // Close modal when clicking outside
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('modalUser').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeUserModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeUserModal();
                }
            });
        });
    </script>
</x-layout-dashboard>
