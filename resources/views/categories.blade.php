@include('partials.navbar')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Categories</h1>
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
              <a class="btn-success btn btn-block" href="#" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add New Category</a>
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
                  <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('category.add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group text-left">
                      <label>Category Name</label>
                      <input name="category_name" type="text" class="form-control" placeholder="Enter a Category name">
                    </div>
                    <div class="form-group text-left">
                      <label>Category Image</label>
                      <input name="category_image" type="file" class="form-control">
                    </div>
                    <div class="form-check">
                      <input name="featured_category" class="form-check-input" type="checkbox" value="yes" id="defaultCheck5">
                      <label class="form-check-label" for="defaultCheck5">
                        Make it as Featured Category
                      </label>
                    </div>
                    <div class="text-right">
                      <button class="btn btn-sm btn-success" type="submit">Save Category</button>
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
                  <th scope="col">Category Name</th>
                  <th scope="col">Category Image</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                <tr>
                  <td>@if($category->is_featured == 'yes') <img style="margin-right: 5px; vertical-align: top;" src="{{ asset('assets/img/feature.png') }}" width="15px">@endif {{$category->name}}</td>
                  <td><img src="{{ asset('/assets/uploads/categories/'.$category->image_url) }}" height="60px"></td>
                  <td>
                    <a class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#editModal{{$category->id}}"><i class="fas fa-edit"></i> Edit Category</a>
                    <!-- Edit Category Modal-->
                    <div class="modal fade" id="editModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Your Category</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="{{ route('category.update', ['category'=>$category->id]) }}" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group text-left">
                                <label>Category Name</label>
                                <input name="category_name" type="text" class="form-control" value="{{$category->name}}">
                              </div>
                              <div class="form-group text-left">
                                <label>Category Image</label>
                                <input name="category_image" type="file" class="form-control">
                              </div>
                              <div class="form-check text-left">
                                <input name="featured_category" class="form-check-input" type="checkbox" value="yes" id="defaultCheck1"
                                @if($category->is_featured == 'yes') checked @endif>
                                <label class="form-check-label" for="defaultCheck1">
                                  Featured Category
                                </label>
                              </div>
                              <div class="text-right">
                                <button class="btn btn-sm btn-success" type="submit">Save Edition</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a class="btn btn-sm btn-danger" href="{{ route('category.delete', ['category'=>$category->id]) }}"><i class="fas fa-minus-circle"></i> Delete Category</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div style="">
              {{ $categories->links() }}
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