@extends('admin.layouts.app')

@php
    $totalusers = \App\Models\User::all()->count();
    $users = \App\Models\user::all();

@endphp
@section('content')
    <button class="menu-toggle">
        <i class="fas fa-bars"></i>
    </button>
    <div class="">
        @include('admin.partials.pagetitle')
        <div class="profile-container">
            <h3>Student</h3>
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
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><button>Edit</button> <button>Delete</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
