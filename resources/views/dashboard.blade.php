<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Commerce Website</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            color: #1f2937;
            margin: 0;
        }

        /* Navigation styles */
        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        .navbar-container {
            max-width: 80rem;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        @media (min-width: 640px) {
            .navbar-container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .navbar-container {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            height: 4rem;
        }

        .navbar-logo {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-container {
            width: 3rem;
            height: 3rem;
            border-radius: 9999px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .nav-links {
            display: none;
            margin-left: 2.5rem;
            margin-top: -0.5rem;
            margin-bottom: -0.5rem;
            gap: 2rem;
        }

        @media (min-width: 640px) {
            .nav-links {
                display: flex;
            }
        }

        .nav-link {
            display: inline-flex;
            align-items: center;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            color: #374151;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            border-bottom: 2px solid transparent;
        }

        .nav-link:hover {
            color: #111827;
        }

        .nav-link.active {
            color: #2563eb;
            border-bottom-color: #2563eb;
        }

        .dropdown-container {
            display: none;
            align-items: center;
            margin-left: 1.5rem;
        }

        @media (min-width: 640px) {
            .dropdown-container {
                display: flex;
            }
        }

        .dropdown-button {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 0.75rem;
            border: 1px solid transparent;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            color: #6b7280;
            background-color: #ffffff;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: color 0.15s ease-in-out;
        }

        .dropdown-button:hover {
            color: #4b5563;
        }

        .dropdown-button:focus {
            outline: none;
        }

        .dropdown-icon {
            width: 1rem;
            height: 1rem;
            margin-left: 0.25rem;
            fill: currentColor;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            margin-top: 0.5rem;
            width: 12rem;
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .dropdown-item {
            display: block;
            padding: 0.5rem 1rem;
            color: #374151;
            font-size: 0.875rem;
            text-decoration: none;
        }

        .dropdown-item:hover {
            background-color: #f3f4f6;
            color: #111827;
        }

        .hamburger {
            margin-right: -0.5rem;
            display: flex;
            align-items: center;
        }

        @media (min-width: 640px) {
            .hamburger {
                display: none;
            }
        }

        .hamburger-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            border-radius: 0.375rem;
            color: #9ca3af;
            background-color: transparent;
            transition: all 0.15s ease-in-out;
        }

        .hamburger-button:hover {
            color: #6b7280;
            background-color: #f3f4f6;
        }

        .hamburger-button:focus {
            outline: none;
            background-color: #f3f4f6;
            color: #6b7280;
        }

        .hamburger-icon {
            width: 1.5rem;
            height: 1.5rem;
        }

        .mobile-menu {
            display: none;
        }

        .mobile-menu.open {
            display: block;
        }

        .mobile-nav-links {
            padding-top: 0.5rem;
            padding-bottom: 0.75rem;
            gap: 0.25rem;
        }

        .mobile-nav-link {
            display: block;
            padding: 0.5rem 1rem;
            color: #374151;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
        }

        .mobile-nav-link:hover {
            background-color: #f3f4f6;
            color: #111827;
        }

        .mobile-nav-link.active {
            color: #2563eb;
            background-color: #eff6ff;
        }

        .mobile-user-info {
            padding-top: 1rem;
            padding-bottom: 0.25rem;
            border-top: 1px solid #e5e7eb;
        }

        .mobile-user-details {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .mobile-user-name {
            font-size: 1rem;
            font-weight: 500;
            color: #1f2937;
        }

        .mobile-user-email {
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
        }

        .mobile-settings {
            margin-top: 0.75rem;
            gap: 0.25rem;
        }

        /* Main content styles (from previous code) */
        .main-container {
            padding-top: 3rem;
            padding-bottom: 3rem;
            position: relative;
        }

        .content-container {
            max-width: 80rem;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        @media (min-width: 1024px) {
            .content-container {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }

        .card {
            background-color: #ffffff;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
        }

        .card-content {
            padding: 1.5rem;
            color: #1f2937;
        }

        .cart-button {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 50;
            color: #1f2937;
            cursor: pointer;
        }

        .cart-button:hover {
            color: #111827;
        }

        .cart-button:focus {
            outline: none;
        }

        .cart-icon {
            width: 2rem;
            height: 2rem;
        }

        .cart-count {
            position: absolute;
            top: -0.5rem;
            right: -0.5rem;
            background-color: #ef4444;
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 9999px;
            width: 1.25rem;
            height: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            display: none;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .success-message {
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: #d1fae5;
            color: #047857;
            border-radius: 0.375rem;
        }

        .error-message {
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: #fee2e2;
            color: #b91c1c;
            border-radius: 0.375rem;
        }

        .cart-sidebar {
            position: fixed;
            top: 0;
            right: 0;
            height: 100%;
            width: 20rem;
            background-color: #ffffff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            transform: translateX(100%);
            transition: transform 0.3s ease;
            z-index: 50;
        }

        .cart-sidebar-content {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .cart-title {
            font-size: 1.125rem;
            font-weight: 600;
        }

        .close-cart-button {
            color: #4b5563;
            cursor: pointer;
        }

        .close-cart-button:hover {
            color: #1f2937;
        }

        .close-cart-icon {
            width: 1.5rem;
            height: 1.5rem;
        }

        .cart-items {
            flex: 1;
            overflow-y: auto;
        }

        .cart-empty {
            color: #6b7280;
        }

        .cart-total {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
            display: none;
        }

        .total-amount {
            font-size: 1.125rem;
            font-weight: 600;
        }

        .pay-button {
            margin-top: 1rem;
            background-color: #16a34a;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            width: 100%;
            cursor: pointer;
        }

        .pay-button:hover {
            background-color: #15803d;
        }

        .checkout-dialog {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(31, 41, 55, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 50;
            display: none;
        }

        .checkout-content {
            background-color: #ffffff;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 28rem;
        }

        .checkout-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
        }

        .form-input {
            margin-top: 0.25rem;
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            padding: 0.5rem;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
            outline: none;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        .cancel-button {
            padding: 0.5rem 1rem;
            background-color: #d1d5db;
            color: #1f2937;
            border-radius: 0.375rem;
            cursor: pointer;
        }

        .cancel-button:hover {
            background-color: #9ca3af;
        }

        .submit-button {
            padding: 0.5rem 1rem;
            background-color: #2563eb;
            color: #ffffff;
            border-radius: 0.375rem;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #1d4ed8;
        }

        .category-section {
            margin-bottom: 2rem;
        }

        .category-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .product-card {
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            height: 24rem;
        }

        .product-image-container {
            width: 12rem;
            height: 12rem;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            margin-bottom: 0.5rem;
            border-radius: 0.375rem;
        }

        .no-image {
            width: 100%;
            height: 12rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
            margin-bottom: 0.5rem;
            border-radius: 0.375rem;
            color: #6b7280;
        }

        .product-details {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-name {
            font-size: 1rem;
            font-weight: 500;
        }

        .product-price {
            color: #4b5563;
        }

        .product-stock {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .add-to-cart-button {
            background-color: #2563eb;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            width: 100%;
            cursor: pointer;
            margin-top: auto;
        }

        .add-to-cart-button:hover {
            background-color: #1d4ed8;
        }

        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .cart-item-image {
            width: 3rem;
            height: 3rem;
            object-fit: fill;
            border-radius: 0.375rem;
            margin-right: 1rem;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-name {
            font-size: 0.875rem;
            font-weight: 500;
        }

        .cart-item-price {
            font-size: 0.875rem;
            color: #4b5563;
        }

        .remove-from-cart-button {
            color: #4b5563;
            cursor: pointer;
        }

        .remove-from-cart-button:hover {
            color: #1f2937;
        }

        .remove-icon {
            width: 1.25rem;
            height: 1.25rem;
        }






        .hidden { display: none; }
.cart-popup {
    position: fixed;
    right: 20px;
    top: 80px;
    width: 300px;
    background: white;
    border: 1px solid #ccc;
    padding: 10px;
    z-index: 1000;
}
.cart-items {
    max-height: 300px;
    overflow-y: auto;
}
.cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}
.cart-item img {
    width: 40px;
    height: 40px;
    object-fit: cover;
}
.cart-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
}
.buy-button {
    padding: 6px 12px;
    background: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}
.modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
}
.modal-content {
    background: white;
    padding: 20px;
    width: 300px;
}

.cart-button {
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
        }
        .cart-icon {
            width: 24px;
            height: 24px;
        }
        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }

        /* Modal */
        .modal-checkbox {
            display: none;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal-checkbox:checked ~ .modal {
            display: flex;
        }
        .modal-content {
            background: white;
            width: 80%;
            max-width: 700px;
            border-radius: 8px;
            overflow: hidden;
        }
        .modal-header {
            padding: 15px;
            background: #f2f2f2;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-header h5 {
            margin: 0;
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            text-decoration: none;
            color: black;
        }
        .modal-body {
            padding: 20px;
        }
        .modal-footer {
            padding: 15px;
            border-top: 1px solid #ddd;
            text-align: right;
        }
        .modal-footer a {
            padding: 8px 15px;
            margin-left: 10px;
            text-decoration: none;
            color: white;
            background: #007bff;
            border-radius: 4px;
        }

        /* Cart Table */
        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }
        .cart-table th, .cart-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .cart-table th {
            background: #f2f2f2;
        }
        .cart-table img {
            max-width: 50px;
        }
        .cart-empty {
            padding: 20px;
            text-align: center;
        }

        /* Products */
        .products {
            margin-top: 20px;
        }
        .category {
            margin-bottom: 20px;
        }
        .product {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
        }

        .cart-button {
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
        }
        .cart-icon {
            width: 24px;
            height: 24px;
        }
        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }

        /* Modal */
        .modal-checkbox {
            display: none;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal-checkbox:checked ~ .modal {
            display: flex;
        }
        .modal-content {
            background: white;
            width: 80%;
            max-width: 700px;
            border-radius: 8px;
            overflow: hidden;
        }
        .modal-header {
            padding: 15px;
            background: #f2f2f2;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-header h5 {
            margin: 0;
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            text-decoration: none;
            color: black;
        }
        .modal-body {
            padding: 20px;
        }
        .modal-footer {
            padding: 15px;
            border-top: 1px solid #ddd;
            text-align: right;
        }
        .modal-footer a {
            padding: 8px 15px;
            margin-left: 10px;
            text-decoration: none;
            color: white;
            background: #007bff;
            border-radius: 4px;
        }

        /* Cart Table */
        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }
        .cart-table th, .cart-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .cart-table th {
            background: #f2f2f2;
        }
        .cart-table img {
            max-width: 50px;
        }
        .cart-empty {
            padding: 20px;
            text-align: center;
        }

        /* Products */
        .products {
            margin-top: 20px;
        }
        .category {
            margin-bottom: 20px;
        }
        .product {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
        }

        #loginBox {
      display: none; /* Hidden initially */
      position: absolute;
      z-index: 1000;
      top: 30%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 300px;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
      text-align: center;
    }

    #loginBox input {
      width: 90%;
      padding: 8px;
      margin: 8px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    #loginBox button {
      padding: 8px 16px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
    }

    #loginBox img {
      width: 60px;
      margin-bottom: 15px;
    }

    </style>
</head>

<body>
    {{-- @dd($cart) --}}
    <!-- Navigation -->
    <nav x-data="{ open: false }" class="navbar">
        <div class="navbar-container">
            <div class="navbar-content">
                <div class="navbar-logo">
                    <a href="{{ route('dashboard.index') }}">
                        <div class="logo-container">
                            <img src="{{ asset('IMG/logo.jpeg') }}" alt="Kru Rith" class="logo-image">
                        </div>
                    </a>
                </div>

                <div class="nav-links">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        {{ __('Dashboard') }}
                    </a>
                   
                    <button onclick="showLogin()">Admin</button>
                </div>


                <div id="loginBox">
  <img src="https://via.placeholder.com/60" alt="Logo" />
  <h3>Login</h3>
  <form action="{{ route('adminusers') }}" method="POST">
    @csrf
    <input type="text" id="username" placeholder="Username" name="name"><br>
    <input type="password" id="password" placeholder="Password" name="password"><br>
    <button type="submit">Login</button>
  </form>
</div>


<script>
  function showLogin() {
    document.getElementById('loginBox').style.display = 'block';
  }
</script>

                <div class="dropdown-container">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="dropdown-button">
                            <span>User</span>
                            <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Cart Button in Top Right -->
                <div class="cart-nav-container">
                    <label for="cart-toggle" class="cart-nav-button">
                        <svg class="cart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <span id="cart-count" class="cart-count">{{ collect(session('cart', []))->sum('quantity') }}</span>
                    </label>
                </div>

                <div class="hamburger">
                    <button @click="open = !open" class="hamburger-button">
                        <svg x-show="!open" class="hamburger-icon" stroke="currentColor" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="open" class="hamburger-icon" stroke="currentColor" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" class="mobile-menu">
            <div class="mobile-nav-links">
                <a href="{{ route('dashboard.index') }}"
                    class="mobile-nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('index') }}" class="mobile-nav-link">
                    Admin
                </a>
            </div>
            <div class="mobile-user-info">
                <div class="mobile-user-details">
                    <div class="mobile-user-name">User</div>
                    <div class="mobile-user-email">Gmail</div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <div class="content-container">
            <div class="card">
                <div class="card-content">
                    <h3 class="section-title">Shop by Category</h3>

                    @if (session('success'))
                        <div class="success-message">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="error-message">
                            {{ session('error') }}
                        </div>
                    @endif

                    <input type="checkbox" id="cart-toggle" class="modal-checkbox hidden">
                    <div class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Your Shopping Cart</h5>
                                <label for="cart-toggle" class="modal-close">×</label>
                            </div>
                            <div class="modal-body">
                                @if (empty($cart))
                                    <p class="cart-empty">Your cart is empty.</p>
                                @else
                                    <table class="cart-table">

                                        <tbody>
                                            <div class="modal-body">
                                                @if (empty($cart))
                                                    <p class="cart-empty">Your cart is empty.</p>
                                                @else
                                                    <table class="cart-table">
                                                        <thead>

                                                                <th>Image</th>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($cart as $item)
                                                                @if (isset($item['quantity']))
                                                                    <tr>
                                                                        <td>
                                                                            @if (isset($item['image']) && $item['image'])
                                                                                <img src="{{ str_replace('product/product/', 'product/', $item['image']) }}" alt="{{ $item['name'] ?? 'Product' }}">
                                                                            @else
                                                                                No Image
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $item['name'] ?? 'Unknown' }}</td>
                                                                        <td>
                                                                            @php
                                                                                $price = isset($item['unit_price']) ? $item['unit_price'] : (isset($item['price']) ? $item['price'] : 0);
                                                                            @endphp
                                                                            ${{ number_format($price, 2) }}
                                                                        </td>
                                                                        <td>{{ $item['quantity'] }}</td>
                                                                        <td>${{ number_format($price * $item['quantity'], 2) }}</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <h4>Total: ${{ number_format($total, 2) }}</h4>
                                                @endif
                                            </div>
                                        </tbody>
                                    </table>
                                    <h4>Total: ${{ number_format($total, 2) }}</h4>
                                    <form action="{{ route('cart.checkout') }}" method="POST" class="checkout-form">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" required>
                                            @error('name')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="number" name="phone" id="phone" class="form-control" required>
                                            @error('phone')
                                                <span class="error-message">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="buy-button">Buy</button>
                                    </form>

                                    <form action="{{ route('cart.clear') }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="clear-cart-button">Clear Cart</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($products->isEmpty())
                        <p>No products in stock.</p>
                    @else
                        @foreach ($products as $categoryId => $productGroup)
                            @if (isset($categories[$categoryId]))
                                <div class="category-section">
                                    <h4 class="category-title">{{ $categories[$categoryId]->name }}</h4>
                                    <div class="product-grid">
                                        @foreach ($productGroup as $product)
                                            <div class="product-card">
                                                @if ($product->product_image)
                                                    @php
                                                        $path = $product->product_image;
                                                        $path = str_replace('product/product/', 'product/', $path);
                                                    @endphp
                                                    <div class="product-image-container">
                                                        <img src="{{ $path }}" alt="{{ $product->name }}"
                                                            class="product-image">
                                                    </div>
                                                @else
                                                    <div class="no-image">
                                                        <span>No image</span>
                                                    </div>
                                                @endif
                                                <div class="product-details">
                                                    <p class="product-name">{{ $product->name }}</p>
                                                    <p class="product-price">
                                                        ${{ number_format($product->unit_price, 2) }}</p>
                                                    <p class="product-stock">In stock: {{ $product->qty }}</p>
                                                    <form class="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
                                                        @csrf
                                                        @method("POST")
                                                        <input type="hidden" name="productid" value="{{$product->id}}">
                                                        <button type="submit" class="add-to-cart-button">Add to Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
