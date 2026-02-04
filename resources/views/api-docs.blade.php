<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitFlow API | Documentation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Fira+Code&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        code, pre { font-family: 'Fira Code', monospace; }
        .method-get { background-color: #059669; }
        .method-post { background-color: #2563eb; }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">

    <header class="bg-slate-900 text-white py-6 shadow-lg">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-orange-500">FitFlow <span class="text-white font-light">API</span></h1>
                <p class="text-slate-400 text-sm mt-1">Fitness Management System Backend v2.0</p>
            </div>
            <div class="hidden md:block">
                <span class="bg-green-500/10 text-green-400 border border-green-500/20 px-3 py-1 rounded-full text-xs font-semibold">
                    ● System Online
                </span>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-6 py-10 grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <aside class="lg:col-span-1">
            <nav class="sticky top-10 space-y-1">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Core Endpoints</p>
                <a href="#auth" class="block px-4 py-2 text-gray-600 hover:bg-orange-500 hover:text-white rounded-md transition">Authentication</a>
                <a href="#users" class="block px-4 py-2 text-gray-600 hover:bg-orange-500 hover:text-white rounded-md transition">User Management</a>
                <a href="#plans" class="block px-4 py-2 text-gray-600 hover:bg-orange-500 hover:text-white rounded-md transition">Membership Plans</a>
                <a href="#subscriptions" class="block px-4 py-2 text-gray-600 hover:bg-orange-500 hover:text-white rounded-md transition">Subscriptions</a>
                <a href="#classes" class="block px-4 py-2 text-gray-600 hover:bg-orange-500 hover:text-white rounded-md transition">Gym Classes</a>
                <a href="#bookings" class="block px-4 py-2 text-gray-600 hover:bg-orange-500 hover:text-white rounded-md transition">Class Bookings</a>
                <a href="#attendance" class="block px-4 py-2 text-gray-600 hover:bg-orange-500 hover:text-white rounded-md transition">Attendance</a>
                <a href="#payments" class="block px-4 py-2 text-gray-600 hover:bg-orange-500 hover:text-white rounded-md transition">Payments</a>
                <a href="#roles" class="block px-4 py-2 text-gray-600 hover:bg-orange-500 hover:text-white rounded-md transition">System Roles</a>
            </nav>
        </aside>

        <main class="lg:col-span-3 space-y-12">

            <section id="auth">
                <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                    <span class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mr-3 text-sm">01</span>
                    Authentication
                </h2>

                <!-- Register -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-post text-white px-3 py-1 rounded text-xs font-bold">POST</span>
                            <code class="text-gray-800 font-bold">/api/v2/register</code>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Register a new member account. Creates user profile and returns access token.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Request Body</h4>
                                <pre class="bg-slate-900 text-blue-300 p-4 rounded-lg text-xs">
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "phone": "555-1234",
  "dob": "1990-01-15",
  "emergency_contact": "Jane Doe - 555-5678"
}</pre>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (201 Created)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
{
  "message": "Registration successful",
  "access_token": "token-string-here",
  "user": {
    "id": 5,
    "name": "John Doe",
    "role": "member"
  }
}</pre>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Login -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-post text-white px-3 py-1 rounded text-xs font-bold">POST</span>
                            <code class="text-gray-800 font-bold">/api/v2/login</code>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Authenticates users via encrypted email lookup. Returns a personal access token (Sanctum).
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Request Body</h4>
                                <pre class="bg-slate-900 text-blue-300 p-4 rounded-lg text-xs">
{
  "email": "john@example.com",
  "password": "password123"
}</pre>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (200 OK)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
{
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "role": "member"
    },
    "token": "1|abc123xyz...",
    "role": "member"
  }
}</pre>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Logout -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-post text-white px-3 py-1 rounded text-xs font-bold">POST</span>
                            <code class="text-gray-800 font-bold">/api/v2/logout</code>
                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">🔒 Auth Required</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Revoke user's access token and log out from all devices.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Headers</h4>
                                <pre class="bg-slate-900 text-blue-300 p-4 rounded-lg text-xs">
Authorization: Bearer {access_token}</pre>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (200 OK)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
{
  "message": "Logged out successfully"
}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="roles">
                <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                    <span class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mr-3 text-sm">02</span>
                    User Management
                </h2>

                <!-- Get User Profile -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-get text-white px-3 py-1 rounded text-xs font-bold">GET</span>
                            <code class="text-gray-800 font-bold">/api/v2/user</code>
                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">🔒 Auth Required</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Get authenticated user's profile with member details and role.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Headers</h4>
                                <pre class="bg-slate-900 text-blue-300 p-4 rounded-lg text-xs">
Authorization: Bearer {access_token}</pre>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (200 OK)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
{
  "data": {
    "id": 5,
    "name": "John Doe",
    "email": "john@example.com",
    "role": "member",
    "profile": {
      "phone": "555-1234",
      "dob": "1990-01-15",
      "emergency_contact": "Jane Doe - 555-5678"
    }
  },
  "role": "member"
}</pre>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Profile -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-post text-white px-3 py-1 rounded text-xs font-bold" style="background-color: #f59e0b;">PUT</span>
                            <code class="text-gray-800 font-bold">/api/v2/user/profile</code>
                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">🔒 Auth Required</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Update user's name, phone, or bio.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Request Body</h4>
                                <pre class="bg-slate-900 text-blue-300 p-4 rounded-lg text-xs">
{
  "name": "John Updated",
  "phone": "555-9999",
  "bio": "Fitness enthusiast"
}</pre>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (200 OK)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
{
  "message": "Profile updated successfully",
  "data": {
    "id": 5,
    "name": "John Updated",
    "profile": {
      "phone": "555-9999",
      "bio": "Fitness enthusiast"
    }
  }
}</pre>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Password -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-post text-white px-3 py-1 rounded text-xs font-bold" style="background-color: #f59e0b;">PUT</span>
                            <code class="text-gray-800 font-bold">/api/v2/user/password</code>
                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">🔒 Auth Required</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Change user's password with old password verification.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Request Body</h4>
                                <pre class="bg-slate-900 text-blue-300 p-4 rounded-lg text-xs">
{
  "old_password": "password123",
  "new_password": "newpassword456",
  "new_password_confirmation": "newpassword456"
}</pre>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (200 OK)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
{
  "message": "Password updated successfully"
}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="plans">
                <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                    <span class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mr-3 text-sm">03</span>
                    Membership Plans
                </h2>

                <!-- Get Plans -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-get text-white px-3 py-1 rounded text-xs font-bold">GET</span>
                            <code class="text-gray-800 font-bold">/api/v2/plans</code>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Get all active membership plans available for subscription.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (200 OK)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
[
  {
    "id": 1,
    "name": "Basic Monthly",
    "price": 29.99,
    "duration_days": 30,
    "can_access_classes": false
  },
  {
    "id": 2,
    "name": "Premium Monthly",
    "price": 49.99,
    "duration_days": 30,
    "can_access_classes": true
  }
]</pre>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create Plan (Admin) -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-post text-white px-3 py-1 rounded text-xs font-bold">POST</span>
                            <code class="text-gray-800 font-bold">/api/v2/plans</code>
                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">🔒 Auth Required</span>
                            <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">Admin Only</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Create a new membership plan (Admin only).
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Request Body</h4>
                                <pre class="bg-slate-900 text-blue-300 p-4 rounded-lg text-xs">
{
  "name": "Annual VIP",
  "price": 499.99,
  "duration_days": 365,
  "can_access_classes": true
}</pre>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (201 Created)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
{
  "message": "Plan created successfully",
  "plan": {
    "id": 3,
    "name": "Annual VIP",
    "price": 499.99,
    "duration_days": 365,
    "can_access_classes": true
  }
}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="subscriptions">
                <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                    <span class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mr-3 text-sm">04</span>
                    Subscriptions
                </h2>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-post text-white px-3 py-1 rounded text-xs font-bold">POST</span>
                            <code class="text-gray-800 font-bold">/api/v2/subscribe</code>
                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">🔒 Auth Required</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Subscribe to a membership plan. Creates active subscription for the authenticated user.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Request Body</h4>
                                <pre class="bg-slate-900 text-blue-300 p-4 rounded-lg text-xs">
{
  "plan_id": 2
}</pre>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (201 Created)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
{
  "message": "Subscription created successfully",
  "subscription": {
    "id": 10,
    "user_id": 5,
    "plan_id": 2,
    "start_date": "2026-02-03",
    "end_date": "2026-03-05",
    "status": "active"
  }
}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="classes">
                <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                    <span class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mr-3 text-sm">05</span>
                    Gym Classes
                </h2>

                <!-- Get Classes -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-get text-white px-3 py-1 rounded text-xs font-bold">GET</span>
                            <code class="text-gray-800 font-bold">/api/v2/classes</code>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Get all upcoming gym classes with trainer info and availability.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (200 OK)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
[
  {
    "id": 1,
    "name": "Morning Yoga",
    "trainer": "Coach Sarah",
    "start_time": "2026-02-04 07:00:00",
    "end_time": "2026-02-04 08:00:00",
    "capacity": 20,
    "booked": 15
  }
]</pre>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create Class (Trainer) -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-post text-white px-3 py-1 rounded text-xs font-bold">POST</span>
                            <code class="text-gray-800 font-bold">/api/v2/classes</code>
                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">🔒 Auth Required</span>
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Trainer/Admin</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Create a new gym class (Trainer or Admin only).
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Request Body</h4>
                                <pre class="bg-slate-900 text-blue-300 p-4 rounded-lg text-xs">
{
  "name": "HIIT Training",
  "trainer_id": 2,
  "start_time": "2026-02-05 18:00:00",
  "end_time": "2026-02-05 19:00:00",
  "capacity": 15
}</pre>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (201 Created)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
{
  "message": "Class created successfully",
  "class": {
    "id": 5,
    "name": "HIIT Training",
    "trainer_id": 2,
    "start_time": "2026-02-05 18:00:00",
    "end_time": "2026-02-05 19:00:00",
    "capacity": 15
  }
}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="bookings">
                <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                    <span class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mr-3 text-sm">06</span>
                    Class Bookings
                </h2>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-post text-white px-3 py-1 rounded text-xs font-bold">POST</span>
                            <code class="text-gray-800 font-bold">/api/v2/bookings</code>
                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">🔒 Auth Required</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Book a spot in a gym class. Requires active subscription with class access.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Request Body</h4>
                                <pre class="bg-slate-900 text-blue-300 p-4 rounded-lg text-xs">
{
  "gym_class_id": 1
}</pre>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (201 Created)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
{
  "message": "Booking successful",
  "booking": {
    "id": 25,
    "user_id": 5,
    "gym_class_id": 1,
    "status": "confirmed",
    "booked_at": "2026-02-03 12:30:00"
  }
}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="attendance">
                <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                    <span class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mr-3 text-sm">07</span>
                    Attendance Tracking
                </h2>

                <!-- Check In -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-post text-white px-3 py-1 rounded text-xs font-bold">POST</span>
                            <code class="text-gray-800 font-bold">/api/v2/attendance/check-in</code>
                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">🔒 Auth Required</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Check in to the gym. Supports QR code, biometric, or manual entry.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Request Body</h4>
                                <pre class="bg-slate-900 text-blue-300 p-4 rounded-lg text-xs">
{
  "method": "qr"
}</pre>
                                <p class="text-xs text-gray-500 mt-2">Method options: "qr", "biometric", "manual"</p>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (201 Created)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
{
  "message": "Check-in successful",
  "attendance": {
    "id": 100,
    "user_id": 5,
    "check_in": "2026-02-03 14:30:00",
    "method": "qr"
  }
}</pre>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Check Out -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-post text-white px-3 py-1 rounded text-xs font-bold">POST</span>
                            <code class="text-gray-800 font-bold">/api/v2/attendance/check-out</code>
                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">🔒 Auth Required</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Check out from the gym. Updates the latest attendance record.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (200 OK)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
{
  "message": "Check-out successful",
  "attendance": {
    "id": 100,
    "user_id": 5,
    "check_in": "2026-02-03 14:30:00",
    "check_out": "2026-02-03 16:15:00"
  }
}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="payments">
                <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                    <span class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mr-3 text-sm">08</span>
                    Payments
                </h2>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="method-post text-white px-3 py-1 rounded text-xs font-bold">POST</span>
                            <code class="text-gray-800 font-bold">/api/v2/payments</code>
                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">🔒 Auth Required</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Record a payment for a subscription. Supports multiple payment methods.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Request Body</h4>
                                <pre class="bg-slate-900 text-blue-300 p-4 rounded-lg text-xs">
{
  "subscription_id": 10,
  "amount": 49.99,
  "payment_method": "credit_card",
  "transaction_id": "TXN-2026-02-03-12345"
}</pre>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Success Response (201 Created)</h4>
                                <pre class="bg-slate-900 text-green-400 p-4 rounded-lg text-xs">
{
  "message": "Payment recorded successfully",
  "payment": {
    "id": 50,
    "subscription_id": 10,
    "amount": 49.99,
    "payment_method": "credit_card",
    "transaction_id": "TXN-2026-02-03-12345",
    "status": "completed",
    "paid_at": "2026-02-03 12:45:00"
  }
}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="roles">
                <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                    <span class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center mr-3 text-sm">09</span>
                    FitFlow Roles
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-5 rounded-lg border-t-4 border-red-500 shadow-sm">
                        <h4 class="font-bold text-gray-800">Admin</h4>
                        <p class="text-xs text-gray-500 mt-2">Manages gym staff, view all reports, and system config.</p>
                    </div>
                    <div class="bg-white p-5 rounded-lg border-t-4 border-blue-500 shadow-sm">
                        <h4 class="font-bold text-gray-800">Trainer</h4>
                        <p class="text-xs text-gray-500 mt-2">Creates workout plans and logs member progress.</p>
                    </div>
                    <div class="bg-white p-5 rounded-lg border-t-4 border-green-500 shadow-sm">
                        <h4 class="font-bold text-gray-800">Member</h4>
                        <p class="text-xs text-gray-500 mt-2">Accesses assigned workouts and personal stats.</p>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <footer class="bg-white border-t border-gray-200 py-8 mt-20">
        <div class="container mx-auto px-6 text-center text-gray-400 text-sm">
            &copy; {{ now()->year }} FitFlow Development Team. All rights reserved.
        </div>
    </footer>

</body>
</html>