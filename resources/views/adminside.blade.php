<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Alpine.js for navigation interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Styles -->
    <style>
        /* General styles */
        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            line-height: 1.5;
            margin: 0;
            background-color: #f3f4f6;
        }

        /* Navigation bar */
        .nav {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        /* Navigation container */
        .nav-container {
            max-width: 80rem;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        @media (min-width: 640px) {
            .nav-container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .nav-container {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }

        /* Navigation flex layout */
        .nav-flex {
            display: flex;
            align-items: center;
            height: 4rem;
        }

        /* Logo and nav links container */
        .nav-left {
            display: flex;
            align-items: center;
            flex: 1;
        }

        /* Logo container */
        .logo-container {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Logo image */
        .logo {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Navigation links container */
        .nav-links {
            display: flex;
            gap: 2rem;
            margin: 0 auto;
        }

        @media (max-width: 639px) {
            .nav-links {
                display: none;
            }
        }

        /* Navigation link */
        .nav-link {
            display: inline-block;
            padding: 0.5rem 0;
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: color 0.15s ease-in-out;
        }

        .nav-link:hover {
            color: #374151;
        }

        .nav-link.active {
            color: #2563eb;
            border-bottom: 2px solid #2563eb;
        }

        /* Settings dropdown container */
        .settings-dropdown {
            flex-shrink: 0;
            margin-left: auto;
        }

        @media (max-width: 639px) {
            .settings-dropdown {
                display: none;
            }
        }

        /* Dropdown trigger */
        .dropdown-trigger {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            color: #6b7280;
            background-color: #ffffff;
            border: 1px solid transparent;
            border-radius: 0.375rem;
            transition: color 0.15s ease-in-out;
            cursor: pointer;
        }

        .dropdown-trigger:hover {
            color: #374151;
        }

        .dropdown-trigger:focus {
            outline: none;
        }

        .dropdown-trigger svg {
            width: 1rem;
            height: 1rem;
            margin-left: 0.25rem;
        }

        /* Dropdown menu */
        .dropdown-menu {
            position: absolute;
            right: 0;
            width: 12rem;
            background-color: #ffffff;
            border-radius: 0.375rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            z-index: 10;
        }

        /* Dropdown link */
        .dropdown-link {
            display: block;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            color: #374151;
            text-decoration: none;
            transition: background-color 0.15s ease-in-out;
        }

        .dropdown-link:hover {
            background-color: #f3f4f6;
        }

        /* Hamburger button */
        .hamburger {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: -0.5rem;
            padding: 0.5rem;
            border-radius: 0.375rem;
            color: #9ca3af;
            background-color: transparent;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
            cursor: pointer;
        }

        .hamburger:hover {
            color: #6b7280;
            background-color: #f3f4f6;
        }

        .hamburger:focus {
            outline: none;
            background-color: #f3f4f6;
            color: #6b7280;
        }

        .hamburger svg {
            width: 1.5rem;
            height: 1.5rem;
        }

        /* Responsive navigation */
        .responsive-nav {
            display: none;
        }

        @media (max-width: 639px) {
            .responsive-nav.open {
                display: block;
            }
        }

        /* Responsive nav links */
        .responsive-nav-links {
            padding-top: 0.5rem;
            padding-bottom: 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .responsive-nav-link {
            display: block;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            color: #374151;
            text-decoration: none;
            transition: background-color 0.15s ease-in-out;
        }

        .responsive-nav-link:hover {
            background-color: #f3f4f6;
        }

        .responsive-nav-link.active {
            color: #2563eb;
            background-color: #dbeafe;
        }

        /* Responsive settings */
        .responsive-settings {
            padding-top: 1rem;
            padding-bottom: 0.25rem;
            border-top: 1px solid #e5e7eb;
        }

        .user-info {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .user-name {
            font-size: 1rem;
            font-weight: 500;
            color: #1f2937;
        }

        .user-email {
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
        }

        .responsive-settings-links {
            margin-top: 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        /* Main container */
        .main-container {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        /* Content container */
        .content-container {
            max-width: 80rem;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        @media (min-width: 640px) {
            .content-container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .content-container {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }

        /* Card */
        .card {
            background-color: #ffffff;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
        }

        /* Card content */
        .card-content {
            padding-top: 3rem;
            padding-bottom: 3rem;
            color: #1f2937;
        }

        /* Welcome text */
        .welcome-text {
            display: flex;
            justify-content: center;
            margin-bottom: 3rem;
        }

        .welcome-title {
            font-size: 1.875rem;
            font-weight: 700;
            text-align: center;
            color: #1f2937;
        }

        /* Button grid */
        .button-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            max-width: 64rem;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        @media (min-width: 640px) {
            .button-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .button-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Button container */
        .button-container {
            display: flex;
            justify-content: center;
        }

        /* Buttons */
        .button {
            display: inline-block;
            width: 100%;
            max-width: 20rem;
            padding: 1rem 2rem;
            font-size: 1.125rem;
            font-weight: 600;
            color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
        }

        .button:hover {
            transform: scale(1.05);
        }

        /* Add Product Button */
        .add-product-button {
            background: linear-gradient(to right, #22c55e, #14b8a6);
        }

        .add-product-button:hover {
            background: linear-gradient(to right, #16a34a, #0d9488);
        }

        /* Show Product Button */
        .show-product-button {
            background: linear-gradient(to right, #8b5cf6, #ec4899);
        }

        .show-product-button:hover {
            background: linear-gradient(to right, #7c3aed, #db2777);
        }

        /* Category Button */
        .category-button {
            background: linear-gradient(to right, #eab308, #ef4444);
        }

        .category-button:hover {
            background: linear-gradient(to right, #ca8a04, #dc2626);
        }

        .order-button {
            background: linear-gradient(to right, #de3131, #e14e4e);
        }

        .order-button:hover {
            background: linear-gradient(to right, #ff0c0c, #8d0000);
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav x-data="{ open: false }" class="nav">
        <!-- Primary Navigation Menu -->
        <div class="nav-container">
            <div class="nav-flex">
                <!-- Logo and Navigation Links -->
                <div class="nav-left">
                    <!-- Logo -->
                    <div class="logo-container">
                        <a href="{{ route('dashboard.index') }}">
                            <div class="logo">
                                <img src="{{ asset('IMG/logo.jpeg') }}" alt="Kru Rith">
                            </div>
                        </a>
                    </div>
                    <!-- Navigation Links -->
                    <div class="nav-links">
                        <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                            {{ __('Dashboard') }}
                        </a>
                        <a href="{{ route('index') }}" class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}">
                            {{ __('Admin') }}
                        </a>
                    </div>
                </div>
                <!-- Settings Dropdown -->
                <div class="settings-dropdown">
                    <div x-data="{ open: false }" @click.outside="open = false" class="relative">
                        <button @click="open = !open" class="dropdown-trigger">
                            <div>Admin</div>
                            <div>
                                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        <div x-show="open" class="dropdown-menu">
                            <!-- Dropdown items can be added here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Responsive Navigation Menu -->
        <div x-show="open" class="responsive-nav">
            <div class="responsive-nav-links">
                <a href="{{ route('dashboard.index') }}" class="responsive-nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('index') }}" class="responsive-nav-link {{ request()->routeIs('index') ? 'active' : '' }}">
                    {{ __('Admin') }}
                </a>
            </div>
            <!-- Responsive Settings Options -->
            <div class="responsive-settings">
                <div class="user-info">
                    <div class="user-name">Admin</div>
                    <div class="user-email">Gmail</div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <div class="content-container">
            <div class="card">
                <div class="card-content">
                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <div class="welcome-title">
                            Welcome to Admin Side
                        </div>
                    </div>
                    <!-- Button Grid -->
                    <div class="button-grid">
                        <!-- Add Product Button -->
                        <div class="button-container">
                            <a href="{{ route('product.create') }}" class="button add-product-button">
                                Add Product
                            </a>
                        </div>
                        <!-- Show Product Button -->
                        <div class="button-container">
                            <a href="{{ route('products.show') }}" class="button show-product-button">
                                Show Product
                            </a>
                        </div>
                        <!-- Category Button -->
                        <div class="button-container">
                            <a href="{{ route('categories.index') }}" class="button category-button">
                                Category
                            </a>
                        </div>

                        <div class="button-container">
                            <a href="{{ route('order.index') }}" class="button order-button">
                                View Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>