@include('partials.navbar')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Withdrawals</h1>
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
            <div class="col-lg-12 text-right">
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
                      <label>Player Password</label>
                      <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm password">
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
                  <th scope="col">Player</th>
                  <th scope="col">Method</th>
                  <th scope="col">Account</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Date</th>
                  <th scope="col">Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($withdrawals as $withdrawal)
                <tr>
                  @inject('player', 'App\Player')
                  <td>{{App\Player::find($withdrawal->player_id)->name}}</td>
                  <td>{{$withdrawal->payment_method}}</td>
                  <td>{{$withdrawal->payment_account}}</td>
                  <td>{{$withdrawal->amount}} {{$settings->currency}}</td>
                  <td>{{$withdrawal->created_at->format('jS F Y')}}</td>
                  <td>@if($withdrawal->status=="Paid")
                    <p class="btn-success">{{$withdrawal->status}}</p>
                    @elseif($withdrawal->status=="Pending")
                    <p class="btn-dark">{{$withdrawal->status}}</p>
                    @elseif($withdrawal->status=="Rejected")
                    <p class="btn-danger">{{$withdrawal->status}}</p>
                    @endif
                  </td>
                  <td>@if($withdrawal->status=="Paid")
                    <p class="btn-success">{{$withdrawal->status}}</p>
                    @else
                    <a class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#editModal{{$withdrawal->id}}"><i class="fas fa-edit"></i> Change Status</a>
                    <div class="modal fade" id="editModal{{$withdrawal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Withdrawal </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="{{ route('withdrawal.update', ['id'=>$withdrawal->id]) }}" >
                              @csrf
                              <div class="form-group">
                                <select name ="status" class="custom-select">
                                  <option selected value="Paid">Mark as Paid</option>
                                  <option value="Rejected">Mark as Rejected</option>
                                </select>
                              </div>
                              <div class="text-right">
                                <button class="btn btn-sm btn-success" type="submit">Save Edition</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div>
              {{ $withdrawals->links() }}
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