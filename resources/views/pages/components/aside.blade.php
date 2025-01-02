<div class="sidebar">
    <div class="logo">
        Internship Portal
        <i class="fas fa-times close-menu" style="cursor: pointer; display: none;"></i>
    </div>
    <a href="/admin" class="menu-item"><i class="fas fa-home"></i> Dashboard</a>
    <a href="/student-profile" class="menu-item"><i class="fas fa-user"></i> Student Profiles</a>
    <a href="/organizations" class="menu-item"><i class="fas fa-building"></i> Organizations</a>
    <a href="/attachment-posting" class="menu-item"><i class="fas fa-briefcase"></i> Internship Postings</a>
    <a href="/applications" class="menu-item"><i class="fas fa-paper-plane"></i> Applications</a>
    <a href="/attachment-application" class="menu-item"><i class="fas fa-file-alt"></i> Apply for Internship</a>
    <a href="/notifications" class="menu-item"><i class="fas fa-envelope"></i> Notifications</a>
    <a href="/settings" class="menu-item"><i class="fas fa-cog"></i> Settings</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <button  class="menu-item" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </button>
    
</div>