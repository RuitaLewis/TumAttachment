<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        :root {
            --primary-color: #1a73e8;
            --sidebar-bg: #f8f9fa;
            --card-bg: white;
            --text-color: #333;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #f0f2f5;
            position: relative;
            overflow-x: hidden;
        }

        .sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar.closed {
            transform: translateX(-250px);
        }

        .menu-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            display: none;
        }

        .logo {
            color: #ff4444;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .menu-item {
            padding: 12px 15px;
            border-radius: 8px;
            color: var(--text-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            transition: background-color 0.3s;
        }

        .menu-item i {
            margin-right: 10px;
            width: 20px;
        }

        .menu-item:hover {
            background: rgba(26, 115, 232, 0.1);
        }

        .main-content {
            flex: 1;
            padding: 20px;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            width: calc(100% - 250px);
        }

        .main-content.expanded {
            margin-left: 0;
            width: 100%;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-bar {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            min-width: 200px;
        }

        .form-container {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            margin: 0 auto;
        }

        .form-container h3 {
            margin-bottom: 20px;
            color: var(--text-color);
            font-size: 18px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--text-color);
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: none;
            height: 100px;
        }

        .form-group button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .form-group button:hover {
            background: #155db8;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .menu-toggle {
                display: block;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .header {
                margin-top: 40px;
            }
        }
    </style>
</head>

<body>
    <button class="menu-toggle">
        <i class="fas fa-bars"></i>
    </button>

    @include('pages.components.aside')


    <div class="main-content">
        <div class="header">
            <h1>Apply for Attachment</h1>
        </div>

        <div class="form-container">
            <h3>Attachment Application Form</h3>
            <form action="/submit-application" method="POST">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="position">Preferred Attachment Position</label>
                    <select id="position" name="position" required>
                        <option value="">Select Position</option>
                        <option value="Software Developer">Software Developer</option>
                        <option value="Data Analyst">Data Analyst</option>
                        <option value="Marketing Intern">Marketing Intern</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="resume">Resume Link</label>
                    <input type="url" id="resume" name="resume" placeholder="https://example.com/resume" required>
                </div>
                <div class="form-group">
                    <label for="message">Why should we hire you?</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit">Submit Application</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });
    </script>
</body>

</html>
