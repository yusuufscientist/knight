<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <div>
            <h1 class="dashboard-title">Solar Energy Dashboard</h1>
            <p class="dashboard-subtitle">Monitor your solar power production in real-time</p>
        </div>
        <div class="header-actions">
            <button id="toggleRealtime" class="btn btn-success me-2">
                <i class="bi bi-play-circle"></i> Start Real-time
            </button>
            <span class="last-update">Last updated: <span id="lastUpdateTime"><?php echo e(now()->format('H:i:s')); ?></span></span>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="stats-grid">
        <div class="stat-card stat-card-primary">
            <div class="stat-icon">
                <i class="bi bi-sun-fill"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Today's Production</span>
                <span class="stat-value"><span id="statToday"><?php echo e(number_format($todayProduction, 2)); ?></span> <small>kWh</small></span>
                <span class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +12% vs yesterday
                </span>
            </div>
        </div>

        <div class="stat-card stat-card-success">
            <div class="stat-icon">
                <i class="bi bi-lightning-charge-fill"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">This Month</span>
                <span class="stat-value"><?php echo e(number_format($monthProduction, 2)); ?> <small>kWh</small></span>
                <span class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +8% vs last month
                </span>
            </div>
        </div>

        <div class="stat-card stat-card-warning">
            <div class="stat-icon">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Estimated Savings</span>
                <span class="stat-value">$<?php echo e(number_format($todayProduction * 0.15, 2)); ?></span>
                <span class="stat-change">
                    @ $0.15/kWh
                </span>
            </div>
        </div>

        <div class="stat-card stat-card-info">
            <div class="stat-icon">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Active Alerts</span>
                <span class="stat-value"><?php echo e($activeAlerts->count()); ?></span>
                <span class="stat-change <?php echo e($activeAlerts->count() > 0 ? 'negative' : ''); ?>">
                    <?php echo e($activeAlerts->count() > 0 ? 'Needs attention' : 'All systems normal'); ?>

                </span>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-header">
                <h3><i class="bi bi-graph-up"></i> Energy Production - Last 7 Days</h3>
            </div>
            <div class="chart-body">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <h3><i class="bi bi-calendar-month"></i> Monthly Production - <?php echo e(now()->year); ?></h3>
            </div>
            <div class="chart-body">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Bottom Row -->
    <div class="bottom-grid">
        <!-- Weather Widget -->
        <div class="weather-card">
            <div class="weather-header">
                <h3><i class="bi bi-cloud-sun-fill"></i> Weather Conditions</h3>
            </div>
            <div class="weather-content">
                <div class="weather-main">
                    <div class="weather-icon-large">
                        <i class="bi <?php echo e($weatherData['condition_icon'] ?? 'bi-sun-fill'); ?>"></i>
                    </div>
                    <div class="weather-temp"><?php echo e($weatherData['temperature'] ?? 25); ?>°C</div>
                    <div class="weather-condition"><?php echo e($weatherData['condition'] ?? 'Clear'); ?></div>
                </div>
                <div class="weather-details">
                    <div class="weather-detail">
                        <i class="bi bi-droplet"></i>
                        <span>Humidity</span>
                        <strong><?php echo e($weatherData['humidity'] ?? 45); ?>%</strong>
                    </div>
                    <div class="weather-detail">
                        <i class="bi bi-wind"></i>
                        <span>Wind</span>
                        <strong><?php echo e($weatherData['wind_speed'] ?? 12); ?> km/h</strong>
                    </div>
                    <div class="weather-detail">
                        <i class="bi bi-sunrise"></i>
                        <span>UV Index</span>
                        <strong><?php echo e($weatherData['uv_index'] ?? 5); ?></strong>
                    </div>
                    <div class="weather-detail">
                        <i class="bi bi-clouds"></i>
                        <span>Cloud Cover</span>
                        <strong><?php echo e($weatherData['cloud_cover'] ?? 15); ?>%</strong>
                    </div>
                </div>
                <div class="production-impact">
                    <span>Production Efficiency: <strong><?php echo e($weatherData['production_impact']['efficiency'] ?? 85); ?>%</strong></span>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?php echo e($weatherData['production_impact']['efficiency'] ?? 85); ?>%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Solar Systems Overview -->
        <div class="systems-card">
            <div class="systems-header">
                <h3><i class="bi bi-grid-3x3-gap-fill"></i> Your Solar Systems</h3>
                <a href="<?php echo e(route('solar-systems.create')); ?>" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg"></i> Add
                </a>
            </div>
            <div class="systems-list">
                <?php $__empty_1 = true; $__currentLoopData = $solarSystems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="system-item">
                    <div class="system-info">
                        <div class="system-name"><?php echo e($system->name); ?></div>
                        <div class="system-location"><?php echo e($system->location); ?></div>
                    </div>
                    <div class="system-stats">
                        <div class="system-capacity"><?php echo e($system->total_capacity_kw); ?> kW</div>
                        <div class="system-production"><?php echo e(number_format($system->todayProduction(), 2)); ?> kWh today</div>
                    </div>
                    <div class="system-status">
                        <span class="badge bg-<?php echo e($system->status === 'active' ? 'success' : 'warning'); ?>">
                            <?php echo e(ucfirst($system->status)); ?>

                        </span>
                    </div>
                    <a href="<?php echo e(route('solar-systems.show', $system)); ?>" class="btn btn-sm btn-outline">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-state">
                    <i class="bi bi-sun"></i>
                    <p>No solar systems yet</p>
                    <a href="<?php echo e(route('solar-systems.create')); ?>" class="btn btn-primary">Add Your First System</a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Alerts -->
        <div class="alerts-card">
            <div class="alerts-header">
                <h3><i class="bi bi-bell-fill"></i> Recent Alerts</h3>
                <span class="badge bg-danger"><?php echo e($activeAlerts->count()); ?></span>
            </div>
            <div class="alerts-list">
                <?php $__empty_1 = true; $__currentLoopData = $activeAlerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="alert-item alert-<?php echo e($alert->severity); ?>">
                    <div class="alert-icon">
                        <i class="bi bi-<?php echo e($alert->severity === 'critical' ? 'exclamation-circle-fill' : 'exclamation-triangle-fill'); ?>"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-type"><?php echo e($alert->type); ?></div>
                        <div class="alert-message"><?php echo e($alert->message); ?></div>
                        <div class="alert-time"><?php echo e($alert->triggered_at->diffForHumans()); ?></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="no-alerts">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>No active alerts</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    console.log('Dashboard script loading...');
    
    var weeklyChart = null;
    var monthlyChart = null;
    var realtimeInterval = null;
    
    // Initialize charts immediately
    console.log('Initializing charts...');
    var weeklyCtx = document.getElementById('weeklyChart');
    var monthlyCtx = document.getElementById('monthlyChart');
    console.log('weeklyCtx:', weeklyCtx);
    console.log('monthlyCtx:', monthlyCtx);
    
    if (weeklyCtx) {
        weeklyChart = new Chart(weeklyCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($productionChartData['labels'] ?? []); ?>,
                datasets: [{
                    label: 'Energy Production (kWh)',
                    data: <?php echo json_encode($productionChartData['data'] ?? []); ?>,
                    borderColor: '#22c55e',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#22c55e',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0, 0, 0, 0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
        console.log('Weekly chart created');
    }
    
    if (monthlyCtx) {
        monthlyChart = new Chart(monthlyCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($monthlyChartData['labels'] ?? []); ?>,
                datasets: [{
                    label: 'Monthly Production (kWh)',
                    data: <?php echo json_encode($monthlyChartData['data'] ?? []); ?>,
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    borderColor: '#3b82f6',
                    borderWidth: 1,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0, 0, 0, 0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
        console.log('Monthly chart created');
    }
    
    // Attach click handler
    var toggleBtn = document.getElementById('toggleRealtime');
    console.log('toggleBtn:', toggleBtn);
    
    if (toggleBtn) {
        toggleBtn.onclick = function() {
            console.log('Button clicked!');
            var btn = this;
            
            if (realtimeInterval) {
                clearInterval(realtimeInterval);
                realtimeInterval = null;
                btn.innerHTML = '<i class="bi bi-play-circle"></i> Start Real-time';
                btn.classList.remove('btn-danger');
                btn.classList.add('btn-success');
            } else {
                btn.innerHTML = '<i class="bi bi-stop-circle"></i> Stop Real-time';
                btn.classList.remove('btn-success');
                btn.classList.add('btn-danger');
                
                fetchRealtimeData();
                realtimeInterval = setInterval(fetchRealtimeData, 1000);
            }
        };
        console.log('Click handler attached');
    }
    
    function fetchRealtimeData() {
        console.log('Fetching realtime data...');
        var csrfToken = document.querySelector('meta[name="csrf-token"]');
        console.log('CSRF Token element:', csrfToken);
        
        if (!csrfToken) {
            console.error('CSRF token not found!');
            alert('CSRF token not found. Please refresh the page.');
            return;
        }
        
        console.log('CSRF Token:', csrfToken.content);
        
        fetch('/api/realtime/generate', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken.content,
                'Accept': 'application/json'
            },
            credentials: 'include'
        })
        .then(function(response) {
            console.log('Response status:', response.status);
            if (!response.ok) {
                console.error('Response not OK:', response.statusText);
                return response.text().then(function(text) {
                    console.error('Error response body:', text);
                    throw new Error('HTTP error: ' + response.status);
                });
            }
            return response.json();
        })
        .then(function(data) {
            console.log('Data received:', JSON.stringify(data, null, 2));
            
            document.getElementById('lastUpdateTime').textContent = new Date().toLocaleTimeString();
            
            if (data.data) {
                console.log('Updating charts with data.data.production:', data.data.production);
                console.log('Updating charts with data.data.monthly_production:', data.data.monthly_production);
                
                if (weeklyChart) {
                    weeklyChart.data.labels = data.data.labels;
                    weeklyChart.data.datasets[0].data = data.data.production;
                    weeklyChart.update('none');
                    console.log('Weekly chart updated');
                } else {
                    console.log('ERROR: weeklyChart is null');
                }
                
                if (monthlyChart) {
                    monthlyChart.data.labels = data.data.monthly_labels;
                    monthlyChart.data.datasets[0].data = data.data.monthly_production;
                    monthlyChart.update('none');
                    console.log('Monthly chart updated');
                } else {
                    console.log('ERROR: monthlyChart is null');
                }
                
                var todayEl = document.getElementById('statToday');
                if (todayEl && data.data.total_today) {
                    todayEl.textContent = parseFloat(data.data.total_today).toFixed(2);
                }
            } else {
                console.log('ERROR: No data.data in response');
            }
        })
        .catch(function(error) {
            console.error('Fetch error:', error);
            alert('Error fetching data: ' + error.message);
        });
    }
    
    console.log('Script initialization complete');
</script>
<?php $__env->stopPush(); ?>

<style>
.dashboard-container {
    padding: 24px;
    background: #f8fafc;
    min-height: 100vh;
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.dashboard-title {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.dashboard-subtitle {
    color: #64748b;
    margin: 4px 0 0;
}

.last-update {
    font-size: 14px;
    color: #94a3b8;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 24px;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.stat-card-primary .stat-icon { background: linear-gradient(135deg, #f59e0b, #fbbf24); }
.stat-card-success .stat-icon { background: linear-gradient(135deg, #22c55e, #4ade80); }
.stat-card-warning .stat-icon { background: linear-gradient(135deg, #3b82f6, #60a5fa); }
.stat-card-info .stat-icon { background: linear-gradient(135deg, #ef4444, #f87171); }

.stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
}

.stat-content {
    display: flex;
    flex-direction: column;
}

.stat-label {
    font-size: 13px;
    color: #64748b;
    font-weight: 500;
}

.stat-value {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.2;
}

.stat-value small {
    font-size: 14px;
    font-weight: 500;
    color: #64748b;
}

.stat-change {
    font-size: 12px;
    color: #94a3b8;
    margin-top: 4px;
}

.stat-change.positive { color: #22c55e; }
.stat-change.negative { color: #ef4444; }

/* Charts Grid */
.charts-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 24px;
}

.chart-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.chart-header {
    padding: 16px 20px;
    border-bottom: 1px solid #e2e8f0;
}

.chart-header h3 {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.chart-body {
    padding: 20px;
    height: 280px;
}

/* Bottom Grid */
.bottom-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 20px;
}

/* Weather Card */
.weather-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.weather-header {
    padding: 16px 20px;
    border-bottom: 1px solid #e2e8f0;
}

.weather-header h3 {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.weather-content {
    padding: 20px;
}

.weather-main {
    text-align: center;
    margin-bottom: 20px;
}

.weather-icon-large {
    font-size: 48px;
    color: #f59e0b;
    margin-bottom: 8px;
}

.weather-temp {
    font-size: 36px;
    font-weight: 700;
    color: #1e293b;
}

.weather-condition {
    font-size: 16px;
    color: #64748b;
}

.weather-details {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-bottom: 16px;
}

.weather-detail {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 12px;
    background: #f8fafc;
    border-radius: 8px;
}

.weather-detail i {
    font-size: 20px;
    color: #3b82f6;
    margin-bottom: 4px;
}

.weather-detail span {
    font-size: 12px;
    color: #64748b;
}

.weather-detail strong {
    font-size: 14px;
    color: #1e293b;
}

.production-impact {
    text-align: center;
}

.production-impact span {
    font-size: 13px;
    color: #64748b;
}

.production-impact strong {
    color: #22c55e;
}

.progress-bar {
    height: 8px;
    background: #e2e8f0;
    border-radius: 4px;
    margin-top: 8px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #22c55e, #4ade80);
    border-radius: 4px;
    transition: width 0.3s;
}

/* Systems Card */
.systems-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.systems-header {
    padding: 16px 20px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.systems-header h3 {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.systems-list {
    padding: 12px;
    max-height: 350px;
    overflow-y: auto;
}

.system-item {
    display: flex;
    align-items: center;
    padding: 12px;
    border-radius: 8px;
    gap: 12px;
    transition: background 0.2s;
}

.system-item:hover {
    background: #f8fafc;
}

.system-info {
    flex: 1;
}

.system-name {
    font-weight: 600;
    color: #1e293b;
}

.system-location {
    font-size: 12px;
    color: #64748b;
}

.system-stats {
    text-align: right;
}

.system-capacity {
    font-weight: 600;
    color: #22c55e;
}

.system-production {
    font-size: 12px;
    color: #64748b;
}

.system-status .badge {
    font-size: 11px;
    padding: 4px 8px;
}

.btn-outline {
    padding: 6px 10px;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    color: #64748b;
    transition: all 0.2s;
}

.btn-outline:hover {
    background: #f8fafc;
    color: #1e293b;
}

.btn-solar {
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-solar:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
}

/* Alerts Card */
.alerts-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.alerts-header {
    padding: 16px 20px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.alerts-header h3 {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.alerts-list {
    padding: 12px;
    max-height: 350px;
    overflow-y: auto;
}

.alert-item {
    display: flex;
    gap: 12px;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 8px;
}

.alert-critical {
    background: #fef2f2;
    border-left: 3px solid #ef4444;
}

.alert-warning {
    background: #fffbeb;
    border-left: 3px solid #f59e0b;
}

.alert-info {
    background: #eff6ff;
    border-left: 3px solid #3b82f6;
}

.alert-icon {
    font-size: 20px;
}

.alert-critical .alert-icon { color: #ef4444; }
.alert-warning .alert-icon { color: #f59e0b; }
.alert-info .alert-icon { color: #3b82f6; }

.alert-content {
    flex: 1;
}

.alert-type {
    font-weight: 600;
    color: #1e293b;
    font-size: 14px;
}

.alert-message {
    font-size: 13px;
    color: #64748b;
    margin: 2px 0;
}

.alert-time {
    font-size: 11px;
    color: #94a3b8;
}

.no-alerts {
    text-align: center;
    padding: 40px 20px;
    color: #22c55e;
}

.no-alerts i {
    font-size: 48px;
    margin-bottom: 12px;
}

.no-alerts p {
    margin: 0;
    color: #64748b;
}

.empty-state {
    text-align: center;
    padding: 40px 20px;
}

.empty-state i {
    font-size: 48px;
    color: #cbd5e1;
    margin-bottom: 12px;
}

.empty-state p {
    color: #64748b;
    margin-bottom: 16px;
}

/* Responsive */
@media (max-width: 1200px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .bottom-grid { grid-template-columns: 1fr; }
}

@media (max-width: 768px) {
    .stats-grid { grid-template-columns: 1fr; }
    .charts-grid { grid-template-columns: 1fr; }
    .dashboard-header { flex-direction: column; align-items: flex-start; gap: 12px; }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fcyusuuf\Desktop\compo\SolarSmart\resources\views/dashboard/index.blade.php ENDPATH**/ ?>