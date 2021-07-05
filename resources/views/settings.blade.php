@include('partials.navbar')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Settings</h1>
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
              <form method="POST" action="{{ route('settings.update') }}">
                @csrf
                <div class="form-group">
                  <label>Currency</label>
                  <input name="currency" type="text" class="form-control" value="{{$settings->currency}}">
                </div>
                <div class="form-group">
                  <label>Minimum Amount To withdraw in {{$settings->currency}}</label>
                  <input name="min_to_withdraw" type="text" class="form-control" value="{{$settings->min_to_withdraw}}">
                </div>
                <div class="form-group">
                  <label>1 {{$settings->currency}} = ? Points</label>
                  <input name="conversion_rate" type="text" class="form-control" value="{{$settings->conversion_rate}}">
                </div>
                <div class="form-group">
                  <label>Referral Registered Points</label>
                  <input name="referral_register_points" type="text" class="form-control" value="{{$settings->referral_register_points}}">
                </div>
                <div class="form-group">
                  <label>Question Time in Seconds</label>
                  <input name="question_time" type="text" class="form-control" value="{{$settings->question_time}}">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Enable Completed Category Option</label>
                  <select name="completed_option" class="form-control" id="exampleFormControlSelect1">
                    <option @if($settings->completed_option == "yes") selected @endif value="yes">Yes</option>
                    <option @if($settings->completed_option == "no") selected @endif value="no">No</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Enable 50/50 Option</label>
                  <select name="fifty_fifty" class="form-control" id="exampleFormControlSelect1">
                    <option @if($settings->fifty_fifty == "yes") selected @endif value="yes">Yes</option>
                    <option @if($settings->fifty_fifty == "no") selected @endif value="no">No</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Enable Video Reward Option</label>
                  <select name="video_reward" class="form-control" id="exampleFormControlSelect1">
                    <option @if($settings->video_reward == "yes") selected @endif value="yes">Yes</option>
                    <option @if($settings->video_reward == "no") selected @endif value="no">No</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-success ">Update Settings</button>
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