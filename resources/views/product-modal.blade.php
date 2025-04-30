<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Product - Laravel</title>

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
            display: flex;
            align-items: center;
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
            max-width: 48rem;
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
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            border-radius: 0.375rem;
        }

        /* Form title */
        .form-title {
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.875rem;
            font-weight: 600;
            color: #1f2937;
        }

        /* Success message */
        .success-message {
            margin-bottom: 1rem;
            color: #16a34a;
            font-weight: 500;
        }

        /* Form */
        .product-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Form group */
        .form-group {
            display: flex;
            flex-direction: column;
        }

        /* Form label */
        .form-label {
            font-size: 1.125rem;
            font-weight: 500;
            color: #374151;
        }

        /* Form input and select */
        .form-input,
        .form-select {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.15s ease-in-out, border-color 0.15s ease-in-out;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }

        /* Error message */
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
        }

        /* Submit button */
        .submit-button {
            padding: 0.75rem 1.5rem;
            font-size: 1.125rem;
            font-weight: 600;
            color: #ffffff;
            background-color: #2563eb;
            border: none;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            transition: background-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #1d4ed8;
        }

        .submit-button:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }

        /* Form button container */
        .form-button-container {
            text-align: center;
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
                <!-- Settings Dropdown and Hamburger -->
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
                    <!-- Hamburger -->

                </div>
            </div>
        </div>
        <!-- Responsive Navigation Menu -->
        <div x-show="open" class="responsive-nav">
            <div class="nav-links">
                <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('index') }}" class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}">
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
                <div class="form-title">
                    <h3>Add a New Product</h3>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Product Form -->
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
                    @csrf

                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">Product Name:</label>
                        <input type="text" id="name" name="name" class="form-input" required>
                        @error('name') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <!-- Quantity -->
                    <div class="form-group">
                        <label for="qty" class="form-label">Quantity:</label>
                        <input type="number" id="qty" name="qty" class="form-input" required>
                        @error('qty') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <!-- Unit Price -->
                    <div class="form-group">
                        <label for="unit_price" class="form-label">Unit Price (USD):</label>
                        <input type="number" step="0.01" id="unit_price" name="unit_price" class="form-input" required>
                        @error('unit_price') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <!-- Category Selection -->
                    <div class="form-group">
                        <label for="category_id" class="form-label">Category:</label>
                        <select id="category_id" name="category_id" class="form-select" required>
                            <option value="" disabled selected>Select a Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <!-- Product Image -->
                    <div class="form-group">
                        <label for="product_image" class="form-label">Product Image:</label>
                        <input type="file" id="product_image" name="product_image" accept="image/*" class="form-input" required>
                        @error('product_image') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-button-container">
                        <button type="submit" class="submit-button">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>