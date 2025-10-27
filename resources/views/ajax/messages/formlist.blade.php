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

    <!-- Button Text -->
    <div>
        <label for="buttontext" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-hand-index mr-2"></i>Button Text
        </label>
        <input type="text" name="buttontext" id="buttonlist"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
            placeholder="Enter button text...">
        <p class="mt-1 text-xs text-gray-500">Optional button text for the list</p>
    </div>

    <!-- Footer -->
    <div>
        <label for="footer" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-text-paragraph mr-2"></i>Footer
        </label>
        <input type="text" name="footer" id="footer"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
            placeholder="Enter footer text..." required>
    </div>

    <!-- Title -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-list-ul mr-2"></i>List Title
        </label>
        <input type="text" name="title" id="titlelist"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
            placeholder="Enter list title..." required>
    </div>

    <!-- Image -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-image mr-2"></i>List Image (Optional)
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

    <!-- List Items -->
    <div>
        <div class="flex items-center justify-between mb-3">
            <label class="block text-sm font-medium text-gray-700">
                <i class="bi bi-list-ul mr-2"></i>List Items
            </label>
            <div class="flex space-x-2">
                <button type="button" id="addlist"
                    class="inline-flex items-center px-3 py-2 bg-dark-blue-600 hover:bg-dark-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="bi bi-plus mr-1"></i>
                    Add Item
                </button>
                <button type="button" id="reducelist"
                    class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="bi bi-dash mr-1"></i>
                    Remove Item
                </button>
            </div>
        </div>

        <div class="area-list space-y-3">
            <!-- List items will be added here dynamically -->
        </div>

        <p class="mt-2 text-xs text-gray-500">Add 1-5 items to your list. Use the buttons above to add or remove items.
        </p>
    </div>
</div>

<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $(document).ready(function() {
        $('#image').filemanager('file');

        var max_fields = 5; //maximum input boxes allowed
        var wrapper = $(".area-list"); //Fields wrapper
        var add_button = $("#addlist"); //Add button ID
        var x = 0; //initial text box count

        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(`
                    <div class="form-group listinput bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <label for="list${x}" class="block text-sm font-medium text-gray-700 mb-2">
                            List Item ${x}
                        </label>
                        <input type="text" 
                               name="list[${x}]" 
                               id="list${x}" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
                               placeholder="Enter list item ${x}..."
                               required>
                    </div>
                `);
            } else {
                showNotification('warning', 'Warning', 'Maximum 5 list items allowed');
            }
        });

        // reduce list when click
        $(document).on('click', '#reducelist', function(e) {
            e.preventDefault();
            if (x > 0) {
                $('.listinput').last().remove();
                x--;
            }
        });
    });
</script>
