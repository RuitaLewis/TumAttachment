<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tum - Available Attachments</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/welcome.css">
    <link rel="stylesheet" href="assets/css/attachment.css">
</head>

<body>
    <nav class="navbar">
        <div class="nav-content">
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="/profile">Profile</a>
                <a href="/login" class="cta-button">Login</a>
            </div>
        </div>
    </nav>

    <section class="attachment-list">
        <div class="container">
            <div class="section-title mt-4">
                <h2>Available Attachment Opportunities</h2>
                <p>Find and apply for attachment positions that match your skills and career goals</p>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    @include('pages.attachments.partials.attachment-card')
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
