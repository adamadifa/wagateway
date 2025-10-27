@foreach ($phonebooks as $phonebook)
    <div class="phonebook-item mb-3">
        <div
            class="bg-white rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center justify-between p-4">
                <!-- Phonebook Info -->
                <div class="flex items-center space-x-3 flex-1">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-semibold text-sm">
                        {{ strtoupper(substr($phonebook->name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <a onclick="clickPhoneBook({{ $phonebook->id }}, this)" href="javascript:;"
                            data-phonebook-id="{{ $phonebook->id }}" class="single-phonebook block">
                            <h4
                                class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors truncate">
                                {{ $phonebook->name }}
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">
                                ID: {{ $phonebook->id }}
                            </p>
                        </a>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center space-x-2">
                    <!-- Contact Count Badge -->
                    <span
                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                        <i class="bi bi-people mr-1"></i>
                        <span class="contact-count">-</span>
                    </span>

                    <!-- Delete Button -->
                    <form action="{{ route('tag.delete') }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this phonebook? All contacts in this phonebook will also be deleted!')"
                        class="inline">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="id" value="{{ $phonebook->id }}">
                        <button type="submit" name="delete"
                            class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all duration-200 group/delete"
                            title="Delete Phonebook">
                            <i class="bi bi-trash text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Additional Info (Hidden by default, shown on hover) -->
            <div class="px-4 pb-3 border-t border-gray-100 group-hover:block hidden">
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span class="flex items-center">
                        <i class="bi bi-calendar mr-1"></i>
                        Created: {{ $phonebook->created_at ? $phonebook->created_at->format('M d, Y') : 'Unknown' }}
                    </span>
                    <span class="flex items-center">
                        <i class="bi bi-clock mr-1"></i>
                        Updated: {{ $phonebook->updated_at ? $phonebook->updated_at->diffForHumans() : 'Never' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Empty State -->
@if ($phonebooks->isEmpty())
    <div class="text-center py-12">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="bi bi-folder text-2xl text-gray-400"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No Phonebooks Found</h3>
        <p class="text-gray-500 mb-4">Get started by creating your first phonebook</p>
        <button type="button" data-bs-toggle="modal" data-bs-target="#addTag"
            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
            <i class="bi bi-plus-lg mr-2"></i>
            Create Phonebook
        </button>
    </div>
@endif

<style>
    /* Phonebook Item Styling */
    .phonebook-item {
        position: relative;
    }

    .phonebook-item:hover .group-hover\:block {
        display: block !important;
    }

    /* Smooth transitions */
    .phonebook-item .bg-white {
        transition: all 0.2s ease-in-out;
    }

    .phonebook-item:hover .bg-white {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Delete button hover effect */
    .group\/delete:hover {
        background-color: #fef2f2;
        color: #dc2626;
    }

    /* Contact count animation */
    .contact-count {
        transition: all 0.2s ease;
    }

    /* Phonebook name hover effect */
    .single-phonebook:hover h4 {
        color: #2563eb !important;
    }

    /* Gradient background for avatar */
    .bg-gradient-to-br {
        background-image: linear-gradient(135deg, #3b82f6, #1d4ed8);
    }

    /* Custom scrollbar for phonebook list */
    .phone-book-list::-webkit-scrollbar {
        width: 4px;
    }

    .phone-book-list::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 2px;
    }

    .phone-book-list::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 2px;
    }

    .phone-book-list::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
