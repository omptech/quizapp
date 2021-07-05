@include('partials.navbar')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Players</h1>
  </div>
  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-lg-12">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body col-lg-12">
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
          @if(Session::has('error'))
          <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-12">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
          <br>
          @endif
          <div class="row">
            <div class="col-lg-6">
              <a class="btn-success btn btn-block" href="#" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add New Player</a>
            </div>
            <div class="col-lg-6 text-right">
              <a class="btn-dark btn" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
            </div>
          </div>
          <br>
          <!-- Add Category Modal-->
          <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add New Player</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('player.add') }}">
                    @csrf
                    <div class="form-group text-left">
                      <label>Player Name</label>
                      <input name="name" type="text" class="form-control" placeholder="Enter player name">
                    </div>
                    <div class="form-group text-left">
                      <label>Player Email</label>
                      <input name="email" type="email" class="form-control" placeholder="Enter player email">
                    </div>
                    <div class="form-group text-left">
                      <label>Player Password</label>
                      <input name="password" type="password" class="form-control" placeholder="Enter password">
                    </div>
                    <div class="form-group text-left">
                      <label>Confirm Player Password</label>
                      <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm password">
                    </div>
                    <div class="form-group text-left">
                      <label>Player Points</label>
                      <input name="points" type="text" class="form-control" placeholder="Enter player points">
                    </div>
                    <div class="text-right">
                      <button class="btn btn-sm btn-success" type="submit">Save Player</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row no-gutters align-items-center table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Avatar</th>
                  <th scope="col">Player Name</th>
                  <th scope="col">Player Email</th>
                  <th scope="col">Player Points</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $i=0
                @endphp
                @foreach($players as $player)
                <tr>
                  <td><img src="{{$player->image_url}}" height="50px" width="55px" class="rounded-circle"></td>
                  <td>{{$player->name}}</td>
                  <td>{{$player->email}}</td>
                  <td>{{$player->score}}</td>
                  <td>
                    <a class="btn btn-sm btn-danger" href="{{ route('player.destroy', ['player'=>$player->id]) }}"><i class="fas fa-user-minus"></i> Delete player</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div>
              {{ $players->links() }}
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