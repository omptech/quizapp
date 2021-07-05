@include('partials.navbar')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Admins</h1>
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
                    <div class="col-lg-6">  
                      <a class="btn-success btn btn-block" href="#" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add New Admin</a>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Add New Admin</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="POST" action="{{ route('admin.add') }}">
                                    @csrf
                                    <div class="form-group text-left">
                                      <label>Admin Name</label>
                                      <input name="name" type="text" class="form-control" placeholder="Enter admin name">
                                    </div>
                                    <div class="form-group text-left">
                                      <label>Admin Email</label>
                                      <input name="email" type="email" class="form-control" placeholder="Enter admin email">
                                    </div>
                                    <div class="form-group text-left">
                                      <label>Admin Password</label>
                                      <input name="password" type="password" class="form-control" placeholder="Enter password">
                                    </div>
                                    <div class="form-group text-left">
                                      <label>Confirm Password</label>
                                      <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm password">
                                    </div>
                                    <div class="text-right">
                                    <button class="btn btn-sm btn-success" type="submit">Save Admin</button>
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
                          <th scope="col">Admin Name</th>
                          <th scope="col">Admin Email</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($admins as $admin)
                        <tr>
                          <td>{{$admin->name}}</td>
                          <td>{{$admin->email}}</td>
                          <td>
                            <a class="btn btn-sm btn-danger" href="{{ route('admin.destroy', ['admin'=>$admin->id]) }}"><i class="fas fa-user-minus"></i> Delete Admin</a>
                          </td>
                        </tr>
                        @endforeach
                        </tbody>
                      </table>
                      <div>
                        {{ $admins->links() }}
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
