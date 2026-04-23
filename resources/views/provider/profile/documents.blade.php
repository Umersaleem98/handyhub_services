@extends('layouts.app')

@section('title', 'Upload Documents - HandymanPro')

@section('content')
<div class="bg-light min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="steps-hp mb-4" style="max-width: 500px; margin: 0 auto;">
                    <div class="step-hp completed">
                        <div class="step-circle"><i class="bi bi-check-lg"></i></div>
                        <div class="step-label">Account</div>
                    </div>
                    <div class="step-hp completed">
                        <div class="step-circle"><i class="bi bi-check-lg"></i></div>
                        <div class="step-label">Profile</div>
                    </div>
                    <div class="step-hp active">
                        <div class="step-circle">3</div>
                        <div class="step-label">Documents</div>
                    </div>
                </div>
                
                <div class="card-hp p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                            <i class="bi bi-shield-lock-fill fs-2"></i>
                        </div>
                        <h3 class="fw-bold mb-1">Verify Your Identity</h3>
                        <p class="text-secondary">Upload required documents</p>
                    </div>
                    
                    <div class="alert alert-warning rounded-3 d-flex gap-3 mb-4">
                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                        <div>
                            <div class="fw-semibold">All documents are encrypted</div>
                            <div class="small">Bank-level encryption protects your data.</div>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('provider.documents.upload.post') }}" enctype="multipart/form-data">
                        @csrf
                        
                        @php
                        $documents = [
                            'cnic_front' => ['label' => 'CNIC Front', 'icon' => 'card-text'],
                            'cnic_back' => ['label' => 'CNIC Back', 'icon' => 'card-text'],
                            'professional_license' => ['label' => 'Professional License', 'icon' => 'award'],
                            'police_clearance' => ['label' => 'Police Clearance', 'icon' => 'shield-check'],
                            'profile_photo' => ['label' => 'Profile Photo', 'icon' => 'person'],
                        ];
                        @endphp
                        
                        <div class="row g-4">
                            @foreach($documents as $type => $doc)
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <label class="form-label fw-semibold d-flex align-items-center gap-2">
                                            <i class="bi bi-{{ $doc['icon'] }} text-primary"></i>
                                            {{ $doc['label'] }}
                                        </label>
                                        <div class="upload-zone" onclick="document.getElementById('{{ $type }}').click()">
                                            <i class="bi bi-cloud-upload fs-2 text-secondary mb-2"></i>
                                            <div class="fw-semibold small">Click to upload</div>
                                            <div class="small text-secondary">JPG, PNG, PDF (Max 5MB)</div>
                                        </div>
                                        <input type="file" name="{{ $type }}" id="{{ $type }}" class="d-none" accept="image/*,.pdf" required onchange="showPreview(this, '{{ $type }}_preview')">
                                        <div id="{{ $type }}_preview" class="mt-2"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <button type="submit" class="btn btn-hp-primary w-100 py-3 mt-4">
                            <i class="bi bi-check-lg me-2"></i>Submit for Verification
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showPreview(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded-3" style="max-height: 150px;">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection