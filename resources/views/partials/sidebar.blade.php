<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-cog"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin Panel</div>
  </a>
  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  <!-- Nav Item - Dashboard -->
  <li class="nav-item @if (\Request::is('/')) active @endif">
    <a class="nav-link" href="{{ route('home') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Players -->
  <li class="nav-item @if (\Request::is('players')) active @endif">
    <a class="nav-link" href="{{ route('players') }}">
      <i class="fas fa-fw fa-users"></i>
      <span>Players</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Categories -->
  <li class="nav-item @if (\Request::is('categories')) active @endif">
    <a class="nav-link" href="{{ route('categories') }}">
      <i class="fas fa-fw fa-bars"></i>
      <span>Categories</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Questions -->
  <li class="nav-item @if (\Request::is('questions') || \Request::is('questions/*')) active @endif">
    <a class="nav-link" href="{{ route('questions') }}">
      <i class="fas fa-fw fa-question"></i>
      <span>Questions</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Withdrawals -->
  <li class="nav-item @if (\Request::is('withdrawals') || \Request::is('withdrawals/*')) active @endif">
    <a class="nav-link" href="{{ route('withdrawals') }}">
      <i class="fas fa-money-bill-wave"></i>
      <span>Withdrawals</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item @if (\Request::is('payment/methods') || \Request::is('payment/methods/*')) active @endif">
    <a class="nav-link" href="{{ route('payment.methods') }}">
      <i class="fab fa-cc-visa"></i>
      <span>Payment Methods</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item @if (\Request::is('admins') || \Request::is('admins/*')) active @endif">
    <a class="nav-link" href="{{ route('admins') }}">
      <i class="fas fa-user-lock"></i>
      <span>Admins</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item @if (\Request::is('settings') || \Request::is('settings/*')) active @endif">
    <a class="nav-link" href="{{ route('settings') }}">
      <i class="fas fa-cog"></i>
      <span>Settings</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item @if (\Request::is('ads') || \Request::is('ads/*')) active @endif">
    <a class="nav-link" href="{{ route('ads') }}">
      <i class="fab fa-buysellads"></i>
      <span>Ads</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
  </ul>
  <!-- End of Sidebar -->