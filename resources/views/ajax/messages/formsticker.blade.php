<div class="space-y-6">
    <!-- Sticker Image URL -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-emoji-smile mr-2"></i>Sticker Image URL
        </label>
        <div class="flex">
            <button type="button" id="image-sticker" data-input="thumbnail-sticker" data-preview="holder"
                class="inline-flex items-center px-4 py-2 bg-dark-blue-600 hover:bg-dark-blue-700 text-white font-medium rounded-l-lg border border-dark-blue-600 transition-colors duration-200">
                <i class="bi bi-image mr-2"></i>
                Choose Image
            </button>
            <input id="thumbnail-sticker" type="text" name="url"
                class="flex-1 border border-gray-300 rounded-r-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
                placeholder="Enter sticker image URL or choose file...">
        </div>
        <p class="mt-1 text-xs text-gray-500">Upload a sticker image or enter a direct URL to the image file</p>
    </div>

    <!-- Preview Area -->
    <div id="sticker-preview" class="hidden">
        <label class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-eye mr-2"></i>Preview
        </label>
        <div class="bg-gray-50 rounded-lg border border-gray-300 p-4 text-center">
            <img id="preview-image" src="" alt="Sticker Preview" class="max-w-xs mx-auto rounded-lg">
        </div>
    </div>
</div>

<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#image-sticker').filemanager('file')

    // Preview functionality
    $('#thumbnail-sticker').on('input', function() {
        const url = $(this).val();
        if (url && (url.includes('.jpg') || url.includes('.jpeg') || url.includes('.png') || url.includes(
                '.gif') || url.includes('.webp'))) {
            $('#preview-image').attr('src', url);
            $('#sticker-preview').removeClass('hidden');
        } else {
            $('#sticker-preview').addClass('hidden');
        }
    });
</script>
