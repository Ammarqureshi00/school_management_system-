@extends('layouts.app')

@section('content')
<div class="container">
      <h1 class="mb-4">Admin Dashboard</h1>

      <!-- Row: Stats Cards -->
      <div class="row mb-4">
            <!-- Students Count -->
            <div class="col-md-4">
                  <div class="card text-white bg-primary shadow-sm h-100">
                        <div class="card-body text-center">
                              <i class="fas fa-user-graduate fa-2x mb-2"></i>
                              <h5 class="card-title">Students</h5>
                              <h3>{{ $counts['Student'] ?? 0 }}</h3>
                        </div>
                  </div>
            </div>

            <!-- Teachers Count -->
            <div class="col-md-4">
                  <div class="card text-white bg-success shadow-sm h-100">
                        <div class="card-body text-center">
                              <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i>
                              <h5 class="card-title">Teachers</h5>
                              <h3>{{ $counts['Teacher'] ?? 0 }}</h3>
                        </div>
                  </div>
            </div>

            <!-- Classes Count -->
            <div class="col-md-4">
                  <div class="card text-white bg-warning shadow-sm h-100">
                        <div class="card-body text-center">
                              <i class="fas fa-school fa-2x mb-2"></i>
                              <h5 class="card-title">Classes</h5>
                              <h3>{{ $counts['Class'] ?? 0 }}</h3>
                        </div>
                  </div>
            </div>
      </div>

      <!-- Row: Chart -->
      <div class="row mb-4">
            <div class="col-md-12">
                  <div class="card shadow-sm">
                        <div class="card-body">
                              <h5 class="card-title">Users Overview</h5>
                              <canvas id="adminChart"></canvas>
                        </div>
                  </div>
            </div>
      </div>

      <!-- Row: Manage Links -->
      <div class="row">
            <div class="col-md-6">
                  <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                              <i class="fas fa-users-cog fa-2x mb-2 text-info"></i>
                              <h5 class="card-title">Manage Users</h5>
                              <p class="card-text">Add, update, or remove system users.</p>
                              <a href="{{ route('superadmin.users.index') }}" class="btn btn-info">Go</a>
                        </div>
                  </div>
            </div>

            <div class="col-md-6">
                  <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                              <i class="fas fa-cogs fa-2x mb-2 text-dark"></i>
                              <h5 class="card-title">Settings</h5>
                              <p class="card-text">Manage system settings & preferences.</p>
                              <a href="#" class="btn btn-dark">Go</a>
                        </div>
                  </div>
            </div>
      </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
      var ctx = document.getElementById('adminChart').getContext('2d');
    var adminChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Users Count',
                data: {!! json_encode($chartData) !!},
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8']
            }]
        }
    });
</script>
@endsection