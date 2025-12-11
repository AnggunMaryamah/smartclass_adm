<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SmartClass Siswa</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- OpenDyslexic Webfont --}}
    <link href="https://fonts.cdnfonts.com/css/opendyslexic" rel="stylesheet">

    <style>
        :root {
            --primary-dark: #003366;
            --primary-medium: #0055A5;
            --primary-gradient-start: #003366;
            --primary-gradient-end: #002147;

            --accent-cyan: #00B8D4;
            --accent-cyan-light: #4DD0E1;
            --accent-cyan-tint: #E0F7FA;
            --accent-cyan-hover: #0097A7;

            --accent-green: #8BC34A;
            --accent-green-light: #AED581;
            --accent-green-tint: #F1F8E9;
            --accent-green-dark: #7CB342;

            --bg-base: #F5F7FA;
            --bg-card: #FFFFFF;
            --bg-hover: #EDF2F7;
            --bg-subtle: #E8EEF3;

            --text-primary: #2D3748;
            --text-secondary: #4A5568;
            --text-muted: #718096;
            --text-white: #FFFFFF;

            --border-light: #E2E8F0;
            --border-medium: #CBD5E0;

            --warning: #FFA726;
            --warning-light: #FFF3E0;
            --danger: #EF5350;
            --danger-light: #FFEBEE;

            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.7);

            --shadow-sm: 0 2px 8px rgba(0, 51, 102, 0.06);
            --shadow-md: 0 4px 12px rgba(0, 51, 102, 0.08);
            --shadow-lg: 0 8px 20px rgba(0, 51, 102, 0.10);
            --shadow-xl: 0 12px 28px rgba(0, 51, 102, 0.12);
            --shadow-cyan: 0 4px 12px rgba(0, 184, 212, 0.25);
            --shadow-green: 0 4px 12px rgba(139, 195, 74, 0.25);

            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(
                135deg,
                #F5F7FA 0%,
                #EDF2F7 50%,
                #E8EEF3 100%
            );
            background-attachment: fixed;
            color: var(--text-primary);
            overflow-x: hidden;
            min-height: 100vh;
        }
        /* FONT FAMILY VARIASI */
.reader-root.font-default {
    font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

.reader-root.font-serif {
    font-family: 'Georgia', 'Times New Roman', serif;
}

/* OpenDyslexic */
.reader-root.font-opendyslexic {
    font-family: 'OpenDyslexic', system-ui, sans-serif;
}


        /* Style global lain dari layout siswa tetap boleh dipakai konten */
        main {
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        @media (max-width: 991px) {
            main {
                padding: 0;
            }
        }

        @media (max-width: 767px) {
            main {
                padding: 0;
            }
        }

        @media (max-width: 575px) {
            main {
                padding: 0;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    {{-- Layout reader: tidak ada sidebar & top bar, hanya konten halaman --}}
    <main>
        @yield('content')
    </main>

    {{-- Chart.js tetap disertakan jika konten butuh chart --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('scripts')
    @yield('script')
</body>
</html>
