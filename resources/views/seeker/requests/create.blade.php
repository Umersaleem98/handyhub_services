@extends('layouts.app')

@section('title', 'New Service Request - HandymanPro')

@section('content')
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('seeker.dashboard') }}">
            <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-hp p-4 p-lg-5">
                <h3 class="fw-bold mb-2">Request a Service</h3>
                <p class="text-secondary mb-4">Describe what you need</p>
                
                <form method="POST" action="{{ route('seeker.requests.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Service Category -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Select Service Type</label>
                        <div class="row g-3">
                            @foreach($categories as $category)
                            <div class="col-6 col-md-4">
                                <div class="service-option" onclick="selectService(this, {{ $category->id }})">
                                    <input type="radio" name="category_id" value="{{ $category->id }}" class="d-none" required>
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-inline-flex align-items-center justify-content-center mb-2" style="width: 48px; height: 48px;">
                                        <i class="bi bi-{{ $category->icon ?? 'tools' }} fs-4"></i>
                                    </div>
                                    <div class="fw-semibold small">{{ $category->name }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Describe Your Need</label>
                        <textarea name="description" class="form-control-hp" rows="4" placeholder="Describe the issue in detail..." required></textarea>
                    </div>
                    
                    <!-- Photos -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Photos (Optional)</label>
                        <div class="upload-zone" onclick="document.getElementById('images').click()">
                            <i class="bi bi-cloud-upload fs-1 text-secondary mb-2 d-block"></i>
                            <div class="fw-semibold">Click to upload photos</div>
                            <div class="small text-secondary">Max 5 photos, 5MB each</div>
                        </div>
                        <input type="file" name="images[]" id="images" class="d-none" multiple accept="image/*" onchange="previewImages(this)">
                        <div id="imagePreview" class="row g-2 mt-3"></div>
                    </div>
                    
                    <!-- Location (No Google Maps Required) -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Location</label>
                        
                        <!-- City Selection -->
                        <select id="citySelect" class="form-control-hp mb-3" onchange="updateCoordinates()">
                            <option value="">Select City</option>
                            <option value="karachi" data-lat="24.8607" data-lng="67.0011">Karachi</option>
                            <option value="lahore" data-lat="31.5204" data-lng="74.3587">Lahore</option>
                            <option value="islamabad" data-lat="33.6844" data-lng="73.0479">Islamabad</option>
                            <option value="rawalpindi" data-lat="33.5651" data-lng="73.0169">Rawalpindi</option>
                            <option value="faisalabad" data-lat="31.4180" data-lng="73.0790">Faisalabad</option>
                            <option value="multan" data-lat="30.1575" data-lng="71.5249">Multan</option>
                            <option value="peshawar" data-lat="34.0151" data-lng="71.5249">Peshawar</option>
                            <option value="quetta" data-lat="30.1798" data-lng="66.9750">Quetta</option>
                        </select>
                        
                        <input type="text" name="address" class="form-control-hp mb-3" placeholder="Full Address (Street, Area, House #)" required>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="address_details" class="form-control-hp" placeholder="Floor/Apt (Optional)">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="city" class="form-control-hp" placeholder="City Name" required>
                            </div>
                        </div>
                        
                        <!-- Hidden coordinates -->
                        <input type="hidden" name="latitude" id="latitude" value="30.3753" required>
                        <input type="hidden" name="longitude" id="longitude" value="69.3451" required>
                    </div>
                    
                    <!-- Urgency -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Urgency Level</label>
                        <select name="urgency" class="form-control-hp">
                            <option value="low">Low - Within a week</option>
                            <option value="medium" selected>Medium - Within 3 days</option>
                            <option value="high">High - Within 24 hours</option>
                            <option value="emergency">Emergency - ASAP</option>
                        </select>
                    </div>
                    
                    <!-- Budget -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Budget Min (Rs.)</label>
                            <input type="number" name="budget_min" class="form-control-hp" placeholder="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Budget Max (Rs.)</label>
                            <input type="number" name="budget_max" class="form-control-hp" placeholder="0">
                        </div>
                    </div>
                    
                    <!-- Preferred Time -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Preferred Date</label>
                            <input type="date" name="preferred_date" class="form-control-hp" min="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Preferred Time</label>
                            <select name="preferred_time" class="form-control-hp">
                                <option value="morning">Morning (8AM - 12PM)</option>
                                <option value="afternoon">Afternoon (12PM - 5PM)</option>
                                <option value="evening">Evening (5PM - 9PM)</option>
                                <option value="anytime" selected>Anytime</option>
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-hp-primary w-100 py-3">
                        <i class="bi bi-send me-2"></i>Post Request
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function selectService(element, id) {
    document.querySelectorAll('.service-option').forEach(el => el.classList.remove('selected'));
    element.classList.add('selected');
    element.querySelector('input').checked = true;
}

function previewImages(input) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            preview.innerHTML += `<div class="col-4 col-md-3"><img src="${e.target.result}" class="img-fluid rounded-3" style="height: 100px; object-fit: cover;"></div>`;
        };
        reader.readAsDataURL(file);
    });
}

function updateCoordinates() {
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