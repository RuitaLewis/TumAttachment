@extends('admin.layouts.app')
@section('title', 'Organization Management Dashboard')

@section('head')
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

        /* Sidebar Styles */
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

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 20px;
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .search-bar {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            min-width: 200px;
        }

        /* Stats Grid Styles */
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

        /* Form Styles */
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .form-container h3 {
            margin-bottom: 20px;
            color: var(--text-color);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--text-color);
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group button {
            background: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Table Styles */
        .profile-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .profile-container h3 {
            margin-bottom: 20px;
            color: var(--text-color);
        }

        .profile-table {
            width: 100%;
            border-collapse: collapse;
        }

        .profile-table th,
        .profile-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .profile-table th {
            background: #f8f9fa;
            font-weight: 600;
        }

        .profile-table button {
            padding: 6px 12px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .profile-table button:first-child {
            background: var(--primary-color);
            color: white;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            position: relative;
        }

        .close-btn {
            position: absolute;
            right: 20px;
            top: 10px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        #editForm {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        #editForm input,
        #editForm select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 5px;
            width: 100%;
        }

        #editForm button {
            background: var(--primary-color);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        /* Mobile Responsive Styles */
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
                flex-direction: column;
                gap: 15px;
                margin-top: 40px;
            }

            .search-bar {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .profile-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
@endsection


@php
    $organizations = \App\Models\Organization::all();
    $total_organizations = \App\Models\Organization::all()->count();
    $total_active_organization = \App\Models\Organization::where('status', 'active')->count();
@endphp
@section('content')

    <button class="menu-toggle">
        <i class="fas fa-bars"></i>
    </button>


    <div class="stats-grid">
        <div class="stat-card">
            <h3>Active Organization</h3>
            <div class="stat-value">{{ $total_active_organization }}</div>
            <div class="stat-label">Total Active Organizations</div>
        </div>
        <div class="stat-card">
            <h3>Organizations</h3>
            <div class="stat-value">{{ $total_organizations }}</div>
            <div class="stat-label">Total Registered Organizations</div>
        </div>
    </div>

    <div class="form-container">
        <h3>New Organization Form</h3>
        <form action="/organizations" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="location">Location Link</label>
                <input type="url" id="location" name="location" placeholder="https://example.com/location" required>
            </div>
            <div class="form-group">
                <button type="submit">Create</button>
            </div>
        </form>
    </div>

    <div class="profile-container">
        <h3>Organization List</h3>
        <table class="profile-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($organizations as $organization)
                    <tr>
                        <td>{{ $organization->id }}</td>
                        <td>{{ $organization->name }}</td>
                        <td>{{ $organization->email }}</td>
                        <td>{{ $organization->status }}</td>
                        <td>
                            <button type="button"
                                onclick="openEditModal(
                                    {{ $organization->id }},
                                    '{{ $organization->name }}',
                                    '{{ $organization->email }}',
                                    '{{ $organization->location }}',
                                    '{{ $organization->status }}'
                                )">Edit</button>
                            <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Are you sure you want to delete this organization?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="background:none; border:none; color: red; cursor: pointer;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Edit Organization</h2>
            <form id="editForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_name">Name:</label>
                    <input type="text" id="edit_name" name="name" required>
                </div>

                <div>
                    <label for="edit_email">Email:</label>
                    <input type="email" id="edit_email" name="email" required>
                </div>

                <div>
                    <label for="edit_location">Location:</label>
                    <input type="text" id="edit_location" name="location" required>
                </div>

                <div>
                    <label for="edit_status">Status:</label>
                    <select id="edit_status" name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        // Menu Toggle
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });

        // Modal Functions
        function openEditModal(id, name, email, location, status) {
            // Get the modal
            const modal = document.getElementById('editModal');

            // Set form values
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_location').value = location;
            document.getElementById('edit_status').value = status;

            // Set the form action
            const form = document.getElementById('editForm');
            form.action = `/organizations/${id}`;

            // Show the modal
            modal.style.display = 'block';

            // Debug log
            console.log('Modal opened with:', {
                id,
                name,
                email,
                location,
                status
            });
        }

        // Close button functionality
        const closeBtn = document.querySelector('.close-btn');
        closeBtn.onclick = function() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Click outside to close
        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
@endsection
