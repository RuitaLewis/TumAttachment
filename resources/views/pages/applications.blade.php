<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        :root {
            --primary-color: #1a73e8;
            --sidebar-bg: #f8f9fa;
            --card-bg: white;
            --text-color: #333;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #f0f2f5;
            position: relative;
            overflow-x: hidden;
        }

        .sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar.closed {
            transform: translateX(-250px);
        }

        .menu-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            display: none;
        }

        .logo {
            color: #ff4444;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .menu-item {
            padding: 12px 15px;
            border-radius: 8px;
            color: var(--text-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            transition: background-color 0.3s;
        }

        .menu-item i {
            margin-right: 10px;
            width: 20px;
        }

        .menu-item:hover {
            background: rgba(26, 115, 232, 0.1);
        }

        .main-content {
            flex: 1;
            padding: 20px;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            width: calc(100% - 250px);
        }

        .main-content.expanded {
            margin-left: 0;
            width: 100%;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-bar {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            min-width: 200px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .stat-card h3 {
            color: var(--text-color);
            margin-bottom: 10px;
            font-size: 16px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .chart-container {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .profile-container {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .profile-container h3 {
            margin-bottom: 20px;
        }

        .profile-table {
            width: 100%;
            border-collapse: collapse;
        }

        .profile-table th,
        .profile-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .profile-table th {
            background: #f5f5f5;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .menu-toggle {
                display: block;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .header {
                margin-top: 40px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <button class="menu-toggle">
        <i class="fas fa-bars"></i>
    </button>

    @include('pages.components.aside')


    <div class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
            <input type="search" placeholder="Search..." class="search-bar">
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Students</h3>
                <div class="stat-value">150</div>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>johndoe@example.com</td>
                        <td>Active</td>
                        <td><button>Edit</button> <button>Delete</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>janesmith@example.com</td>
                        <td>Inactive</td>
                        <td><button>Edit</button> <button>Delete</button></td>
                    </tr>
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
