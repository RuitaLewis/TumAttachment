@extends('admin.layouts.app')
@section('title', 'Organization Management Dashboard')

@section('styles')
    <link rel="stylesheet" href="assets/css/organization.css">
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

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>New Organization Form</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('organizations') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" placeholder="Tum Attachment" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" placeholder="+254712345678" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location Link</label>
                            <input type="url" id="location" name="location" placeholder="https://example.com/location"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control" placeholder="Address"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <button type="submit">Create</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="profile-container">
                <h3>Organization List</h3>
                <table class="profile-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>phone</th>
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
                                <td>{{ $organization->phone }}</td>
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
                                    <form action="{{ route('organizations.destroy', $organization->id) }}"
                                        method="POST" style="display: inline;"
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
        </div>
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
