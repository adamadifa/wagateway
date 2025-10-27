<div class="space-y-6">
    <!-- Contact Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-person mr-2"></i>Contact Name
        </label>
        <input type="text" name="name" id="name"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
            placeholder="Enter contact name (e.g., John Wick)" required>
        <p class="mt-1 text-xs text-gray-500">Enter the name of the contact</p>
    </div>

    <!-- Phone Number -->
    <div>
        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-telephone mr-2"></i>Phone Number
        </label>
        <input type="tel" name="phone" id="phone"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
            placeholder="Enter phone number (e.g., 6281234567890)" inputmode="numeric" pattern="[0-9]*" required>
        <p class="mt-1 text-xs text-gray-500">Enter the phone number with country code (numbers only)</p>
    </div>
</div>

<script>
    (function($) {
        const numberInput = document.getElementById('phone');
        numberInput.addEventListener('input', function(e) {
            let inputValue = this.value.replace(/[^0-9]/g, '');
            this.value = inputValue;
        }, {
            passive: true
        });
    })(jQuery);
</script>
