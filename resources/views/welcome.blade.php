<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tum - Attachment/Attachment Applications</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/welcome.css">
</head>

<body>
    <nav class="navbar">
        <div class="nav-content">
            <a href="#" class="logo">Tum.</a>
            <div class="nav-links">
                <a href="#features">Benefits</a>
                <a href="/attachments">Attachments</a>
                @guest
                    <a href="/login" class="cta-button">Login</a>
                @else
                    <a href="/logout" class="cta-button"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @if (Auth::user()->hasRole('Admin'))
                        <a href="/admin" class="cta-button">Admin Panel</a>
                    @elseif(Auth::user()->hasRole('Student'))
                        <a href="/student-profile" class="cta-button">Student Panel</a>
                    @elseif(Auth::user()->hasRole('Institution'))
                        <a href="/admin" class="cta-button">Institution Panel</a>
                    @elseif(Auth::user()->hasRole('Organization'))
                        <a href="/admin" class="cta-button">Organization Panel</a>
                    @endif
                @endguest
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Launch Your Career with Tum Attachment</h1>
                <p>Gain hands-on experience, expand your professional network, and make a meaningful impact with our
                    Attachment program.</p>
                <a href="/attachment-application" class="cta-button">Start Application</a>
            </div>
            <div class="hero-image">
                <img src="assets/images/Attachment.jpg" alt="Attachment Opportunities">
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="features-content">
            <div class="section-title">
                <h2>Why Choose Tum Attachment</h2>
                <p>Everything you need for a successful Attachment experience</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-briefcase"></i>
                    <h3>Professional Development</h3>
                    <p>Develop real-world skills, learn from experienced mentors, and enhance your resume with valuable
                        Attachment experience.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-users"></i>
                    <h3>Collaborative Environment</h3>
                    <p>Work alongside a diverse team and build connections that will help you in your career journey.
                    </p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-cogs"></i>
                    <h3>Hands-On Projects</h3>
                    <p>Take on real tasks and projects that make a difference, putting your skills to the test in a
                        professional setting.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>Growth Opportunities</h3>
                    <p>Explore potential full-time opportunities post-Attachment and continue growing within the
                        organization.</p>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
