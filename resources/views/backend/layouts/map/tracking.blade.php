@extends('backend.app')

@section('title', 'Real-Time Location Tracking')

@section('content')
    <div class="app-content main-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <!-- Header -->
                <div class="page-header">
                    <div class="card shadow-sm mb-3 border-0">
                        <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h1 class="page-title mb-1">
                                    <i class="fa fa-map-marker text-danger me-2"></i>
                                    Real-Time Location Tracking
                                </h1>
                                <p class="text-muted mb-0">Monitor team leaders' live location via WebSocket</p>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <button class="btn btn-primary" id="refreshLocations">
                                    <i class="fa fa-refresh"></i> Refresh
                                </button>
                                <button class="btn btn-outline-primary" id="fitBoundsBtn">
                                    <i class="fa fa-arrows-alt"></i> Fit All
                                </button>
                                <span class="badge bg-success fs-6 px-3 py-4" id="connectionStatus">
                                    <i class="fa fa-circle pulse"></i> Connecting...
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Map Container -->
                    <div class="col-xl-9 col-lg-8 col-12">
                        <div class="card shadow-sm">
                            <!-- Map Controls -->
                            <div class="card-header bg-white border-bottom">
                                <div
                                    class="d-flex justify-content-between align-items-center flex-nowrap gap-3 flex-shrink-0">
                                    <h3 class="card-title mb-0 text-nowrap">
                                        <i class="fa fa-map text-primary me-2"></i>
                                        Live Map View
                                    </h3>

                                    <div class="d-flex align-items-center gap-3">
                                        <select class="form-select" id="teamFilter" style="min-width: 180px;">
                                            <option value="">All Teams</option>
                                            @foreach ($teams as $team)
                                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                                            @endforeach
                                        </select>

                                        <!-- HTML -->
                                        <div class="form-check form-switch mb-0" style="margin-left: 25px">
                                            <input class="form-check-input custom-switch" type="checkbox" id="showRoutes">
                                            <label class="form-check-label ms-2 fw-semibold" for="showRoutes">
                                                Show Routes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Map -->
                            <div class="card-body p-0">
                                <div id="map" style="height: 700px; width: 100%;"></div>
                            </div>

                            <!-- Map Legend -->
                            <div class="card-footer bg-light">
                                <div class="d-flex justify-content-around flex-wrap">
                                    <div class="legend-item">
                                        <span class="legend-marker" style="background: #28a745;"></span>
                                        <small>Work Completed</small>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-marker" style="background: #ffc107;"></span>
                                        <small>Work Rescheduled</small>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-marker" style="background: #007bff;"></span>
                                        <small>Work Pending</small>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-marker" style="background: #dc3545;"></span>
                                        <small>Work In Progress</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-xl-3 col-lg-4 col-12">
                        <!-- Stats Cards -->
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="card shadow-sm">
                                    <div class="card-body text-center py-3">
                                        <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                        <h3 class="mb-0" id="totalTeams">0</h3>
                                        <small class="text-muted">Active Teams</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card shadow-sm">
                                    <div class="card-body text-center py-3">
                                        <i class="fa fa-user fa-2x text-success mb-2"></i>
                                        <h3 class="mb-0" id="totalLeaders">0</h3>
                                        <small class="text-muted">Team Leaders</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active Teams List -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="card-title mb-0">
                                    <i class="fa fa-list-ul me-2"></i>
                                    Active Teams
                                </h4>
                            </div>
                            <div class="card-body p-2">
                                <input type="text" class="form-control mb-2" id="teamSearch"
                                    placeholder="🔍 Search teams...">
                            </div>
                            <div id="teamList" style="max-height: 550px; overflow-y: auto;">
                                <div class="text-center p-4">
                                    <div class="spinner-border text-primary" role="status"></div>
                                    <p class="mt-2 mb-0">Loading teams...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 10px;
        }

        .legend-marker {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        .team-item {
            transition: all 0.3s ease;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
        }

        .team-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        .team-item.active {
            background: linear-gradient(90deg, #e3f2fd 0%, #ffffff 100%);
            border-left: 4px solid #007bff;
        }

        .team-avatar {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #007bff 0%, #28a745 100%);
        }

        .connection-pulse {
            width: 12px;
            height: 12px;
            background: #28a745;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            animation: connectionPulse 2s infinite;
        }

        /* Custom toggle design */
        .custom-switch {
            width: 2.8rem;
            height: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        /* Red when active */
        .custom-switch:checked {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        /* Label style */
        .form-check-label {
            font-size: 0.9rem;
            font-weight: 500;
        }

        @keyframes connectionPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
            }
        }

        /* CSS */
    </style>
@endpush

@push('scripts')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        let map;
        let markers = {};
        let infoWindows = {};
        let polylines = {};
        let workMarkers = {};
        let selectedTeamId = null;
        let allLocationsData = [];
        let echo;

        // Initialize Laravel Echo with Reverb
        function initializeEcho() {
            console.log('🔌 Connecting to Reverb WebSocket...');

            echo = new window.Pusher('{{ config('broadcasting.connections.reverb.key') }}', {
                wsHost: '{{ config('broadcasting.connections.reverb.options.host') }}',
                wsPort: {{ config('broadcasting.connections.reverb.options.port') }},
                wssPort: {{ config('broadcasting.connections.reverb.options.port') }},
                forceTLS: {{ config('broadcasting.connections.reverb.options.scheme') === 'https' ? 'true' : 'false' }},
                enabledTransports: ['ws', 'wss'],
                cluster: 'mt1',
                disableStats: true,
            });

            // Subscribe to location updates
            const channel = echo.subscribe('location-tracking');

            channel.bind('pusher:subscription_succeeded', () => {
                console.log('✅ Connected to WebSocket');
                updateConnectionStatus('connected');
            });

            channel.bind('pusher:subscription_error', (error) => {
                console.error('❌ WebSocket connection error:', error);
                updateConnectionStatus('error');
            });

            channel.bind('location.updated', (data) => {
                console.log('📍 Real-time location received:', data);
                handleRealtimeLocation(data);
            });

            // Connection state monitoring
            echo.connection.bind('connected', () => {
                console.log('🟢 WebSocket Connected');
                updateConnectionStatus('connected');
            });

            echo.connection.bind('disconnected', () => {
                console.log('🔴 WebSocket Disconnected');
                updateConnectionStatus('disconnected');
            });

            echo.connection.bind('error', (error) => {
                console.error('❌ WebSocket Error:', error);
                updateConnectionStatus('error');
            });
        }

        // Handle real-time location updates
        function handleRealtimeLocation(data) {
            // Apply team filter
            if (selectedTeamId && data.team_id != selectedTeamId) {
                return;
            }

            const key = `${data.team_id}_${data.user_id}`;
            const position = {
                lat: parseFloat(data.latitude),
                lng: parseFloat(data.longitude)
            };

            // Update or create marker
            if (markers[key]) {
                // Smooth marker animation
                markers[key].setPosition(position);
                if (markers[key].getAnimation() === null) {
                    markers[key].setAnimation(google.maps.Animation.BOUNCE);
                    setTimeout(() => markers[key].setAnimation(null), 1000);
                }
            } else {
                createMarker(data, position, key);
            }

            // Update info window
            if (infoWindows[key]) {
                infoWindows[key].setContent(createInfoWindowContent(data));
            }

            // Update team list
            updateTeamInList(data);

            // Play notification sound (optional)
            playNotificationSound();
        }

        // Create new marker
        function createMarker(data, position, key) {
            const marker = new google.maps.Marker({
                position: position,
                map: map,
                title: `${data.user_name} (${data.team_name})`,
                animation: google.maps.Animation.DROP,
                icon: createCustomMarker(data.team_id, true)
            });

            const infoWindow = new google.maps.InfoWindow({
                content: createInfoWindowContent(data)
            });

            marker.addListener('click', () => {
                closeAllInfoWindows();
                infoWindow.open(map, marker);
            });

            markers[key] = marker;
            infoWindows[key] = infoWindow;
        }

        // Update connection status badge
        function updateConnectionStatus(status) {
            const badge = $('#connectionStatus');
            const statusConfig = {
                'connected': {
                    class: 'bg-success',
                    icon: 'fa-circle pulse',
                    text: 'Live'
                },
                'disconnected': {
                    class: 'bg-warning',
                    icon: 'fa-exclamation-circle',
                    text: 'Reconnecting...'
                },
                'error': {
                    class: 'bg-danger',
                    icon: 'fa-times-circle',
                    text: 'Connection Error'
                }
            };

            const config = statusConfig[status];
            badge.removeClass().addClass(`badge fs-6 px-3 py-4 ${config.class}`);
            badge.html(`<i class="fa ${config.icon}"></i> ${config.text}`);
        }

        // Initialize Google Map
        function initMap() {
            console.log('🗺️ Initializing Google Maps...');

            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 23.8103,
                    lng: 90.4125
                },
                zoom: 12,
                mapTypeId: 'roadmap',
                styles: [{
                    featureType: 'poi',
                    elementType: 'labels',
                    stylers: [{
                        visibility: 'on'
                    }]
                }]
            });

            console.log('✅ Map initialized');
        }

        // Fetch initial locations
        function fetchLocations() {
            console.log('📡 Fetching initial locations...');

            const teamId = $('#teamFilter').val();
            const url = '{{ route('admin.tracking.locations') }}' + (teamId ? `?team_id=${teamId}` : '');

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        console.log(`✅ Received ${response.data.length} locations`);
                        allLocationsData = response.data;
                        updateMap(response.data);
                        updateTeamList(response.data);
                    }
                },
                error: function(xhr) {
                    console.error('❌ Failed to fetch locations:', xhr);
                }
            });
        }

        // Update map with locations
        function updateMap(locations) {
            if (!map) return;

            const bounds = new google.maps.LatLngBounds();
            let hasLocations = false;

            locations.forEach(location => {
                const key = `${location.team_id}_${location.user_id}`;
                const position = {
                    lat: parseFloat(location.latitude),
                    lng: parseFloat(location.longitude)
                };

                bounds.extend(position);
                hasLocations = true;

                if (!markers[key]) {
                    createMarker(location, position, key);
                }
            });

            if (hasLocations && !selectedTeamId) {
                map.fitBounds(bounds);
                if (map.getZoom() > 15) map.setZoom(15);
            }

            updateStats(locations);
        }

        // Create custom marker icon
        function createCustomMarker(teamId, isLeader) {
            const color = getTeamColor(teamId);
            return {
                path: google.maps.SymbolPath.CIRCLE,
                scale: isLeader ? 16 : 12,
                fillColor: color,
                fillOpacity: 1,
                strokeColor: '#ffffff',
                strokeWeight: isLeader ? 4 : 3
            };
        }

        // Create info window content
        function createInfoWindowContent(location) {
            const time = new Date(location.tracked_at);
            const timeStr = time.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            const speed = location.speed ? parseFloat(location.speed).toFixed(1) + ' km/h' : 'N/A';
            const accuracy = location.accuracy ? Math.round(location.accuracy) + 'm' : 'N/A';
            const battery = location.battery_level || 'N/A';
            const teamColor = getTeamColor(location.team_id);

            return `<div style="padding: 15px; min-width: 250px;">
                <h5 style="margin: 0 0 10px; color: ${teamColor}; border-bottom: 2px solid ${teamColor}; padding-bottom: 8px;">
                    <i class="fa fa-user-circle"></i> ${location.user_name}
                    <span style="background: #ffc107; color: #000; padding: 2px 6px; border-radius: 3px; font-size: 11px; margin-left: 5px;">LEADER</span>
                </h5>
                <div style="font-size: 13px; line-height: 1.8;">
                    <div><strong>📋 Team:</strong> ${location.team_name}</div>
                    <div><strong>🕐 Time:</strong> ${timeStr}</div>
                    <div><strong>⚡ Speed:</strong> ${speed}</div>
                    <div><strong>🎯 Accuracy:</strong> ${accuracy}</div>
                    <div><strong>🔋 Battery:</strong> ${battery}</div>
                </div>
            </div>`;
        }

        // Update team list
        function updateTeamList(locations) {
            const teamData = {};

            locations.forEach(loc => {
                if (!teamData[loc.team_id]) {
                    teamData[loc.team_id] = {
                        name: loc.team_name,
                        leaders: []
                    };
                }
                teamData[loc.team_id].leaders.push(loc);
            });

            let html = '';
            Object.keys(teamData).forEach(teamId => {
                const team = teamData[teamId];
                const lastUpdate = new Date(team.leaders[0].tracked_at);
                const timeAgo = getTimeAgo(lastUpdate);
                const teamColor = getTeamColor(teamId);

                html += `<div class="team-item p-3" data-team-id="${teamId}">
                    <div class="d-flex align-items-center">
                        <div class="team-avatar me-3" style="background: ${teamColor};">
                            ${team.name.charAt(0).toUpperCase()}
                        </div>
                        <div class="flex-fill">
                            <strong class="d-block">${team.name}</strong>
                            <small class="text-muted">
                                <i class="fa fa-user-circle"></i> ${team.leaders.length} Leader(s)
                            </small>
                            <div class="text-muted small mt-1">
                                <i class="fa fa-clock-o"></i> ${timeAgo}
                            </div>
                        </div>
                        <span class="badge bg-success">${team.leaders.length}</span>
                    </div>
                </div>`;
            });

            $('#teamList').html(html || '<div class="text-center p-4 text-muted">No active teams</div>');

            $('.team-item').click(function() {
                const teamId = $(this).data('team-id');
                selectedTeamId = teamId;
                $('#teamFilter').val(teamId);
                fetchLocations();
                $('.team-item').removeClass('active');
                $(this).addClass('active');
            });
        }

        // Update specific team in list
        function updateTeamInList(data) {
            const teamItem = $(`.team-item[data-team-id="${data.team_id}"]`);
            if (teamItem.length) {
                const timeAgo = getTimeAgo(new Date(data.tracked_at));
                teamItem.find('.text-muted.small.mt-1').html(`<i class="fa fa-clock-o"></i> ${timeAgo}`);
            }
        }

        // Update statistics
        function updateStats(locations) {
            const teams = new Set(locations.map(l => l.team_id));
            $('#totalTeams').text(teams.size);
            $('#totalLeaders').text(locations.length);
        }

        // Get team color
        function getTeamColor(teamId) {
            const colors = ['#007bff', '#28a745', '#dc3545', '#ffc107', '#17a2b8', '#6f42c1', '#fd7e14', '#20c997'];
            return colors[teamId % colors.length];
        }

        // Get time ago
        function getTimeAgo(date) {
            const seconds = Math.floor((new Date() - date) / 1000);
            if (seconds < 60) return seconds + 's ago';
            if (seconds < 3600) return Math.floor(seconds / 60) + 'm ago';
            if (seconds < 86400) return Math.floor(seconds / 3600) + 'h ago';
            return Math.floor(seconds / 86400) + 'd ago';
        }

        // Close all info windows
        function closeAllInfoWindows() {
            Object.values(infoWindows).forEach(iw => iw.close());
        }

        // Play notification sound
        function playNotificationSound() {
            // Optional: Add notification sound
            // const audio = new Audio('/sounds/notification.mp3');
            // audio.play().catch(e => console.log('Audio play failed:', e));
        }

        // Load Google Maps
        function loadGoogleMaps() {
            if (typeof google !== 'undefined') {
                initializeApp();
            } else {
                const script = document.createElement('script');
                script.src =
                    'https://maps.googleapis.com/maps/api/js?key=AIzaSyBfGOjmqKtEBRsfVN9szUo_tac20wcI9HM&libraries=geometry&callback=initializeApp';
                script.async = true;
                script.defer = true;
                document.head.appendChild(script);
            }
        }

        // Initialize application
        function initializeApp() {
            console.log('🚀 Initializing real-time tracking...');
            initMap();
            fetchLocations();
            initializeEcho();
        }

        // Document ready
        $(document).ready(function() {
            // Event handlers
            $('#refreshLocations').click(fetchLocations);

            $('#teamFilter').change(function() {
                selectedTeamId = $(this).val() || null;
                fetchLocations();
            });

            $('#fitBoundsBtn').click(function() {
                if (allLocationsData.length > 0) {
                    const bounds = new google.maps.LatLngBounds();
                    allLocationsData.forEach(loc => {
                        bounds.extend({
                            lat: parseFloat(loc.latitude),
                            lng: parseFloat(loc.longitude)
                        });
                    });
                    map.fitBounds(bounds);
                }
            });

            $('#teamSearch').on('keyup', function() {
                const search = $(this).val().toLowerCase();
                $('.team-item').each(function() {
                    $(this).toggle($(this).text().toLowerCase().includes(search));
                });
            });

            // Load application
            loadGoogleMaps();
        });

        // Expose to global scope
        window.initializeApp = initializeApp;
    </script>
@endpush
