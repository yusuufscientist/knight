@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Panel: {{ $panel->serial_number }}</h1>
        <div>
            <a href="{{ route('solar-systems.panels.edit', [$solarSystem, $panel]) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('solar-systems.panels.index', $solarSystem) }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Panel Details</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Serial Number:</th>
                            <td>{{ $panel->serial_number }}</td>
                        </tr>
                        <tr>
                            <th>Model:</th>
                            <td>{{ $panel->model }}</td>
                        </tr>
                        <tr>
                            <th>Manufacturer:</th>
                            <td>{{ $panel->manufacturer }}</td>
                        </tr>
                        <tr>
                            <th>Capacity:</th>
                            <td>{{ $panel->capacity_watts }}W</td>
                        </tr>
                        <tr>
                            <th>Efficiency Rating:</th>
                            <td>{{ $panel->efficiency_rating ?? 'N/A' }}%</td>
                        </tr>
                        <tr>
                            <th>Installation Date:</th>
                            <td>{{ $panel->installation_date }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge bg-{{ $panel->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ $panel->status }}
                                </span>
                            </td>
                        </tr>
                        @if($panel->notes)
                        <tr>
                            <th>Notes:</th>
                            <td>{{ $panel->notes }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Statistics</div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h4>{{ $stats['today_production'] ?? 0 }} kWh</h4>
                            <p class="text-muted">Today's Production</p>
                        </div>
                        <div class="col-6">
                            <h4>{{ $stats['efficiency'] ?? 0 }}%</h4>
                            <p class="text-muted">Efficiency</p>
                        </div>
                    </div>
                    <div class="alert alert-{{ $stats['is_producing_normally'] ? 'success' : 'warning' }} mt-3">
                        {{ $stats['is_producing_normally'] ? 'Panel is producing normally' : 'Panel is underperforming' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($panel->alerts->count() > 0)
    <div class="card mt-4">
        <div class="card-header">Recent Alerts</div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Severity</th>
                        <th>Status</th>
                        <th>Triggered</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($panel->alerts as $alert)
                    <tr>
                        <td>{{ $alert->title }}</td>
                        <td>{{ $alert->type }}</td>
                        <td>
                            <span class="badge bg-{{ $alert->severity === 'high' ? 'danger' : 'warning' }}">
                                {{ $alert->severity }}
                            </span>
                        </td>
                        <td>{{ $alert->status }}</td>
                        <td>{{ $alert->triggered_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
