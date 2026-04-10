@include('layouts.admin.head')
<title>Book Service</title>

<style>
.form-control, .form-select {
    background: #1a1a1a;
    border: 1px solid #444;
    color: #fff;
}
.form-control:focus, .form-select:focus {
    background: #1a1a1a;
    color: #fff;
    border-color: #0d6efd;
    box-shadow: none;
}
</style>

<body>
<div class="container-fluid position-relative d-flex p-0">

    @include('layouts.admin.sidebar')

    <div class="content">
        @include('layouts.admin.header')

        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary rounded p-4">

                <h4 class="mb-4">Book a Service</h4>

                <form action="{{ url('service.book') }}" method="POST">
                    @csrf

                    <div class="row g-3">

                        <!-- Service Name -->
                        <div class="col-md-6">
                            <label class="form-label">Service</label>
                            <input type="text" name="service_name" class="form-control" 
                                   value="{{ request('service') }}" readonly>
                        </div>

                        <!-- Customer Name -->
                        <div class="col-md-6">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <!-- Address -->
                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>

                        <!-- Date -->
                        <div class="col-md-6">
                            <label class="form-label">Preferred Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>

                        <!-- Time -->
                        <div class="col-md-6">
                            <label class="form-label">Preferred Time</label>
                            <input type="time" name="time" class="form-control" required>
                        </div>

                        <!-- Notes -->
                        <div class="col-12">
                            <label class="form-label">Additional Notes</label>
                            <textarea name="notes" rows="4" class="form-control"></textarea>
                        </div>

                        <!-- Submit -->
                        <div class="col-12 text-end">
                            <button class="btn btn-primary px-5">Book Now</button>
                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

@include('layouts.admin.script')