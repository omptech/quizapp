@include('partials.navbar')
<!-- Begin Page Content -->
<div class="container">
  <!-- Page Heading -->
  <div style="margin-bottom: 60px !important;" class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>
  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Players ({{$players->count()}})</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <a href="{{ route('players') }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-3x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Categories ({{$categories->count()}})</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <a href="{{ route('categories') }}" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Edit</a>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-bars fa-3x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Questions ({{$questions->count()}})</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <a href="{{ route('questions') }}" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Edit</a>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-question fa-3x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Withdrawals ({{$withdrawals->count()}})</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <a href="{{ route('withdrawals') }}" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Edit</a>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-money-bill-wave fa-3x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Payment Methods ({{$methods->count()}})</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <a href="{{ route('payment.methods') }}" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Edit</a>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fab fa-cc-visa fa-3x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Admins ({{$admins->count()}})</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <a href="{{ route('admins') }}" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Edit</a>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-lock fa-3x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Settings</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <a href="{{ route('settings') }}" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Edit</a>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-cog fa-3x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Ads</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <a href="{{ route('ads') }}" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Edit</a>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fab fa-buysellads fa-3x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <!-- Content Row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@include('partials.footer')