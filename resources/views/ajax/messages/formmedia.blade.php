<div class="space-y-6">
    <!-- Media URL -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-link-45deg mr-2"></i>Media URL
        </label>
        <div class="flex">
            <button type="button" id="image" data-input="thumbnail" data-preview="holder"
                class="inline-flex items-center px-4 py-2 bg-dark-blue-600 hover:bg-dark-blue-700 text-white font-medium rounded-l-lg border border-dark-blue-600 transition-colors duration-200">
                <i class="bi bi-image mr-2"></i>
                Choose File
            </button>
            <input id="thumbnail" type="text" name="url"
                class="flex-1 border border-gray-300 rounded-r-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
                placeholder="Enter media URL or choose file...">
        </div>
        <p class="mt-1 text-xs text-gray-500">Enter a direct URL to your media file or use the file manager</p>
    </div>

    <!-- Media Type -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-3">
            <i class="bi bi-file-earmark mr-2"></i>Media Type
        </label>
        <div class="grid grid-cols-2 gap-3">
            <label
                class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                <input type="radio" name="media_type" value="image"
                    class="w-4 h-4 text-dark-blue-600 border-gray-300 focus:ring-dark-blue-500">
                <div class="ml-3">
                    <div class="flex items-center">
                        <i class="bi bi-image text-gray-600 mr-2"></i>
                        <span class="text-sm font-medium text-gray-900">Image</span>
                    </div>
                </div>
            </label>

            <label
                class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                <input type="radio" name="media_type" value="document" checked
                    class="w-4 h-4 text-dark-blue-600 border-gray-300 focus:ring-dark-blue-500">
                <div class="ml-3">
                    <div class="flex items-center">
                        <i class="bi bi-file-earmark-text text-gray-600 mr-2"></i>
                        <span class="text-sm font-medium text-gray-900">Document</span>
                    </div>
                </div>
            </label>

            <label
                class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                <input type="radio" name="media_type" value="video"
                    class="w-4 h-4 text-dark-blue-600 border-gray-300 focus:ring-dark-blue-500">
                <div class="ml-3">
                    <div class="flex items-center">
                        <i class="bi bi-play-circle text-gray-600 mr-2"></i>
                        <span class="text-sm font-medium text-gray-900">Video</span>
                    </div>
                </div>
            </label>

            <label
                class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                <input type="radio" name="media_type" value="audio"
                    class="w-4 h-4 text-dark-blue-600 border-gray-300 focus:ring-dark-blue-500">
                <div class="ml-3">
                    <div class="flex items-center">
                        <i class="bi bi-mic text-gray-600 mr-2"></i>
                        <span class="text-sm font-medium text-gray-900">Voice Note</span>
                    </div>
                </div>
            </label>
        </div>
    </div>

    <!-- Caption -->
    <div>
        <label for="caption" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-chat-text mr-2"></i>Caption
        </label>
        <textarea name="caption" id="caption" rows="4"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200 resize-none"
            placeholder="Enter caption for your media..." required></textarea>
        <p class="mt-1 text-xs text-gray-500">Optional caption that will be displayed with your media</p>
    </div>
</div>

<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#image').filemanager('file')

    $('.type-audio').hide()

    // on media_type change
    // $('input[name="media_type"]').on('change', function() {
    //     let type = $(this).val()
    //     if (type == 'audio') {
    //         $('.type-audio').show()
    //     } else {
    //         $('.type-audio').hide()
    //     }

    //     if (type == 'image' || type == 'video' || type == 'pdf' || type == 'xls' || type ==
    //         'xlsx' || type == 'doc' || type == 'docx' || type == 'zip') {
    //         $('.caption-area').show()
    //     } else {
    //         $('.caption-area').hide()
    //     }
    // })
</script>
