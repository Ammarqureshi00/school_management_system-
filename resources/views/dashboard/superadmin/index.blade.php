@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content_header')
<h1>Super Admin Dashboard</h1>
@stop

@section('content')
<div class="container-fluid">
      <!-- KPI Cards -->
      <div class="row mb-4">
            <div class="col-md-4">
                  <div class="card text-white bg-primary shadow-sm">
                        <div class="card-body">
                              <h5 class="card-title">Total Students</h5>
                              <h2 class="card-text">{{ $counts['Student'] }}</h2>
                              <i class="fas fa-user-graduate fa-2x float-end"></i>
                        </div>
                  </div>
            </div>

            <div class="col-md-4">
                  <div class="card text-white bg-success shadow-sm">
                        <div class="card-body">
                              <h5 class="card-title">Total Teachers</h5>
                              <h2 class="card-text">{{ $counts['Teacher'] }}</h2>
                              <i class="fas fa-chalkboard-teacher fa-2x float-end"></i>
                        </div>
                  </div>
            </div>

            <div class="col-md-4">
                  <div class="card text-white bg-warning shadow-sm">
                        <div class="card-body">
                              <h5 class="card-title">Total Admins</h5>
                              <h2 class="card-text">{{ $counts['Admin'] }}</h2>
                              <i class="fas fa-user-shield fa-2x float-end"></i>
                        </div>
                  </div>
            </div>
      </div>

      <!-- Simple Chart -->
      <div class="card shadow-sm">
            <div class="card-header">Users Overview</div>
            <div class="card-body">
                  <canvas id="usersChart" height="100"></canvas>
            </div>
      </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
      const ctx = document.getElementById('usersChart').getContext('2d');
const usersChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'Users Count',
            data: {!! json_encode($chartData) !!},
            backgroundColor: [
                'rgba(54, 162, 235, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(255, 206, 86, 0.7)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true } }
    }
});
</script>
@stop