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
                'name' => 'Student Profiles',
                'route' => 'student-profile',
                'icon' => 'fa-user',
            ],
            [
                'name' => 'Organizations',
                'route' => 'organizations',
                'icon' => 'fa-building',
            ],
            [
                'name' => 'Internship Postings',
                'route' => 'attachment-posting',
                'icon' => 'fa-briefcase',
            ],
            [
                'name' => 'Applications',
                'route' => 'applications',
                'icon' => 'fa-paper-plane',
            ],
            [
                'name' => 'Apply for Internship',
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