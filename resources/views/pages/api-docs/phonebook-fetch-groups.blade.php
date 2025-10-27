<div class="tab-pane" id="phonebook-fetch-groups" role="tabpanel">
    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="bi bi-people text-blue-600 text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Fetch Groups API</h2>
                    <p class="text-sm text-gray-600">Mengambil grup WhatsApp dari device yang terhubung</p>
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
                    <code class="bg-gray-100 text-gray-800 px-3 py-1 rounded text-sm">{{ env('APP_URL') }}/api/en/api-fetch-groups</code>
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">number</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Yes</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">Nomor device yang akan digunakan untuk mengambil grup</td>
                            </tr>
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
                    <pre class="text-green-400 text-sm overflow-x-auto"><code>curl -X POST "{{ env('APP_URL') }}/api/en/api-fetch-groups" \
  -H "Content-Type: application/json" \
  -d '{
    "number": "6281234567890",
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
  "message": "Groups fetched successfully",
  "data": {
    "groups": [
      {
        "group_id": "120363123456789012@g.us",
        "group_name": "Nama Grup",
        "tag_id": 1,
        "tag_name": "Nama Grup (ID: 120363123456789012@g.us)",
        "participants_count": 5,
        "contacts": [
          {
            "id": 1,
            "tag_id": 1,
            "name": "6281234567890",
            "number": "6281234567890",
            "created_at": "2024-01-01T00:00:00.000000Z"
          }
        ]
      }
    ],
    "total_groups": 1,
    "device_number": "6281234567890",
    "device_name": "6281234567890"
  }
}</code></pre>
                </div>
            </div>

            <!-- Error Responses -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Error Responses</h3>
                <div class="space-y-4">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-red-800 mb-2">Device Not Connected (400)</h4>
                        <div class="bg-gray-900 rounded p-3">
                            <pre class="text-red-400 text-sm"><code>{
  "status": false,
  "message": "Device is not connected"
}</code></pre>
                        </div>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-red-800 mb-2">Device Not Found (404)</h4>
                        <div class="bg-gray-900 rounded p-3">
                            <pre class="text-red-400 text-sm"><code>{
  "status": false,
  "message": "Device not found or not authorized"
}</code></pre>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cara Akses API -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Cara Akses API</h3>
                <div class="space-y-4">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-blue-800 mb-2">1. Dapatkan API Key</h4>
                        <p class="text-sm text-blue-700 mb-2">Login ke dashboard dan buka menu Settings > API Key untuk mendapatkan API key Anda.</p>
                    </div>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-blue-800 mb-2">2. Pastikan Device Terhubung</h4>
                        <p class="text-sm text-blue-700 mb-2">Device harus dalam status "Connected" sebelum dapat mengambil grup WhatsApp.</p>
                    </div>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-blue-800 mb-2">3. Gunakan Nomor Device</h4>
                        <p class="text-sm text-blue-700 mb-2">Parameter "number" harus sesuai dengan nomor device yang terdaftar di dashboard Anda.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <h4 class="text-sm font-medium text-yellow-800 mb-2">Important Notes</h4>
                <ul class="text-sm text-yellow-700 space-y-1">
                    <li>• Device harus dalam status "Connected" sebelum melakukan fetch groups</li>
                    <li>• Data groups di-cache selama 60 menit untuk performa yang lebih baik</li>
                    <li>• Hindari melakukan fetch groups terlalu sering</li>
                    <li>• Pastikan API key valid dan memiliki akses ke device yang diminta</li>
                </ul>
            </div>
        </div>
    </div>
</div>
