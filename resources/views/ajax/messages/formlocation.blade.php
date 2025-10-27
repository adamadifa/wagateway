<div class="space-y-6">
    <!-- Map Container -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            <i class="bi bi-geo-alt mr-2"></i>Select Location
        </label>
        <div class="bg-gray-50 rounded-lg border border-gray-300 overflow-hidden">
            <div id="map" style="width:100%;height:400px;z-index:1;" class="rounded-lg"></div>
        </div>
        <p class="mt-2 text-xs text-gray-500">Click on the map to select a location, or use your current location</p>
    </div>

    <!-- Coordinates -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="bi bi-arrow-up mr-2"></i>Latitude
            </label>
            <input type="text" name="latitude" id="latitude"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
                placeholder="0.000000" required>
        </div>

        <div>
            <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="bi bi-arrow-right mr-2"></i>Longitude
            </label>
            <input type="text" name="longitude" id="longitude"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-dark-blue-500 focus:border-dark-blue-500 transition-colors duration-200"
                placeholder="0.000000" required>
        </div>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <i class="bi bi-info-circle text-blue-600 mr-2 mt-0.5"></i>
            <div class="text-sm text-blue-800">
                <p class="font-medium">How to use:</p>
                <ul class="mt-1 list-disc list-inside space-y-1">
                    <li>Click anywhere on the map to select a location</li>
                    <li>The coordinates will be automatically filled</li>
                    <li>You can also manually enter coordinates if needed</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var mymap = L.map('map');
        var mmr = L.marker([0, 0]);
        mmr.bindPopup('0,0');
        mmr.addTo(mymap);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {
            foo: 'bar',
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(mymap);
        mymap.on('click', onMapClick);

        function isll(num) {
            var val = parseFloat(num);
            if (!isNaN(val) && val <= 90 && val >= -90) return true;
            else return false;
        }

        function onMapClick(e) {
            mmr.setLatLng(e.latlng);
            setui(e.latlng.lat, e.latlng.lng, mymap.getZoom());
        }

        function sm(lt, ln, zm) {
            setui(lt, ln, zm);
            mmr.setLatLng(L.latLng(lt, ln));
            mymap.setView([lt, ln], zm);
        }

        function setui(lt, ln, zm) {
            lt = Number(lt).toFixed(6);
            ln = Number(ln).toFixed(6);
            mmr.setPopupContent(lt + ',' + ln).openPopup();
            document.getElementById("latitude").value = lt;
            document.getElementById("longitude").value = ln;
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;
                sm(lat, lon, 12);
            }, function(error) {
                sm(-6.175110, 106.865036, 12);
            });
        } else {
            sm(-6.175110, 106.865036, 12);
        }
    });
</script>
