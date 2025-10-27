<div class="tab-pane" id="phonebook-clear" role="tabpanel">
    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="bi bi-trash text-red-600 text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Clear Phonebook API</h2>
                    <p class="text-sm text-gray-600">Menghapus semua data phonebook</p>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-6">
            <!-- Method & Endpoint -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">HTTP Method</label>
                    <div class="flex space-x-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            POST
                        </span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Endpoint</label>
                    <code class="bg-gray-100 text-gray-800 px-3 py-1 rounded text-sm">{{ env('APP_URL') }}/api/en/api-clear-phonebook</code>
                </div>
            </div>

            <!-- Parameters Table -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Parameters</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parameter</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Required</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">api_key</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Yes</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">API key untuk autentikasi</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Request Example -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Request Example</h3>
                <div class="bg-gray-900 rounded-lg p-4">
                    <pre class="text-green-400 text-sm overflow-x-auto"><code>curl -X POST "{{ env('APP_URL') }}/api/en/api-clear-phonebook" \
  -H "Content-Type: application/json" \
  -d '{
    "api_key": "your-api-key-here"
  }'</code></pre>
                </div>
            </div>

            <!-- Response Example -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Response Example</h3>
                <div class="bg-gray-900 rounded-lg p-4">
                    <pre class="text-blue-400 text-sm overflow-x-auto"><code>{
  "status": true,
  "message": "Phonebook cleared successfully"
}</code></pre>
                </div>
            </div>

            <!-- Warning -->
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <h4 class="text-sm font-medium text-red-800 mb-2">⚠️ Warning</h4>
                <ul class="text-sm text-red-700 space-y-1">
                    <li>• Tindakan ini akan menghapus SEMUA data phonebook secara permanen</li>
                    <li>• Tidak dapat dibatalkan setelah dieksekusi</li>
                    <li>• Pastikan Anda sudah membackup data penting sebelum melakukan clear</li>
                    <li>• Semua grup dan kontak akan dihapus dari database</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Cara Akses API -->
    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Cara Akses API</h3>
        <div class="bg-gray-50 rounded-lg p-6">
            <div class="space-y-4">
                <div>
                    <h4 class="font-medium text-gray-900 mb-2">1. Menggunakan cURL</h4>
                    <pre class="bg-gray-800 rounded-lg p-4 text-green-400 text-sm overflow-x-auto"><code>curl -X POST "{{ env('APP_URL') }}/api/en/api-clear-phonebook" \
  -H "Content-Type: application/json" \
  -d '{
    "api_key": "your-api-key-here"
  }'</code></pre>
                </div>

                <div>
                    <h4 class="font-medium text-gray-900 mb-2">2. Menggunakan JavaScript (Fetch API)</h4>
                    <pre class="bg-gray-800 rounded-lg p-4 text-green-400 text-sm overflow-x-auto"><code>fetch('{{ env('APP_URL') }}/api/en/api-clear-phonebook', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    api_key: 'your-api-key-here'
  })
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));</code></pre>
                </div>

                <div>
                    <h4 class="font-medium text-gray-900 mb-2">3. Menggunakan PHP</h4>
                    <pre class="bg-gray-800 rounded-lg p-4 text-green-400 text-sm overflow-x-auto"><code>$data = array('api_key' => 'your-api-key-here');
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);
$context = stream_context_create($options);
$result = file_get_contents('{{ env('APP_URL') }}/api/en/api-clear-phonebook', false, $context);</code></pre>
                </div>
            </div>
        </div>
    </div>
</div>
