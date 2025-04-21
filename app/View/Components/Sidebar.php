<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Sidebar extends Component
{
    public $navigation;
    public $currentRoute;

    public function __construct()
    {
        $this->currentRoute = Route::currentRouteName();

        $allNavigation = [
            [
                'name' => 'Dashboard',
                'route' => 'admin',
                'icon' => 'fa-home',
                'roles' => ['Admin'],
            ],
            [
                'name' => 'Profile',
                'route' => 'student-profile',
                'icon' => 'fa-user',
                'roles' => ['Student'],
            ],
            [
                'name' => 'Attachment Postings',
                'route' => 'attachments.index',
                'icon' => 'fa-briefcase',
                'roles' => ['Admin', 'Organization'],
            ],
            [
                'name' => 'Organizations',
                'route' => 'organizations.index',
                'icon' => 'fa-building',
                'roles' => ['Admin'],
            ],
            [
                'name' => 'Applications',
                'route' => 'attachment.applications',
                'icon' => 'fa-paper-plane',
                'roles' => ['Admin','Institution', 'Organization'],
            ],
            [
                'name' => 'Students',
                'route' => 'students.index',
                'icon' => 'fa-users',
                'roles' => ['Admin', 'Institution'],
            ],
            [
                'name' => 'Notifications',
                'route' => 'notifications',
                'icon' => 'fa-envelope',
                'roles' => ['Admin', 'Student', 'Organization', 'Institution'],
            ],
        ];

        $user = Auth::user();
        $this->navigation = array_filter($allNavigation, function ($item) use ($user) {
            return $user && $user->hasAnyRole($item['roles']);
        });
    }

    public function render()
    {
        return view('components.sidebar');
    }
}
