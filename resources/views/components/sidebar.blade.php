<div class="sidebar" id="sidebar">
    <a href="/" class="logo text-decoration-none">
        Attachment Portal
        <i class="fas fa-times close-menu" style="cursor: pointer; display: none;"></i>
    </a>

    @foreach($navigation as $item)
    @php
        $url = ($item['route'] === 'attachment-application')
            ? route($item['route'], ['id' => auth()->id()])
            : route($item['route']);
    @endphp
    <a href="{{ $url }}"
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