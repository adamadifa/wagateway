<div class="tab-pane" id="sendbutton" role="tabpanel">
    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="bi bi-hand-index text-indigo-600 text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Send Button API</h2>
                    <p class="text-sm text-gray-600">Send interactive button messages to WhatsApp numbers</p>
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
                        class="bg-gray-100 text-gray-800 px-3 py-1 rounded text-sm">{{ env('APP_URL') }}/send-button</code>
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">message</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Yes
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">Main message text</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">button</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">array</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Yes
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">Array of button objects (max 5 buttons)</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">footer</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        No
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">Footer text for the message</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">url/image</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        No
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">URL to image or video (optional)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Button Types -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Button Types</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h4 class="font-medium text-blue-900 mb-2">Reply Button</h4>
                        <p class="text-sm text-blue-700">Interactive button that sends a reply message</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h4 class="font-medium text-green-900 mb-2">Call Button</h4>
                        <p class="text-sm text-green-700">Button that initiates a phone call</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <h4 class="font-medium text-purple-900 mb-2">URL Button</h4>
                        <p class="text-sm text-purple-700">Button that opens a web URL</p>
                    </div>
                    <div class="bg-orange-50 p-4 rounded-lg">
                        <h4 class="font-medium text-orange-900 mb-2">Copy Button</h4>
                        <p class="text-sm text-orange-700">Button that copies text to clipboard</p>
                    </div>
                </div>
            </div>

            <!-- Examples -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- JSON Request Example -->
                <div>
                    <h4 class="text-md font-semibold text-gray-900 mb-3">JSON Request Example</h4>
                    <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                        <pre class="text-green-400 text-sm"><code>{
  "sender": "6281284838163",
  "api_key": "yourapikey",
  "number": "082298859671",
  "message": "Halo, ini pesan button",
  "footer": "optional",
  "button": [
    {
      "type": "reply",
      "displayText": "Mantap"
    },
    {
      "type": "call",
      "displayText": "Call Me",
      "phoneNumber": "082298859671"
    },
    {
      "type": "url",
      "displayText": "Visit Website",
      "url": "https://google.com"
    },
    {
      "type": "copy",
      "displayText": "Copy Code",
      "copyCode": "XXXX"
    }
  ]
}</code></pre>
                    </div>
                </div>

                <!-- URL Request Example -->
                <div>
                    <h4 class="text-md font-semibold text-gray-900 mb-3">URL Request Example</h4>
                    <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                        <pre class="text-blue-400 text-sm"><code>{{ env('APP_URL') }}/send-button?sender=6281284838163&api_key=yourapikey&number=082298859671&message=Halo,ini pesan button&button=button1,button2,button3</code></pre>
                    </div>
                </div>
            </div>

            <!-- Response Example -->
            <div>
                <h4 class="text-md font-semibold text-gray-900 mb-3">Response Example</h4>
                <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                    <pre class="text-yellow-400 text-sm"><code>{
  "status": "success",
  "message": "Button message sent successfully",
  "message_id": "3EB0C767D26A8B2A"
}</code></pre>
                </div>
            </div>
        </div>
    </div>
</div>
