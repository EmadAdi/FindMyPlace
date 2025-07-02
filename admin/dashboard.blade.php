@extends('admin.layout')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">لوحة التحكم</h2>

    {{-- Cards Section --}}
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5>عدد المستخدمين</h5>
                    <h3>{{ $usersCount }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5>العقارات</h5>
                    <h3>{{ $propertiesCount }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-info shadow">
                <div class="card-body">
                    <h5>العقود</h5>
                    <h3>{{ $contractsCount }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger shadow">
                <div class="card-body">
                    <h5>الحجوزات</h5>
                    <h3>{{ $bookingsCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart Section --}}
    <div class="row mt-5">
        <div class="col-md-12">
            <canvas id="bookingChart"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('bookingChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'عدد الحجوزات الشهري',
                data: {!! json_encode($chartData) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
            }]
        },
        options: {
            responsive: true,
        }
    });
</script>
@endpush
