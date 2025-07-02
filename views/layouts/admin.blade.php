<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { height: 100vh; background-color: #343a40; color: #fff; }
        .sidebar a { color: #fff; display: block; padding: 10px; text-decoration: none; }
        .sidebar a:hover { background-color: #495057; }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar p-3">
            <h4>لوحة التحكم</h4>
            <a href="{{ route('admin.properties.index') }}">العقارات</a>
            <a href="{{ route('admin.discounts.index') }}">الخصومات</a>
            <a href="{{ route('admin.users.index') }}">المستخدمين</a>
            <a href="{{ route('admin.bookings.index') }}">الحجوزات</a>
            <a href="{{ route('admin.orders.index') }}">الطلبات</a>
        </div>

        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
</body>
</html>
