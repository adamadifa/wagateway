<div class="tab-pane" id="sendvcard" role="tabpanel">
    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-cyan-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="bi bi-person text-cyan-600 text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Send VCard API</h2>
                    <p class="text-sm text-gray-600">Send contact card (VCard) messages to WhatsApp numbers</p>
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
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            POST
                        </span>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            GET
                        </span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Endpoint</label>
                    <code
                        class="bg-gray-100 text-gray-800 px-3 py-1 rounded text-sm">{{ env('APP_URL') }}/send-vcard</code>
                </div>
            </div>

            <!-- Parameters Table -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Parameters</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Parameter</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Required</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">api_key</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Yes
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">Your API key for authentication</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">sender</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Yes
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">Number of your WhatsApp device</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">number</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Yes
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">Recipient number (e.g., 62888xxxx|62888xxxx)
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">name</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Yes
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">Contact name (e.g., John Doe)</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">phone</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Yes
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">Contact phone number (e.g., 62888xxxx)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Examples -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- JSON Request Example -->
                <div>
                    <h4 class="text-md font-semibold text-gray-900 mb-3">JSON Request Example</h4>
                    <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                        <pre class="text-green-400 text-sm"><code>{
  "api_key": "1234567890",
  "sender": "62888xxxx",
  "number": "62888xxxx",
  "name": "John Doe",
  "phone": "62888xxxx"
}</code></pre>
                    </div>
                </div>

                <!-- URL Request Example -->
                <div>
                    <h4 class="text-md font-semibold text-gray-900 mb-3">URL Request Example</h4>
                    <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                        <pre class="text-blue-400 text-sm"><code>{{ env('APP_URL') }}/send-vcard?api_key=1234567890&sender=62888xxxx&number=62888xxxx&name=John Doe&phone=62888xxxx</code></pre>
                    </div>
                </div>
            </div>

            <!-- Response Example -->
            <div>
                <h4 class="text-md font-semibold text-gray-900 mb-3">Response Example</h4>
                <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                    <pre class="text-yellow-400 text-sm"><code>{
  "status": "success",
  "message": "VCard sent successfully",
  "message_id": "3EB0C767D26A8B2A"
}</code></pre>
                </div>
            </div>
        </div>
    </div>
</div>
