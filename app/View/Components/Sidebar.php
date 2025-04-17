<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class Sidebar extends Component
{
    public $navigation;
    public $currentRoute;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->currentRoute = Route::currentRouteName();

        $this->navigation = [
            [
                'name' => 'Dashboard',
                'route' => 'admin',
                'icon' => 'fa-home',
            ],
            [
                'name' => 'Profile',
                'route' => 'student-profile',
                'icon' => 'fa-user',
            ],
            [
                'name' => 'Attachment Postings',
                'route' => 'attachments.index',
                'icon' => 'fa-briefcase',
            ],
            [
                'name' => 'Organizations',
                'route' => 'organizations.index',
                'icon' => 'fa-building',
            ],

            [
                'name' => 'Applications',
                'route' => 'attachment.applications',
                'icon' => 'fa-paper-plane',
            ],
            [
                'name' => 'Apply for Attachment',
                'route' => 'attachment-application',
                'icon' => 'fa-file-alt',
            ],
            [
                'name' => 'Students',
                'route' => 'students.index',
                'icon' => 'fa-users',
            ],
            [
                'name' => 'Notifications',
                'route' => 'notifications',
                'icon' => 'fa-envelope',
            ],
            [
                'name' => 'Settings',
                'route' => 'settings',
                'icon' => 'fa-cog',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}