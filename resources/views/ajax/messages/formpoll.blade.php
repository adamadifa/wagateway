<div class="space-y-6">
    <!-- Poll Question -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-question-circle mr-2"></i>Poll Question
        </label>
        <textarea name="name" id="name" rows="3"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200 resize-none"
            placeholder="Enter your poll question..." required></textarea>
        <p class="mt-1 text-xs text-gray-500">Enter the question for your poll</p>
    </div>

    <!-- Poll Settings -->
    <div>
        <label for="countable" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-person-check mr-2"></i>Voting Settings
        </label>
        <select name="countable" id="countable"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200">
            <option value="1" selected>One vote per number</option>
            <option value="0">Multiple votes allowed</option>
        </select>
        <p class="mt-1 text-xs text-gray-500">Choose whether each number can vote only once or multiple times</p>
    </div>

    <!-- Poll Options -->
    <div>
        <div class="flex items-center justify-between mb-3">
            <label class="block text-sm font-medium text-gray-700">
                <i class="bi bi-list-ul mr-2"></i>Poll Options
            </label>
            <div class="flex space-x-2">
                <button type="button" id="addoption"
                    class="inline-flex items-center px-3 py-2 bg-dark-blue-600 hover:bg-dark-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="bi bi-plus mr-1"></i>
                    Add Option
                </button>
                <button type="button" id="reduceoption"
                    class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="bi bi-dash mr-1"></i>
                    Remove Option
                </button>
            </div>
        </div>

        <div class="poll-area space-y-3">
            <!-- Options will be added here dynamically -->
        </div>

        <p class="mt-2 text-xs text-gray-500">Add 2-5 options for your poll. Use the buttons above to add or remove
            options.</p>
    </div>
</div>

<script>
    $(document).ready(function() {
        var max_fields = 5; //maximum input boxes allowed
        var wrapper = $(".poll-area"); //Fields wrapper
        var add_button = $("#addoption"); //Add button ID
        var x = 0; //initial text box count

        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment

                $(wrapper).append(`
                    <div class="form-group optioninput bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <label for="option[${x}]" class="block text-sm font-medium text-gray-700 mb-2">
                            Option ${x}
                        </label>
                        <input type="text" 
                               name="option[${x}]" 
                               id="option[${x}]" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
                               placeholder="Enter option ${x}..."
                               required>
                    </div>
                `);
            } else {
                showNotification('warning', 'Warning', 'Maximum 5 options allowed');
            }
        });

        // reduce button when click
        $(document).on('click', '#reduceoption', function(e) {
            e.preventDefault();
            if (x > 0) {
                $('.optioninput').last().remove();
                x--;
            }
        });
    });
</script>
