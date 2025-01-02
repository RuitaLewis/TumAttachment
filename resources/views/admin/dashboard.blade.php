<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>
    <button class="menu-toggle">
        <i class="fas fa-bars"></i>
    </button>
@php
    $totalusers = \App\Models\User::all()->count();
    $users= \App\Models\user::all();

@endphp
    @include('pages.components.aside')


    <div class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
            <input type="search" placeholder="Search..." class="search-bar">
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Students</h3>
                <div class="stat-value">{{$totalusers}}</div>
                <div class="stat-label">Total Registered Students</div>
            </div>
            <div class="stat-card">
                <h3>Organizations</h3>
                <div class="stat-value">45</div>
                <div class="stat-label">Total Registered Organizations</div>
            </div>
            <div class="stat-card">
                <h3>Internship Postings</h3>
                <div class="stat-value">30</div>
                <div class="stat-label">Active Postings</div>
            </div>
            <div class="stat-card">
                <h3>Applications</h3>
                <div class="stat-value">300</div>
                <div class="stat-label">Total Applications</div>
            </div>
        </div>

        <div class="chart-container">
            <canvas id="studentChart" width="400" height="200"></canvas>
        </div>

        <div class="profile-container">
            <h3>Student Profiles</h3>
            <table class="profile-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Internship Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td><button>Edit</button> <button>Delete</button></td>
                    </tr> 
                    @endforeach
                 
                   
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });

        const ctx = document.getElementById('studentChart').getContext('2d');
        const studentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Active', 'Inactive', 'Completed', 'Pending'],
                datasets: [{
                    label: 'Students',
                    data: [80, 40, 20, 10],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
