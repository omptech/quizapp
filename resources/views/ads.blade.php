@include('partials.navbar')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ads Management</h1>
  </div>
  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-lg-12">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body col-lg-10 offset-lg-1">
          @if(Session::has('success'))
          <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
          <br>
          @endif
          <div class="row">
            <div class="col-lg-12 text-right">
              <a class="btn-dark btn" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
            </div>
          </div>
          <br>
          <div class="row no-gutters align-items-center">
            <div class="col-lg-12">
            <form method="POST" action="{{ route('ads.update') }}">
              @csrf
              <div class="form-group">
                <label>Admob Native Ad Id</label>
                <input name="admob_native" type="text" class="form-control" value="{{$ads->admob_native}}">
              </div>
              <div class="form-group">
                <label>Admob Interstitial Ad Id</label>
                <input name="admob_interstitial" type="text" class="form-control" value="{{$ads->admob_interstitial}}">
              </div>
              <div class="form-group">
                <label>Admob Banner Ad Id</label>
                <input name="admob_banner" type="text" class="form-control" value="{{$ads->admob_banner}}">
              </div>
              <div class="form-group">
                <label>Admob Rewarded Video Ad Id</label>
                <input name="admob_video" type="text" class="form-control" value="{{$ads->admob_video}}">
              </div>
              <div class="form-group">
                <label>Facebook Banner Id <span class="text-danger">(write NULL if you don't wanna use Facebook Banner Ads)</span></label>
                <input name="fb_banner" type="text" class="form-control" value="{{$ads->fb_banner}}">
              </div>
               <div class="form-group">
                <label>Facebook Native Banner Id <span class="text-danger">(write NULL if you don't wanna use Facebook Native Ads)</span></label>
                <input name="fb_native" type="text" class="form-control" value="{{$ads->fb_native}}">
              </div>
              <div class="form-group">
                <label>Facebook Interstitial Id <span class="text-danger">(write NULL if you don't wanna use Facebook Native Ads)</span></label>
                <input name="fb_interstitial" type="text" class="form-control" value="{{$ads->fb_interstitial}}">
              </div>
              <hr>
              <div class="form-group">
                <label>Bottom Banner Type</label>
                <select name="bottom_banner_type" class="form-control">
                  <option @if($ads->bottom_banner_type=="admob") selected @endif value="admob">Admob</option>
                  <option @if($ads->bottom_banner_type=="facebook") selected @endif value="facebook">Facebook</option>
                </select>
              </div>
              <button type="submit" class="btn btn-success ">Update</button>
            </form>
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