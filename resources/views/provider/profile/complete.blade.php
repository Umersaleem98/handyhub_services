@extends('layouts.app')

@section('title', 'Complete Profile - HandymanPro')

@section('content')
<div class="bg-light min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Steps -->
                <div class="steps-hp mb-4" style="max-width: 500px; margin: 0 auto;">
                    <div class="step-hp completed">
                        <div class="step-circle"><i class="bi bi-check-lg"></i></div>
                        <div class="step-label">Account</div>
                    </div>
                    <div class="step-hp active">
                        <div class="step-circle">2</div>
                        <div class="step-label">Profile</div>
                    </div>
                    <div class="step-hp">
                        <div class="step-circle">3</div>
                        <div class="step-label">Documents</div>
                    </div>
                </div>
                
                <div class="card-hp p-4 p-lg-5">
                    <h3 class="fw-bold mb-4">Complete Your Profile</h3>
                    
                    <form method="POST" action="{{ route('provider.profile.complete.post') }}">
                        @csrf
                        
                        <!-- Bio -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Professional Bio</label>
                            <textarea name="bio" class="form-control-hp" rows="4" placeholder="Describe your experience, skills, and expertise..." required minlength="100"></textarea>
                            <div class="form-text">Minimum 100 characters</div>
                        </div>
                        
                        <!-- Skills -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Skills & Services</label>
                            <div class="row g-2">
                                @foreach(['plumbing', 'electrical', 'cleaning', 'ac_repair', 'carpentry', 'painting'] as $skill)
                                <div class="col-md-4">
                                    <div class="form-check card p-3 rounded-3 border">
                                        <input class="form-check-input" type="checkbox" name="skills[]" value="{{ $skill }}" id="skill_{{ $skill }}">
                                        <label class="form-check-label fw-semibold ms-2" for="skill_{{ $skill }}">
                                            {{ ucfirst(str_replace('_', ' ', $skill)) }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Experience -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Years of Experience</label>
                            <input type="number" name="experience_years" class="form-control-hp" min="0" max="50" value="0" required>
                        </div>
                        
                        <!-- Location (No Map) -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Service Location</label>
                            
                            <select id="citySelect" class="form-control-hp mb-3" onchange="updateCoords()" required>
                                <option value="">Select Your City</option>
                                <option value="karachi" data-lat="24.8607" data-lng="67.0011">Karachi</option>
                                <option value="lahore" data-lat="31.5204" data-lng="74.3587">Lahore</option>
                                <option value="islamabad" data-lat="33.6844" data-lng="73.0479">Islamabad</option>
                                <option value="rawalpindi" data-lat="33.5651" data-lng="73.0169">Rawalpindi</option>
                                <option value="faisalabad" data-lat="31.4180" data-lng="73.0790">Faisalabad</option>
                                <option value="multan" data-lat="30.1575" data-lng="71.5249">Multan</option>
                                <option value="peshawar" data-lat="34.0151" data-lng="71.5249">Peshawar</option>
                                <option value="quetta" data-lat="30.1798" data-lng="66.9750">Quetta</option>
                            </select>
                            
                            <input type="text" name="address" class="form-control-hp mb-3" placeholder="Full Address (Street, Area)" required>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" name="city" class="form-control-hp" placeholder="City" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="postal_code" class="form-control-hp" placeholder="Postal Code">
                                </div>
                            </div>
                            
                            <input type="hidden" name="latitude" id="latitude" value="30.3753" required>
                            <input type="hidden" name="longitude" id="longitude" value="69.3451" required>
                        </div>
                        
                        <!-- Working Hours -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Working Hours</label>
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <div class="d-flex align-items-center gap-3 mb-2 p-2 bg-light rounded-3">
                                <div style="width: 100px;" class="fw-semibold small">{{ $day }}</div>
                                <input type="time" name="working_hours[{{ strtolower($day) }}][start]" class="form-control-hp" value="09:00" style="width: 120px;">
                                <span class="text-secondary">to</span>
                                <input type="time" name="working_hours[{{ strtolower($day) }}][end]" class="form-control-hp" value="18:00" style="width: 120px;">
                                <div class="form-check ms-auto">
                                    <input class="form-check-input" type="checkbox" checked name="working_hours[{{ strtolower($day) }}][available]">
                                    <label class="form-check-label small">Open</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="d-flex gap-3">
                            <a href="{{ route('provider.register') }}" class="btn btn-hp-secondary flex-fill">Back</a>
                            <button type="submit" class="btn btn-hp-primary flex-fill py-3">
                                Continue <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function updateCoords() {
    const select = document.getElementById('citySelect');
    const option = select.options[select.selectedIndex];
    if (option.value) {
        document.getElementById('latitude').value = option.dataset.lat;
        document.getElementById('longitude').value = option.dataset.lng;
        document.querySelector('input[name="city"]').value = option.text;
    }
}
</script>
@endpush
@endsection