@extends('layouts.app')

@section('title', 'Add Production Record')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --bg:        #f0f6ff;
    --surface:   #ffffff;
    --surface2:  #f7faff;
    --blue:      #00D9C0;
    --blue-pale: #E6FFFA;
    --blue-dim:  rgba(0,217,192,0.09);
    --blue-light:#B2F5EA;
    --teal:      #0ea5e9;
    --teal-dim:  rgba(14,165,233,0.1);
    --red:       #ef4444;
    --red-dim:   rgba(239,68,68,0.09);
    --green:     #10b981;
    --green-dim: rgba(16,185,129,0.09);
    --amber:     #f59e0b;
    --text:      #0f2849;
    --text2:     #2d5080;
    --muted:     #7a9cc0;
    --border:    rgba(26,109,255,0.1);
    --shadow:    0 4px 24px rgba(26,109,255,0.08);
    --shadow-lg: 0 8px 40px rgba(26,109,255,0.14);
  }

  body {
    background: var(--bg) !important;
    color: var(--text) !important;
    font-family: 'Plus Jakarta Sans', sans-serif !important;
  }

  body::before {
    content: ''; position: fixed; top: -150px; right: -100px;
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(26,109,255,0.08) 0%, transparent 70%);
    pointer-events: none; z-index: 0;
  }

  @keyframes fadeUp { from { opacity:0; transform:translateY(18px); } to { opacity:1; transform:translateY(0); } }

  .form-wrap {
    max-width: 780px; margin: 0 auto; padding: 36px 24px; position: relative; z-index: 1;
  }

  /* HEADER */
  .form-page-header {
    margin-bottom: 28px;
    animation: fadeUp .4s ease both;
  }
  .form-breadcrumb {
    font-size: 11px; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase;
    color: var(--blue); margin-bottom: 6px; display: flex; align-items: center; gap: 6px;
  }
  .form-breadcrumb a { color: var(--muted); text-decoration: none; transition: color .15s; }
  .form-breadcrumb a:hover { color: var(--blue); }
  .form-page-title { font-size: 26px; font-weight: 800; letter-spacing: -0.03em; color: var(--text); }
  .form-page-subtitle { font-size: 13px; color: var(--muted); margin-top: 4px; font-weight: 500; }

  /* CARD */
  .form-card {
    background: var(--surface); border: 1px solid var(--border); border-radius: 20px;
    overflow: hidden; box-shadow: var(--shadow);
    animation: fadeUp .4s .1s ease both; opacity: 0; animation-fill-mode: forwards;
  }
  .form-card-header {
    padding: 20px 28px; border-bottom: 1px solid var(--border); background: var(--surface2);
    display: flex; align-items: center; gap: 12px;
  }
  .form-card-icon {
    width: 40px; height: 40px; border-radius: 11px; display: grid; place-items: center;
    font-size: 18px; background: var(--blue-dim); flex-shrink: 0;
  }
  .form-card-label { font-size: 15px; font-weight: 700; color: var(--text); }
  .form-card-sub   { font-size: 12px; color: var(--muted); margin-top: 2px; }
  .form-card-body  { padding: 28px; }

  /* SECTION DIVIDER */
  .form-section {
    margin-bottom: 28px;
  }
  .form-section-title {
    font-size: 10px; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase;
    color: var(--blue); margin-bottom: 16px; padding-bottom: 8px;
    border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 8px;
  }
  .form-section-title::before {
    content: ''; width: 3px; height: 14px; background: var(--blue); border-radius: 2px;
  }

  /* GRID */
  .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
  .form-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 18px; }

  /* FIELD */
  .form-field { display: flex; flex-direction: column; gap: 6px; }
  .form-field label {
    font-size: 12px; font-weight: 600; color: var(--text2); letter-spacing: 0.02em;
  }
  .field-hint { font-size: 10px; color: var(--muted); font-weight: 400; }

  .form-field input,
  .form-field select {
    width: 100%; padding: 11px 14px;
    background: var(--surface2); border: 1.5px solid var(--border); border-radius: 11px;
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; font-weight: 500; color: var(--text);
    outline: none; transition: all .18s; appearance: none;
  }
  .form-field input:focus,
  .form-field select:focus {
    border-color: var(--blue); background: #fff;
    box-shadow: 0 0 0 3px rgba(26,109,255,0.1);
  }
  .form-field input::placeholder { color: var(--muted); font-weight: 400; }
  .form-field input.is-invalid,
  .form-field select.is-invalid { border-color: var(--red); }
  .form-field input.is-invalid:focus,
  .form-field select.is-invalid:focus { box-shadow: 0 0 0 3px rgba(239,68,68,0.12); }

  .invalid-feedback { font-size: 11px; color: var(--red); font-weight: 500; margin-top: 2px; display: block; }

  /* SELECT ARROW */
  .select-wrap { position: relative; }
  .select-wrap::after {
    content: '▾'; position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
    font-size: 12px; color: var(--muted); pointer-events: none;
  }

  /* WEATHER OPTIONS */
  .weather-options { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
  .weather-opt { display: none; }
  .weather-opt-label {
    display: flex; flex-direction: column; align-items: center; gap: 6px;
    padding: 14px 10px; border-radius: 12px; border: 1.5px solid var(--border);
    background: var(--surface2); cursor: pointer; transition: all .18s; text-align: center;
  }
  .weather-opt-label:hover { border-color: rgba(26,109,255,0.3); background: var(--blue-pale); }
  .weather-opt:checked + .weather-opt-label {
    border-color: var(--blue); background: var(--blue-dim);
    box-shadow: 0 0 0 3px rgba(26,109,255,0.1);
  }
  .weather-emoji { font-size: 24px; line-height: 1; }
  .weather-lbl-text { font-size: 11px; font-weight: 600; color: var(--text2); }

  /* FOOTER BUTTONS */
  .form-footer {
    display: flex; gap: 12px; padding-top: 8px;
    border-top: 1px solid var(--border); margin-top: 28px;
  }
  .btn-submit {
    flex: 1; padding: 13px; border-radius: 12px; font-size: 14px; font-weight: 700;
    background: linear-gradient(135deg, var(--blue), var(--teal));
    color: #fff; border: none; cursor: pointer;
    box-shadow: 0 4px 14px rgba(26,109,255,0.3); transition: all .2s;
  }
  .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(26,109,255,0.4); }
  .btn-cancel {
    padding: 13px 24px; border-radius: 12px; font-size: 14px; font-weight: 600;
    background: var(--surface2); color: var(--muted); border: 1.5px solid var(--border);
    text-decoration: none; display: inline-flex; align-items: center; transition: all .2s;
  }
  .btn-cancel:hover { background: var(--blue-pale); color: var(--text2); border-color: rgba(26,109,255,0.2); text-decoration: none; }
</style>
@endpush

@section('content')
<div class="form-wrap">

  {{-- HEADER --}}
  <div class="form-page-header">
    <div class="form-breadcrumb">
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <span>›</span>
      <a href="{{ route('solar-systems.index') }}">Solar Systems</a>
      <span>›</span>
      <a href="{{ route('solar-systems.productions.index', $solarSystem) }}">Production</a>
      <span>›</span>
      Add Record
    </div>
    <div class="form-page-title">Add Production Record</div>
    <div class="form-page-subtitle">{{ $solarSystem->name }}</div>
  </div>

  {{-- FORM CARD --}}
  <div class="form-card">
    <div class="form-card-header">
      <div class="form-card-icon">⚡</div>
      <div>
        <div class="form-card-label">New Production Entry</div>
        <div class="form-card-sub">Fill in the details below to log a production record</div>
      </div>
    </div>

    <div class="form-card-body">
      <form method="POST" action="{{ route('solar-systems.productions.store', $solarSystem) }}">
        @csrf

        {{-- SECTION: Basic Info --}}
        <div class="form-section">
          <div class="form-section-title">Basic Information</div>
          <div class="form-grid-2">

            <div class="form-field">
              <label for="panel_id">Panel <span class="field-hint">(Optional)</span></label>
              <div class="select-wrap">
                <select class="@error('panel_id') is-invalid @enderror" id="panel_id" name="panel_id">
                  <option value="">Select a panel...</option>
                  @foreach($panels as $panel)
                    <option value="{{ $panel->id }}" {{ old('panel_id') == $panel->id ? 'selected' : '' }}>
                      {{ $panel->serial_number }} — {{ $panel->model }}
                    </option>
                  @endforeach
                </select>
              </div>
              @error('panel_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>

            <div class="form-field">
              <label for="production_date">Production Date <span style="color:var(--red)">*</span></label>
              <input type="date" id="production_date" name="production_date"
                     value="{{ old('production_date') }}"
                     class="@error('production_date') is-invalid @enderror" required>
              @error('production_date')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>

            <div class="form-field">
              <label for="production_time">Production Time <span class="field-hint">(Optional)</span></label>
              <input type="time" id="production_time" name="production_time"
                     value="{{ old('production_time') }}"
                     class="@error('production_time') is-invalid @enderror">
              @error('production_time')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>

          </div>
        </div>

        {{-- SECTION: Energy Data --}}
        <div class="form-section">
          <div class="form-section-title">Energy Data</div>
          <div class="form-grid-2">

            <div class="form-field">
              <label for="energy_produced_kwh">Energy Produced <span style="color:var(--red)">*</span></label>
              <input type="number" id="energy_produced_kwh" name="energy_produced_kwh"
                     value="{{ old('energy_produced_kwh') }}" placeholder="0.00"
                     step="0.01" min="0"
                     class="@error('energy_produced_kwh') is-invalid @enderror" required>
              @error('energy_produced_kwh')<span class="invalid-feedback">{{ $message }}</span>@enderror
              <span class="field-hint">in kWh</span>
            </div>

            <div class="form-field">
              <label for="energy_consumed_kwh">Energy Consumed <span class="field-hint">(Optional)</span></label>
              <input type="number" id="energy_consumed_kwh" name="energy_consumed_kwh"
                     value="{{ old('energy_consumed_kwh') }}" placeholder="0.00"
                     step="0.01" min="0"
                     class="@error('energy_consumed_kwh') is-invalid @enderror">
              @error('energy_consumed_kwh')<span class="invalid-feedback">{{ $message }}</span>@enderror
              <span class="field-hint">in kWh</span>
            </div>

            <div class="form-field">
              <label for="peak_power_kw">Peak Power <span class="field-hint">(Optional)</span></label>
              <input type="number" id="peak_power_kw" name="peak_power_kw"
                     value="{{ old('peak_power_kw') }}" placeholder="0.00"
                     step="0.01" min="0"
                     class="@error('peak_power_kw') is-invalid @enderror">
              @error('peak_power_kw')<span class="invalid-feedback">{{ $message }}</span>@enderror
              <span class="field-hint">in kW</span>
            </div>

            <div class="form-field">
              <label for="average_power_kw">Average Power <span class="field-hint">(Optional)</span></label>
              <input type="number" id="average_power_kw" name="average_power_kw"
                     value="{{ old('average_power_kw') }}" placeholder="0.00"
                     step="0.01" min="0"
                     class="@error('average_power_kw') is-invalid @enderror">
              @error('average_power_kw')<span class="invalid-feedback">{{ $message }}</span>@enderror
              <span class="field-hint">in kW</span>
            </div>

          </div>
        </div>

        {{-- SECTION: Environmental --}}
        <div class="form-section">
          <div class="form-section-title">Environmental Conditions</div>
          <div class="form-grid-2" style="margin-bottom:18px;">

            <div class="form-field">
              <label for="irradiance_wm2">Irradiance <span class="field-hint">(Optional)</span></label>
              <input type="number" id="irradiance_wm2" name="irradiance_wm2"
                     value="{{ old('irradiance_wm2') }}" placeholder="0.00"
                     step="0.01" min="0"
                     class="@error('irradiance_wm2') is-invalid @enderror">
              @error('irradiance_wm2')<span class="invalid-feedback">{{ $message }}</span>@enderror
              <span class="field-hint">in W/m²</span>
            </div>

            <div class="form-field">
              <label for="temperature_celsius">Temperature <span class="field-hint">(Optional)</span></label>
              <input type="number" id="temperature_celsius" name="temperature_celsius"
                     value="{{ old('temperature_celsius') }}" placeholder="0.00"
                     step="0.01"
                     class="@error('temperature_celsius') is-invalid @enderror">
              @error('temperature_celsius')<span class="invalid-feedback">{{ $message }}</span>@enderror
              <span class="field-hint">in °C</span>
            </div>

          </div>

          {{-- Weather Condition visual picker --}}
          <div class="form-field">
            <label>Weather Condition <span class="field-hint">(Optional)</span></label>
            <div class="weather-options">
              @php $oldWeather = old('weather_condition'); @endphp

              <div>
                <input type="radio" name="weather_condition" id="w_sunny" value="sunny" class="weather-opt"
                       {{ $oldWeather === 'sunny' ? 'checked' : '' }}>
                <label for="w_sunny" class="weather-opt-label">
                  <span class="weather-emoji">☀️</span>
                  <span class="weather-lbl-text">Sunny</span>
                </label>
              </div>

              <div>
                <input type="radio" name="weather_condition" id="w_partly" value="partly_cloudy" class="weather-opt"
                       {{ $oldWeather === 'partly_cloudy' ? 'checked' : '' }}>
                <label for="w_partly" class="weather-opt-label">
                  <span class="weather-emoji">⛅</span>
                  <span class="weather-lbl-text">Partly Cloudy</span>
                </label>
              </div>

              <div>
                <input type="radio" name="weather_condition" id="w_cloudy" value="cloudy" class="weather-opt"
                       {{ $oldWeather === 'cloudy' ? 'checked' : '' }}>
                <label for="w_cloudy" class="weather-opt-label">
                  <span class="weather-emoji">☁️</span>
                  <span class="weather-lbl-text">Cloudy</span>
                </label>
              </div>

              <div>
                <input type="radio" name="weather_condition" id="w_rainy" value="rainy" class="weather-opt"
                       {{ $oldWeather === 'rainy' ? 'checked' : '' }}>
                <label for="w_rainy" class="weather-opt-label">
                  <span class="weather-emoji">🌧️</span>
                  <span class="weather-lbl-text">Rainy</span>
                </label>
              </div>
            </div>
            @error('weather_condition')<span class="invalid-feedback" style="display:block;margin-top:6px;">{{ $message }}</span>@enderror
          </div>

        </div>

        {{-- FOOTER --}}
        <div class="form-footer">
          <button type="submit" class="btn-submit">⚡ Add Production Record</button>
          <a href="{{ route('solar-systems.productions.index', $solarSystem) }}" class="btn-cancel">Cancel</a>
        </div>

      </form>
    </div>
  </div>

</div>
@endsection