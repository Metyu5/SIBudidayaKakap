<!doctype html>
<html lang="id" x-data="dashboard()">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Teknisi</title>
    <link rel="icon" href="../assets/images/logoHeader.png" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="../src/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* CSS Global dari header admin, jika ada yang berbeda bisa disesuaikan */
        * {
            font-family: 'Poppins', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Kelas sidebar dan main-content untuk transisi */
        .sidebar {
            transition: transform 0.3s ease, width 0.3s ease;
        }

        .sidebar-collapsed {
            width: 80px;
        }

        .sidebar-collapsed .sidebar-item-text,
        .sidebar-collapsed .sidebar-header-text,
        .sidebar-collapsed .sidebar-dropdown-items {
            display: none;
        }

        .sidebar-collapsed .sidebar-item {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        .sidebar-collapsed .sidebar-header {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        .sidebar-collapsed .sidebar-dropdown-icon {
            display: none;
        }

        .main-content {
            transition: margin-left 0.3s ease;
        }

        /* Optional: Custom scrollbar for a cleaner look */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            /* slate-300 */
            border-radius: 4px;
        }

        ::-webkit-scrollbar-track {
            background-color: #f1f5f9;
            /* slate-100 */
        }
    </style>
</head>