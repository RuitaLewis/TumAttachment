<div class="sidebar" id="sidebar">
    <div class="logo">
        Internship Portal
        <i class="fas fa-times close-menu" style="cursor: pointer; display: none;"></i>
    </div>

    @foreach($navigation as $item)
        <a href="{{ route($item['route']) }}"
           class="menu-item {{ Route::currentRouteName() == $item['route'] ? 'active' : '' }}">
            <i class="fas {{ $item['icon'] }}"></i> {{ $item['name'] }}
        </a>
    @endforeach

    <!-- Logout button -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <button class="menu-item" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
</div>