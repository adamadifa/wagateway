<div class="space-y-6">
    <!-- Message -->
    <div>
        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-chat-text mr-2"></i>Message
        </label>
        <textarea name="message" id="message" rows="4"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200 resize-none"
            placeholder="Enter your message..." required></textarea>
    </div>

    <!-- Footer -->
    <div>
        <label for="footer" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-text-paragraph mr-2"></i>Footer Message
            <span class="text-xs text-gray-500 ml-1">(Optional)</span>
        </label>
        <input type="text" name="footer" id="footer"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
            placeholder="Enter footer message...">
    </div>

    <!-- Image -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-image mr-2"></i>Image
            <span class="text-xs text-gray-500 ml-1">(Optional)</span>
        </label>
        <div class="flex">
            <button type="button" id="image" data-input="thumbnail" data-preview="holder"
                class="inline-flex items-center px-4 py-2 bg-dark-blue-600 hover:bg-dark-blue-700 text-white font-medium rounded-l-lg border border-dark-blue-600 transition-colors duration-200">
                <i class="bi bi-image mr-2"></i>
                Choose Image
            </button>
            <input id="thumbnail" type="text" name="image"
                class="flex-1 border border-gray-300 rounded-r-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
                placeholder="Enter image URL or choose file...">
        </div>
    </div>

    <!-- Buttons -->
    <div>
        <div class="flex items-center justify-between mb-3">
            <label class="block text-sm font-medium text-gray-700">
                <i class="bi bi-hand-index mr-2"></i>Interactive Buttons
            </label>
            <div class="flex space-x-2">
                <button type="button" id="addbutton"
                    class="inline-flex items-center px-3 py-2 bg-dark-blue-600 hover:bg-dark-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="bi bi-plus mr-1"></i>
                    Add Button
                </button>
                <button type="button" id="reduceButton"
                    class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="bi bi-dash mr-1"></i>
                    Remove Button
                </button>
            </div>
        </div>

        <div class="button-area space-y-4">
            <!-- Buttons will be added here dynamically -->
        </div>

        <p class="mt-2 text-xs text-gray-500">Add 1-3 interactive buttons. Each button can be a reply, call, URL, or
            copy action.</p>
    </div>
</div>

<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $(document).ready(function() {
        $('#image').filemanager('file');
        var max_fields = 3; // Maximum number of buttons allowed
        var wrapper = $(".button-area"); // Wrapper for button forms
        var add_button = $("#addbutton"); // Add button ID
        var x = 0; // Initial button count

        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++; // Increment button count

                var buttonForm = `
                <div class="form-group buttoninput bg-gray-50 rounded-lg p-4 border border-gray-200" id="buttonGroup${x}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="buttonType${x}" class="block text-sm font-medium text-gray-700 mb-2">
                                Button ${x} Type
                            </label>
                            <select name="button[${x}][type]" 
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200 buttonType" 
                                    id="buttonType${x}" 
                                    data-index="${x}" 
                                    required>
                                <option value="reply">Reply</option>
                                <option value="call">Call</option>
                                <option value="url">URL</option>
                                <option value="copy">Copy</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="buttonDisplayText${x}" class="block text-sm font-medium text-gray-700 mb-2">
                                Display Text
                            </label>
                            <input type="text" 
                                   name="button[${x}][displayText]" 
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200" 
                                   id="buttonDisplayText${x}" 
                                   placeholder="Enter button text..."
                                   required>
                        </div>
                    </div>

                    <div class="additionalFields mt-4" id="additionalFields${x}"></div>
                    
                    <div class="mt-4 flex justify-end">
                        <button type="button" 
                                class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 removeButton" 
                                data-index="${x}">
                            <i class="bi bi-trash mr-1"></i>
                            Remove Button
                        </button>
                    </div>
                </div>
            `;
                $(wrapper).append(buttonForm);
            } else {
                showNotification('warning', 'Warning', 'Maximum of 3 buttons allowed');
            }
        });

        // Handle button type change to display relevant additional fields
        $(document).on('change', '.buttonType', function() {
            var index = $(this).data('index');
            var selectedType = $(this).val();
            var additionalFields = $(`#additionalFields${index}`);

            additionalFields.empty(); // Clear existing fields

            if (selectedType === 'call') {
                additionalFields.append(`
                <div>
                    <label for="phoneNumber${index}" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="bi bi-telephone mr-2"></i>Phone Number
                    </label>
                    <input type="text" 
                           name="button[${index}][phoneNumber]" 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200" 
                           id="phoneNumber${index}" 
                           placeholder="Enter phone number..."
                           required>
                </div>
            `);
            } else if (selectedType === 'url') {
                additionalFields.append(`
                <div>
                    <label for="url${index}" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="bi bi-link-45deg mr-2"></i>URL
                    </label>
                    <input type="text" 
                           name="button[${index}][url]" 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200" 
                           id="url${index}" 
                           placeholder="Enter URL..."
                           required>
                </div>
            `);
            } else if (selectedType === 'copy') {
                additionalFields.append(`
                <div>
                    <label for="copyText${index}" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="bi bi-clipboard mr-2"></i>Copy Text
                    </label>
                    <input type="text" 
                           name="button[${index}][copyCode]" 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200" 
                           id="copyText${index}" 
                           placeholder="Enter text to copy..."
                           required>
                </div>
            `);
            }
        });

        // Remove button form
        $(document).on('click', '.removeButton', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            $(`#buttonGroup${index}`).remove();
            x--; // Decrement button count
        });
    });
</script>
