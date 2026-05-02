<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard</title>

  <!-- Favicons -->
  <link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS -->
  <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Main CSS -->
  <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

  <style>
    * { font-family: "Nunito", sans-serif !important; }
    body { background: #f6f9ff; }

    /* Header styling */
    .header {
      background: #fff !important;
      box-shadow: 0 2px 4px rgba(0,0,0,0.08) !important;
      height: 70px !important;
      padding: 0 20px !important;
      left: 0 !important;
      width: 100% !important;
      z-index: 998 !important;
    }
    
    /* Header logo */
    .header .logo {
      min-width: auto;
      padding: 0;
      margin-left: 15px;
      max-width: 400px;
    }
    .header .logo img {
      max-height: 50px;
      width: 50px;
      border-radius: 50%;
      margin-right: 15px;
      flex-shrink: 0;
    }
    .header .logo span {
      font-size: 15px;
      font-weight: 700;
      font-family: "Poppins", sans-serif !important;
      line-height: 1.3;
      color: #1a1a1a;
      white-space: nowrap;
      display: inline-block;
    }
    .toggle-sidebar-btn {
      color: #1a1a1a !important;
      font-size: 24px !important;
      margin-right: 0 !important;
      cursor: pointer !important;
      padding: 10px 15px !important;
      margin-left: 0 !important;
    }

    /* Sidebar Width - Make it wider */
    .sidebar {
      width: 280px !important;
      transition: all 0.3s ease;
      top: 70px !important;
      background: #fff !important;
      border-right: 1px solid #e5e7eb !important;
      left: 0 !important;
      z-index: 997 !important;
    }
    
    /* Sidebar collapsed state - only show icons */
    .toggle-sidebar .sidebar {
      width: 80px !important;
      left: 0 !important;
    }
    
    .toggle-sidebar .sidebar .nav-link span,
    .toggle-sidebar .sidebar .logo span,
    .toggle-sidebar .sidebar .nav-heading {
      display: none !important;
    }
    
    .toggle-sidebar .sidebar .nav-link {
      justify-content: center !important;
      padding: 12px 0 !important;
    }
    
    .toggle-sidebar .sidebar .nav-link i {
      margin-right: 0 !important;
      font-size: 20px !important;
    }
    
    .toggle-sidebar .sidebar .logo {
      justify-content: center !important;
    }
    
    .toggle-sidebar .sidebar .logo img {
      margin-right: 0 !important;
    }

    /* Adjust main content when sidebar is toggled */
    #main {
      margin-left: 280px !important;
      margin-top: 70px !important;
      transition: all 0.3s ease;
      padding: 25px 35px !important;
      background: #f6f9ff !important;
      min-height: calc(100vh - 70px) !important;
    }
    
    .toggle-sidebar #main {
      margin-left: 80px !important;
    }

    /* Remove extra spacing in sections */
    .section {
      padding: 0 !important;
    }
    
    .section .row {
      margin: 0 !important;
    }

    /* Sidebar nav active state */
    .sidebar-nav .nav-link:not(.collapsed) {
      background: #e8ecff;
      color: #4154f1;
      border-radius: 6px;
    }
    .sidebar-nav .nav-link:not(.collapsed) i {
      color: #4154f1;
    }
    
    /* Sidebar nav items spacing */
    .sidebar-nav .nav-item {
      margin-bottom: 4px;
    }
    
    .sidebar-nav .nav-link {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      font-size: 15px;
      font-weight: 600;
      font-family: "Poppins", sans-serif !important;
      color: #4b5563;
      transition: all 0.3s;
    }
    
    .sidebar-nav .nav-link i {
      font-size: 18px;
      margin-right: 12px;
      color: #6b7280;
      transition: all 0.3s;
    }
    
    .sidebar-nav .nav-link:hover {
      background: #f3f4f6;
      color: #4154f1;
    }
    
    .sidebar-nav .nav-link:hover i {
      color: #4154f1;
    }
    
    /* Hide dropdown arrow when sidebar is collapsed */
    .toggle-sidebar .sidebar .nav-link .bi-chevron-down {
      display: none !important;
    }
    
    /* Hide nav-content (dropdown items) when sidebar is collapsed */
    .toggle-sidebar .sidebar .nav-content {
      display: none !important;
    }
    
    /* Nav heading styling */
    .sidebar-nav .nav-heading {
      font-size: 11px;
      text-transform: uppercase;
      color: #899bbd;
      font-weight: 600;
      margin: 20px 0 10px 20px;
    }

    /* TTD Page Styling */
    .page-heading {
        font-size: 24px !important;
        font-weight: 600 !important;
        font-family: "Poppins", sans-serif !important;
        color: #2d3748 !important;
        margin-bottom: 20px !important;
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    .form-card {
        background: #fff !important;
        border-radius: 8px !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
        padding: 32px !important;
        margin-bottom: 40px !important;
        border: 1px solid #e2e8f0 !important;
        overflow: hidden !important;
    }
    
    .form-card form {
        overflow: hidden !important;
    }

    .form-card .form-label {
        font-size: 14px !important;
        font-weight: 600 !important;
        font-family: "Poppins", sans-serif !important;
        color: #4a5568 !important;
        margin-bottom: 8px !important;
        display: block !important;
    }

    .form-card .form-control,
    .form-card .form-select {
        border: 1px solid #cbd5e0 !important;
        border-radius: 6px !important;
        font-size: 14px !important;
        font-family: "Poppins", sans-serif !important;
        height: 42px !important;
        padding: 8px 14px !important;
        color: #2d3748 !important;
        background: #fff !important;
        width: 100% !important;
        transition: all 0.2s !important;
    }
    
    .form-card .form-control::placeholder {
        color: #a0aec0 !important;
        font-family: "Poppins", sans-serif !important;
    }

    .form-card .form-control:focus,
    .form-card .form-select:focus {
        border-color: #0369a1 !important;
        box-shadow: 0 0 0 3px rgba(3,105,161,.1) !important;
        outline: none !important;
    }

    .form-card .form-group {
        margin-bottom: 20px !important;
    }

    .btn-kirim {
        background-color: #0369a1 !important;
        border: none !important;
        color: #fff !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        font-family: "Poppins", sans-serif !important;
        padding: 10px 32px !important;
        border-radius: 6px !important;
        cursor: pointer !important;
        float: right !important;
        margin-top: 0 !important;
        transition: all 0.2s !important;
    }
    .btn-kirim:hover { 
        background-color: #0284c7 !important;
        color: #fff !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 8px rgba(3,105,161,0.2) !important;
    }
    
    /* Clearfix for button container */
    .text-end::after {
        content: "" !important;
        display: table !important;
        clear: both !important;
    }

    .table-card {
        background: #fff !important;
        border-radius: 8px !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
        overflow: hidden !important;
        border: 1px solid #e2e8f0 !important;
    }

    .table-ttd {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 14px !important;
        font-family: "Poppins", sans-serif !important;
    }

    .table-ttd thead tr {
        background: #f7fafc !important;
        border-bottom: 2px solid #e2e8f0 !important;
    }

    .table-ttd thead th {
        font-weight: 600 !important;
        font-family: "Poppins", sans-serif !important;
        color: #4a5568 !important;
        padding: 16px 20px !important;
        text-align: left !important;
    }

    .table-ttd tbody tr {
        border-bottom: 1px solid #e2e8f0 !important;
        transition: background 0.2s !important;
    }
    
    .table-ttd tbody tr:hover {
        background: #f7fafc !important;
    }

    .table-ttd tbody td {
        padding: 16px 20px !important;
        color: #4a5568 !important;
        font-family: "Poppins", sans-serif !important;
        vertical-align: middle !important;
    }

    .btn-act {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 36px !important;
        height: 36px !important;
        border-radius: 6px !important;
        border: none !important;
        cursor: pointer !important;
        font-size: 14px !important;
        margin-right: 6px !important;
        transition: all 0.2s !important;
    }

    .btn-act-edit  { 
        background: #22c55e !important; 
        color: #fff !important; 
    }
    .btn-act-edit:hover { 
        background: #16a34a !important; 
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 8px rgba(34,197,94,0.3) !important;
    }
    
    .btn-act-delete { 
        background: #ef4444 !important; 
        color: #fff !important; 
    }
    .btn-act-delete:hover { 
        background: #dc2626 !important; 
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 8px rgba(239,68,68,0.3) !important;
    }
  </style>
</head>

<body>

  <!-- Header -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center w-100">
      <i class="bi bi-list toggle-sidebar-btn"></i>
      <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center" style="text-decoration:none;">
        <img src="{{ asset('backend/assets/img/pkk.png') }}" alt="PKK">
        <span class="d-none d-lg-block">
          Pemberdayaan Kesejahteraan Keluarga<br>Kabupaten Nganjuk
        </span>
      </a>
    </div>
    <nav class="header-nav ms-auto"></nav>
  </header>

  @include('backend.includes.sidebar')

  @yield('content')
  @yield('content1')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS -->
  <script src="{{ asset('backend/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('backend/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('backend/assets/js/main.js') }}"></script>

</body>
</html>
