@php
    $messages = App\Models\Message::where('user_id', Auth::id())->latest()->get();
@endphp

@extends('admin.layouts.app')

@section('title', 'Notifications')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/student-profile.css') }}">
@endsection

@section('content')

    <div class="header">
        <h1>Your Notifications</h1>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Notifications</h2>
            <p>Stay updated with the latest notifications and messages.</p>
        </div>
        <div class="card-body">
            @forelse ($messages as $message)
                <div class="notification-item">
                    <p><strong>{{ $message->subject }}:</strong> {{ $message->body }}</p>
                    <div class="actions">
                        <button class="mark-read">Mark as Read</button>
                        <button class="delete">Delete</button>
                    </div>
                </div>
            @empty
                <p class="no-notifications" style="text-align: center;">No notifications available. You're all caught up!
                </p>
            @endforelse
        </div>
    </div>

    <style>
        .notification-item {
            background: var(--card-bg);
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .notification-item p {
            margin-bottom: 10px;
            color: var(--text-color);
        }

        .actions button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            margin-right: 5px;
        }

        .actions button:hover {
            background: #155db8;
        }

        .no-notifications {
            font-size: 14px;
            color: var(--text-color);
            margin-top: 20px;
        }
    </style>

    <script>
        document.querySelectorAll('.delete').forEach(button => {
            button.addEventListener('click', function() {
                const notification = this.closest('.notification-item');
                notification.remove();
                checkNotifications();
            });
        });

        document.querySelectorAll('.mark-read').forEach(button => {
            button.addEventListener('click', function() {
                const notification = this.closest('.notification-item');
                notification.style.opacity = '0.6';
                this.disabled = true;
            });
        });

        function checkNotifications() {
            if (!document.querySelector('.notification-item')) {
                document.querySelector('.no-notifications').style.display = 'block';
            }
        }
    </script>

@endsection
