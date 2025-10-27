<div class="tab-pane" id="examplewebhook" role="tabpanel">
    <div class="bg-white rounded-xl shadow-lg border border-gray-200">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="bi bi-webhook text-purple-600 text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Webhook Example</h2>
                    <p class="text-sm text-gray-600">Learn how to handle incoming messages via webhook</p>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-6">
            <!-- Description -->
            <div class="bg-blue-50 border-l-4 border-blue-400 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="bi bi-info-circle-fill text-blue-600 mr-2 mt-0.5"></i>
                    <div>
                        <h4 class="text-sm font-medium text-blue-800">What is Webhook?</h4>
                        <p class="text-sm text-blue-700 mt-1">
                            Webhook is a feature that allows you to receive a callback from our server when a message is
                            incoming to your device.
                            You can use this feature to create a dynamic chatbot or whatever you want.
                        </p>
                    </div>
                </div>
            </div>

            <!-- How it works -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">How it Works</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-blue-600 font-semibold text-sm">1</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Set Webhook URL</h4>
                            <p class="text-sm text-gray-600">Configure your webhook URL when creating a device</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-blue-600 font-semibold text-sm">2</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Receive Callbacks</h4>
                            <p class="text-sm text-gray-600">Our server sends POST requests to your webhook URL when
                                messages arrive</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-blue-600 font-semibold text-sm">3</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Process Messages</h4>
                            <p class="text-sm text-gray-600">Handle the incoming data and create your chatbot logic</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- JSON Structure -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Webhook JSON Structure</h3>
                <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                    <pre class="text-yellow-400 text-sm"><code>{
  "device": "your sender/device",
  "message": "message",
  "from": "the number of the whatsapp sender",
  "name": "the name of the sender",
  "participant": "sender number if group",
  "ppUrl": "url profile picture sender",
  "media": [
    {
      "caption": "caption, equal to message",
      "fileName": "xxxx.xx",
      "stream": [
        {
          "type": "Buffer",
          "data": "xxxx"
        }
      ],
      "mimetype": "image/jpeg"
    }
  ]
}</code></pre>
                </div>
            </div>

            <!-- Field Descriptions -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Field Descriptions</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Field</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">device</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Your sender/device number</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">message</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 text-sm text-gray-500">The incoming message text</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">from</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Sender's WhatsApp number</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">name</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Sender's display name</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">participant
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Group participant number (if group message)
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">ppUrl</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">string</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Profile picture URL of sender</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">media</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">array</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Media attachments (null if no media)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Example Implementation -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Example Implementation</h3>
                <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                    <pre class="text-green-400 text-sm"><code>// PHP Example
public function handleWebhook(Request $request) {
    $data = $request->all();
    
    $device = $data['device'];
    $message = $data['message'];
    $from = $data['from'];
    $name = $data['name'];
    
    // Your chatbot logic here
    if ($message === 'Hello') {
        // Send response back
        $this->sendMessage($device, $from, 'Hi there!');
    }
}</code></pre>
                </div>
            </div>

            <!-- Resources -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="font-medium text-gray-900 mb-2">Additional Resources</h4>
                <p class="text-sm text-gray-600 mb-3">For a complete webhook implementation example, check out:</p>
                <a href="https://github.com/Ilmans/webhook-wamp-example.git" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="bi bi-github mr-2"></i>
                    View Example on GitHub
                </a>
            </div>
        </div>
    </div>
</div>
