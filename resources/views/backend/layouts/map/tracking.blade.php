<!-- resources/views/admin/tracking.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Team Tracking Dashboard</title>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfGOjmqKtEBRsfVN9szUo_tac20wcI9HM"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        #header {
            background: #1f2937;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #controls {
            background: #f3f4f6;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            gap: 15px;
            align-items: center;
        }

        #map {
            height: calc(100vh - 140px);
            width: 100%;
        }

        select,
        button {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background: #3b82f6;
            color: white;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background: #2563eb;
        }

        .btn-logout {
            background: #ef4444;
        }

        .btn-logout:hover {
            background: #dc2626;
        }

        .status-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .status-active {
            background: #10b981;
        }

        .status-inactive {
            background: #ef4444;
        }

        #teamList {
            position: absolute;
            top: 160px;
            right: 20px;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            max-height: 400px;
            overflow-y: auto;
            z-index: 1000;
        }

        .team-item {
            padding: 10px;
            margin-bottom: 8px;
            background: #f9fafb;
            border-radius: 4px;
            font-size: 14px;
        }

        .team-item strong {
            display: block;
            margin-bottom: 4px;
        }

        .team-item small {
            color: #6b7280;
        }
    </style>
</head>

<body>
    <div id="header">
        <h1>📍 Real-Time Team Tracking</h1>
        <div style="display: flex; gap: 15px; align-items: center;">
            {{-- <span>Welcome, {{ session('admin_user')['name'] }}</span> --}}
            <span id="lastUpdate">Last Updated: Never</span>
            <form action="/admin/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </div>

    <div id="controls">
        <label>
            <strong>Filter Team:</strong>
            <select id="teamFilter">
                <option value="">All Teams</option>
                @foreach ($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </label>

        <button onclick="refreshLocations()">🔄 Refresh Now</button>

        <label>
            <input type="checkbox" id="autoRefresh" checked>
            Auto-refresh (30s)
        </label>

        <button onclick="toggleTeamList()">📋 Team List</button>
    </div>

    <div id="map"></div>

    <div id="teamList" style="display: none;">
        <h3>Active Teams</h3>
        <div id="teamListContent"></div>
    </div>

    <script>
        let map;
        let markers = {};
        let workMarkers = {};
        let refreshInterval;
        let infoWindows = [];

        // Get JWT token from session
        const token = '{{ session('admin_token') }}';

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 23.8103,
                    lng: 90.4125
                }, // Dhaka, Bangladesh
                zoom: 12,
                styles: [{
                    featureType: "poi",
                    elementType: "labels",
                    stylers: [{
                        visibility: "off"
                    }]
                }]
            });

            refreshLocations();
            startAutoRefresh();

            document.getElementById('teamFilter').addEventListener('change', refreshLocations);
            document.getElementById('autoRefresh').addEventListener('change', (e) => {
                if (e.target.checked) {
                    startAutoRefresh();
                } else {
                    stopAutoRefresh();
                }
            });
        }

        function startAutoRefresh() {
            stopAutoRefresh();
            refreshInterval = setInterval(refreshLocations, 30000); // 30 seconds
        }

        function stopAutoRefresh() {
            if (refreshInterval) {
                clearInterval(refreshInterval);
            }
        }

        async function refreshLocations() {
            const teamId = document.getElementById('teamFilter').value;
            const url = `/api/admin/tracking/locations${teamId ? '?team_id=' + teamId : ''}`;

            try {
                const response = await fetch(url, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) {
                    if (response.status === 401 || response.status === 403) {
                        alert('Session expired. Please login again.');
                        window.location.href = '/admin/login';
                        return;
                    }
                    throw new Error('Failed to fetch locations');
                }

                const result = await response.json();

                if (result.success) {
                    updateMarkers(result.data.locations, result.data.works);
                    updateTeamList(result.data.locations);
                    document.getElementById('lastUpdate').textContent =
                        `Last Updated: ${new Date().toLocaleTimeString()}`;
                }
            } catch (error) {
                console.error('Error fetching locations:', error);
            }
        }

        function updateMarkers(locations, works) {
            // Close all info windows
            infoWindows.forEach(iw => iw.close());
            infoWindows = [];

            // Clear old markers
            Object.values(markers).forEach(marker => marker.setMap(null));
            markers = {};

            Object.values(workMarkers).forEach(item => {
                item.marker.setMap(null);
                item.circle.setMap(null);
            });
            workMarkers = {};

            // Add team location markers (Blue)
            locations.forEach(location => {
                const position = {
                    lat: parseFloat(location.latitude),
                    lng: parseFloat(location.longitude)
                };

                const marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: location.team.name,
                    icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                    animation: google.maps.Animation.DROP
                });

                const timeDiff = Math.round((new Date() - new Date(location.tracked_at)) / 60000);

                const infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div style="padding: 10px; min-width: 200px;">
                            <h3 style="margin: 0 0 10px 0; color: #1f2937;">${location.team.name}</h3>
                            <p style="margin: 5px 0;"><strong>Leader:</strong> ${location.user.name}</p>
                            <p style="margin: 5px 0;"><strong>Last Update:</strong> ${timeDiff} min ago</p>
                            <p style="margin: 5px 0;"><strong>Accuracy:</strong> ${location.accuracy ? Math.round(location.accuracy) + 'm' : 'N/A'}</p>
                            <p style="margin: 5px 0; font-size: 12px; color: #6b7280;">${new Date(location.tracked_at).toLocaleString()}</p>
                        </div>
                    `
                });

                marker.addListener('click', () => {
                    infoWindows.forEach(iw => iw.close());
                    infoWindow.open(map, marker);
                    infoWindows.push(infoWindow);
                });

                markers[location.team_id] = marker;
            });

            // Add work location markers (Red)
            works.forEach(work => {
                const position = {
                    lat: parseFloat(work.latitude),
                    lng: parseFloat(work.longitude)
                };

                const marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: work.title,
                    icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
                });

                // Geofence circle
                const circle = new google.maps.Circle({
                    map: map,
                    center: position,
                    radius: parseFloat(work.geofence_radius || 100),
                    fillColor: '#ef4444',
                    fillOpacity: 0.15,
                    strokeColor: '#ef4444',
                    strokeOpacity: 0.5,
                    strokeWeight: 2
                });

                const infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div style="padding: 10px; min-width: 200px;">
                            <h3 style="margin: 0 0 10px 0; color: #ef4444;">📍 ${work.title}</h3>
                            <p style="margin: 5px 0;"><strong>Team:</strong> ${work.team.name}</p>
                            <p style="margin: 5px 0;"><strong>Start:</strong> ${new Date(work.start_datetime).toLocaleString()}</p>
                            <p style="margin: 5px 0;"><strong>Geofence:</strong> ${work.geofence_radius || 100}m radius</p>
                            ${work.description ? `<p style="margin: 5px 0; font-size: 12px;">${work.description}</p>` : ''}
                        </div>
                    `
                });

                marker.addListener('click', () => {
                    infoWindows.forEach(iw => iw.close());
                    infoWindow.open(map, marker);
                    infoWindows.push(infoWindow);
                });

                workMarkers[work.id] = {
                    marker,
                    circle
                };
            });

            // Auto-fit bounds
            if (locations.length > 0 || works.length > 0) {
                const bounds = new google.maps.LatLngBounds();
                locations.forEach(loc => {
                    bounds.extend(new google.maps.LatLng(
                        parseFloat(loc.latitude),
                        parseFloat(loc.longitude)
                    ));
                });
                works.forEach(work => {
                    bounds.extend(new google.maps.LatLng(
                        parseFloat(work.latitude),
                        parseFloat(work.longitude)
                    ));
                });
                map.fitBounds(bounds);
            }
        }

        function updateTeamList(locations) {
            const container = document.getElementById('teamListContent');

            if (locations.length === 0) {
                container.innerHTML = '<p style="color: #6b7280;">No active teams</p>';
                return;
            }

            container.innerHTML = locations.map(loc => {
                const timeDiff = Math.round((new Date() - new Date(loc.tracked_at)) / 60000);
                return `
                    <div class="team-item">
                        <strong>
                            <span class="status-indicator status-active"></span>
                            ${loc.team.name}
                        </strong>
                        <small>Leader: ${loc.user.name}</small><br>
                        <small>Updated: ${timeDiff} min ago</small>
                    </div>
                `;
            }).join('');
        }

        function toggleTeamList() {
            const list = document.getElementById('teamList');
            list.style.display = list.style.display === 'none' ? 'block' : 'none';
        }

        window.onload = initMap;
        window.onbeforeunload = stopAutoRefresh;
    </script>
</body>

</html>
