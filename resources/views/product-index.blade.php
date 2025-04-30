<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product List - Laravel</title>

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
            background-color: #f3f4f6; /* Light gray background for consistency */
        }

        /* Navigation bar */
        .nav {
            background-color: #ffffff; /* Equivalent to bg-white */
            border-bottom: 1px solid #e5e7eb; /* Equivalent to border-b border-gray-100 */
        }

        /* Navigation container */
        .nav-container {
            max-width: 80rem; /* Equivalent to max-w-7xl */
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem; /* Equivalent to px-4 */
            padding-right: 1rem;
        }

        @media (min-width: 640px) {
            .nav-container {
                padding-left: 1.5rem; /* Equivalent to sm:px-6 */
                padding-right: 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .nav-container {
                padding-left: 2rem; /* Equivalent to lg:px-8 */
                padding-right: 2rem;
            }
        }

        /* Navigation flex layout */
        .nav-flex {
            display: flex;
            justify-content: space-between; /* Equivalent to justify-between */
            height: 4rem; /* Equivalent to h-16 */
        }

        /* Logo container */
        .logo-container {
            flex-shrink: 0; /* Equivalent to shrink-0 */
            display: flex;
            align-items: center; /* Equivalent to items-center */
            justify-content: center; /* Equivalent to justify-center */
        }

        /* Logo image */
        .logo {
            width: 3rem; /* Equivalent to w-12 */
            height: 3rem; /* Equivalent to h-12 */
            border-radius: 50%; /* Equivalent to rounded-full */
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo img {
            width: 100%; /* Equivalent to w-full */
            height: 100%; /* Equivalent to h-full */
            object-fit: cover; /* Equivalent to object-cover */
        }

        /* Navigation links container */
        .nav-links {
            display: flex;
            gap: 2rem; /* Equivalent to space-x-8 */
            margin-top: -2px; /* Equivalent to sm:-my-px */
            margin-left: 2.5rem; /* Equivalent to sm:ms-10 */
        }

        @media (max-width: 639px) {
            .nav-links {
                display: none; /* Equivalent to hidden sm:flex */
            }
        }

        /* Navigation link */
        .nav-link {
            display: inline-block;
            padding: 0.5rem 0;
            font-size: 0.875rem; /* Equivalent to text-sm */
            font-weight: 500; /* Equivalent to font-medium */
            color: #6b7280; /* Equivalent to text-gray-500 */
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: color 0.15s ease-in-out;
        }

        .nav-link:hover {
            color: #374151; /* Equivalent to hover:text-gray-700 */
        }

        .nav-link.active {
            color: #2563eb; /* Equivalent to text-blue-600 */
            border-bottom: 2px solid #2563eb; /* Equivalent to border-b-2 border-blue-600 */
        }

        /* Dropdown trigger */
        .dropdown-trigger {
            display: inline-flex;
            align-items: center; /* Equivalent to items-center */
            padding: 0.5rem 0.75rem; /* Equivalent to px-3 py-2 */
            font-size: 0.875rem; /* Equivalent to text-sm */
            line-height: 1.25rem; /* Equivalent to leading-4 */
            font-weight: 500; /* Equivalent to font-medium */
            color: #6b7280; /* Equivalent to text-gray-500 */
            background-color: #ffffff; /* Equivalent to bg-white */
            border: 1px solid transparent; /* Equivalent to border border-transparent */
            border-radius: 0.375rem; /* Equivalent to rounded-md */
            transition: color 0.15s ease-in-out; /* Equivalent to transition ease-in-out duration-150 */
            cursor: pointer;
        }

        .dropdown-trigger:hover {
            color: #374151; /* Equivalent to hover:text-gray-700 */
        }

        .dropdown-trigger:focus {
            outline: none;
        }

        .dropdown-trigger svg {
            width: 1rem; /* Equivalent to w-4 */
            height: 1rem; /* Equivalent to h-4 */
            margin-left: 0.25rem; /* Equivalent to ms-1 */
        }

        /* Dropdown menu */
        .dropdown-menu {
            position: absolute;
            right: 0;
            width: 12rem; /* Equivalent to width="48" (48 * 0.25rem = 12rem) */
            background-color: #ffffff; /* Equivalent to bg-white */
            border-radius: 0.375rem; /* Equivalent to rounded-md */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* Equivalent to shadow-xl */
            z-index: 10;
        }

        /* Dropdown link */
        .dropdown-link {
            display: block;
            padding: 0.5rem 1rem; /* Equivalent to implicit padding */
            font-size: 0.875rem; /* Equivalent to text-sm */
            color: #374151; /* Equivalent to text-gray-700 */
            text-decoration: none;
            transition: background-color 0.15s ease-in-out;
        }

        .dropdown-link:hover {
            background-color: #f3f4f6; /* Equivalent to hover:bg-gray-100 */
        }

        /* Settings dropdown container */
        .settings-dropdown {
            display: flex;
            align-items: center; /* Equivalent to sm:items-center */
            margin-left: 1.5rem; /* Equivalent to sm:ms-6 */
        }

        @media (max-width: 639px) {
            .settings-dropdown {
                display: none; /* Equivalent to hidden sm:flex */
            }
        }

        /* Hamburger button */
        .hamburger {
            display: flex;
            align-items: center; /* Equivalent to items-center */
            justify-content: center; /* Equivalent to justify-center */
            margin-right: -0.5rem; /* Equivalent to -me-2 */
            padding: 0.5rem; /* Equivalent to p-2 */
            border-radius: 0.375rem; /* Equivalent to rounded-md */
            color: #9ca3af; /* Equivalent to text-gray-400 */
            background-color: transparent;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
            cursor: pointer;
        }

        .hamburger:hover {
            color: #6b7280; /* Equivalent to hover:text-gray-500 */
            background-color: #f3f4f6; /* Equivalent to hover:bg-gray-100 */
        }

        .hamburger:focus {
            outline: none;
            background-color: #f3f4f6; /* Equivalent to focus:bg-gray-100 */
            color: #6b7280; /* Equivalent to focus:text-gray-500 */
        }

        .hamburger svg {
            width: 1.5rem; /* Equivalent to w-6 */
            height: 1.5rem; /* Equivalent to h-6 */
        }

        /* Responsive navigation */
        .responsive-nav {
            display: none; /* Equivalent to hidden sm:hidden */
        }

        @media (max-width: 639px) {
            .responsive-nav.open {
                display: block; /* Equivalent to block when open */
            }
        }

        /* Responsive nav links */
        .responsive-nav-links {
            padding-top: 0.5rem; /* Equivalent to pt-2 */
            padding-bottom: 0.75rem; /* Equivalent to pb-3 */
            display: flex;
            flex-direction: column;
            gap: 0.25rem; /* Equivalent to space-y-1 */
        }

        .responsive-nav-link {
            display: block;
            padding: 0.5rem 1rem; /* Equivalent to implicit padding */
            font-size: 0.875rem; /* Equivalent to text-sm */
            color: #374151; /* Equivalent to text-gray-700 */
            text-decoration: none;
            transition: background-color 0.15s ease-in-out;
        }

        .responsive-nav-link:hover {
            background-color: #f3f4f6; /* Equivalent to hover:bg-gray-100 */
        }

        .responsive-nav-link.active {
            color: #2563eb; /* Equivalent to text-blue-600 */
            background-color: #dbeafe; /* Equivalent to bg-blue-100 */
        }

        /* Responsive settings */
        .responsive-settings {
            padding-top: 1rem; /* Equivalent to pt-4 */
            padding-bottom: 0.25rem; /* Equivalent to pb-1 */
            border-top: 1px solid #e5e7eb; /* Equivalent to border-t border-gray-200 */
        }

        .user-info {
            padding-left: 1rem; /* Equivalent to px-4 */
            padding-right: 1rem;
        }

        .user-name {
            font-size: 1rem; /* Equivalent to text-base */
            font-weight: 500; /* Equivalent to font-medium */
            color: #1f2937; /* Equivalent to text-gray-800 */
        }

        .user-email {
            font-size: 0.875rem; /* Equivalent to text-sm */
            font-weight: 500; /* Equivalent to font-medium */
            color: #6b7280; /* Equivalent to text-gray-500 */
        }

        .responsive-settings-links {
            margin-top: 0.75rem; /* Equivalent to mt-3 */
            display: flex;
            flex-direction: column;
            gap: 0.25rem; /* Equivalent to space-y-1 */
        }

        /* Main container */
        .main-container {
            padding-top: 3rem; /* Equivalent to py-12 */
            padding-bottom: 3rem;
            background-color: #f3f4f6; /* Equivalent to bg-gray-100 */
        }

        /* Content container */
        .content-container {
            max-width: 80rem; /* Equivalent to max-w-7xl */
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        @media (min-width: 640px) {
            .content-container {
                padding-left: 1.5rem; /* Equivalent to sm:px-6 */
                padding-right: 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .content-container {
                padding-left: 2rem; /* Equivalent to lg:px-8 */
                padding-right: 2rem;
            }
        }

        /* Card */
        .card {
            background-color: #ffffff; /* Equivalent to bg-white */
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1); /* Equivalent to shadow-lg */
            border-radius: 0.5rem; /* Equivalent to sm:rounded-lg */
        }

        /* Card content */
        .card-content {
            padding: 2rem 1.5rem; /* Equivalent to py-8 px-6 */
        }

        /* Section title */
        .section-title {
            font-size: 1.5rem; /* Equivalent to text-2xl */
            font-weight: 600; /* Equivalent to font-semibold */
            color: #1f2937; /* Equivalent to text-gray-900 */
            margin-bottom: 1.5rem; /* Equivalent to mb-6 */
        }

        /* Empty message */
        .empty-message {
            text-align: center; /* Equivalent to text-center */
            color: #6b7280; /* Equivalent to text-gray-500 */
        }

        /* Table container */
        .table-container {
            overflow-x: auto; /* Equivalent to overflow-x-auto */
            background-color: #ffffff; /* Equivalent to bg-white */
            border-radius: 0.375rem; /* Equivalent to rounded-lg */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Equivalent to shadow-md */
        }

        /* Table */
        .product-table {
            width: 100%; /* Equivalent to min-w-full */
            border-collapse: collapse; /* Equivalent to table-auto */
            font-size: 0.875rem; /* Equivalent to text-sm */
            text-align: left; /* Equivalent to text-left */
        }

        /* Table header */
        .product-table thead {
            background-color: #e5e7eb; /* Equivalent to bg-gray-200 */
        }

        .product-table th {
            padding: 0.5rem 1rem; /* Equivalent to px-4 py-2 */
            color: #374151; /* Equivalent to text-gray-700 */
            text-align: center; /* Equivalent to text-center */
        }

        /* Table body */
        .product-table tbody {
            border-top: 1px solid #e5e7eb; /* Equivalent to divide-y */
        }

        .product-table td {
            padding: 0.75rem 1rem; /* Equivalent to px-4 py-3 */
            color: #374151; /* Equivalent to text-gray-700 */
            text-align: center; /* Equivalent to text-center */
        }

        /* Product image */
        .product-image {
            height: 4rem; /* Equivalent to h-16 */
            width: 4rem; /* Equivalent to w-16 */
            object-fit: cover; /* Equivalent to object-cover */
            border-radius: 0.375rem; /* Equivalent to rounded */
            margin-left: auto;
            margin-right: auto;
        }

        /* No image text */
        .no-image {
            color: #6b7280; /* Equivalent to text-gray-500 */
        }

        /* Action buttons */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem; /* Equivalent to space-x-4 */
        }

        .delete-button {
            color: #dc2626; /* Equivalent to text-red-600 */
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.15s ease-in-out;
        }

        .delete-button:hover {
            color: #b91c1c; /* Equivalent to hover:text-red-800 */
        }

        .add-stock-button {
            color: #3b82f6; /* Equivalent to text-blue-500 */
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.15s ease-in-out;
        }

        .add-stock-button:hover {
            color: #1d4ed8; /* Equivalent to hover:text-blue-700 */
        }

        /* Modal */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0; /* Equivalent to inset-0 */
            background-color: rgba(75, 85, 99, 0.5); /* Equivalent to bg-gray-600 bg-opacity-50 */
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 50; /* Equivalent to z-50 */
        }

        .modal-content {
            background-color: #ffffff; /* Equivalent to bg-white */
            border-radius: 0.375rem; /* Equivalent to rounded-lg */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1); /* Equivalent to shadow-lg */
            max-width: 28rem; /* Equivalent to max-w-md */
            width: 100%; /* Equivalent to w-full */
            padding: 1.5rem; /* Equivalent to p-6 */
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem; /* Equivalent to mb-4 */
        }

        .modal-title {
            font-size: 1.25rem; /* Equivalent to text-xl */
            font-weight: 600; /* Equivalent to font-semibold */
            color: #1f2937; /* Equivalent to text-gray-900 */
        }

        .modal-close {
            color: #6b7280; /* Equivalent to text-gray-500 */
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.15s ease-in-out;
        }

        .modal-close:hover {
            color: #374151; /* Equivalent to hover:text-gray-700 */
        }

        .modal-close svg {
            width: 1.5rem; /* Equivalent to w-6 */
            height: 1.5rem; /* Equivalent to h-6 */
        }

        .modal-form-group {
            margin-bottom: 1rem; /* Equivalent to mb-4 */
        }

        .modal-label {
            display: block;
            font-size: 0.875rem; /* Equivalent to text-sm */
            font-weight: 500; /* Equivalent to font-medium */
            color: #374151; /* Equivalent to text-gray-700 */
        }

        .modal-input {
            margin-top: 0.25rem; /* Equivalent to mt-1 */
            display: block;
            width: 100%; /* Equivalent to w-full */
            padding: 0.5rem; /* Equivalent to implicit padding */
            border: 1px solid #d1d5db; /* Equivalent to border-gray-300 */
            border-radius: 0.375rem; /* Equivalent to rounded-md */
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); /* Equivalent to shadow-sm */
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .modal-input[readonly] {
            background-color: #e5e7eb; /* Equivalent to bg-gray-100 */
        }

        .modal-input:focus {
            border-color: #3b82f6; /* Equivalent to focus:border-blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3); /* Equivalent to focus:ring-blue-500 */
            outline: none;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem; /* Equivalent to space-x-3 */
        }

        .modal-cancel {
            padding: 0.5rem 1rem; /* Equivalent to px-4 py-2 */
            background-color: #e5e7eb; /* Equivalent to bg-gray-200 */
            color: #374151; /* Equivalent to text-gray-700 */
            border: none;
            border-radius: 0.375rem; /* Equivalent to rounded-md */
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
        }

        .modal-cancel:hover {
            background-color: #d1d5db; /* Equivalent to hover:bg-gray-300 */
        }

        .modal-submit {
            padding: 0.5rem 1rem; /* Equivalent to px-4 py-2 */
            background-color: #2563eb; /* Equivalent to bg-blue-600 */
            color: #ffffff; /* Equivalent to text-white */
            border: none;
            border-radius: 0.375rem; /* Equivalent to rounded-md */
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
        }

        .modal-submit:hover {
            background-color: #1d4ed8; /* Equivalent to hover:bg-blue-700 */
        }

        /* Hidden class */
        .hidden {
            display: none; /* Equivalent to hidden */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav x-data="{ open: false }" class="nav">
        <!-- Primary Navigation Menu -->
        <div class="nav-container">
            <div class="nav-flex">
                <div class="flex">
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

                    </div>
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
                <div class="card-content">
                    <h3 class="section-title">Product List</h3>

                    @if($products->isEmpty())
                        <p class="empty-message">No products found.</p>
                    @else
                        <div class="table-container">
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $index => $product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->qty }}</td>
                                            <td>${{ number_format($product->unit_price, 2) }}</td>
                                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                                            <td>
                                                @if($product->product_image)
                                                @php
                                                    $path = $product->product_image;
                                                    $path = str_replace('product/product/', 'product/', $path);
                                                @endphp
                                                    <img src="{{ $path }}" alt="{{ $product->name }}" class="product-image">
                                                @else
                                                    <span class="no-image">No image</span>
                                                @endif
                                            </td>
                                            <td class="action-buttons">
                                                <!-- Delete Button -->
                                                <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-button">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>

                                                <!-- Add Stock Button -->
                                                <button type="button" class="add-stock-button" onclick="openAddStockModal('modal-{{ $product->id }}')">
                                                    Add Stock
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Add Stock Modal for this Product -->
                                        <div id="modal-{{ $product->id }}" class="modal hidden">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Add Stock for {{ $product->name }}</h3>
                                                    <button type="button" onclick="closeAddStockModal('modal-{{ $product->id }}')" class="modal-close">
                                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{ route('product.addStock', $product->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-form-group">
                                                        <label for="current_stock_{{ $product->id }}" class="modal-label">Current Stock</label>
                                                        <input type="number" id="current_stock_{{ $product->id }}" name="current_stock" value="{{ $product->qty }}" class="modal-input" readonly>
                                                    </div>
                                                    <div class="modal-form-group">
                                                        <label for="additional_stock_{{ $product->id }}" class="modal-label">Additional Stock</label>
                                                        <input type="number" id="additional_stock_{{ $product->id }}" name="additional_stock" class="modal-input" min="1" required>
                                                    </div>
                                                    <div class="modal-actions">
                                                        <button type="button" onclick="closeAddStockModal('modal-{{ $product->id }}')" class="modal-cancel">Cancel</button>
                                                        <button type="submit" class="modal-submit">Add Stock</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        function openAddStockModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeAddStockModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            // Reset the form inputs
            const modal = document.getElementById(modalId);
            const form = modal.querySelector('form');
            if (form) {
                form.reset();
            }
        }

        // Close modal when clicking outside
        document.querySelectorAll('[id^="modal-"]').forEach(modal => {
            modal.addEventListener('click', function(event) {
                if (event.target === this) {
                    closeAddStockModal(this.id);
                }
            });
        });
    </script>
</body>
</html>
