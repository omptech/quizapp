@include('partials.navbar')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="row">
          <div class="col-lg-6 d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Questions by Category</h1>
          </div>
          <div class="col-lg-6 text-right">  
            <a class="btn-dark btn" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
          </div>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            @foreach($categories as $category)
            <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card" style="margin: 5px;">
              <img style="max-height: 200px;" src="{{ asset('/assets/uploads/categories/'.$category->image_url) }}" class="card-img-top" alt="{{$category->name}}">
              <div class="card-body">
                <h4 class="card-title">{{$category->name}}</h4>
                <p class="card-text">Number of Questions :  {{$category->questions()->count()}}</p>
                <a href="{{ route('related.questions', ['id'=>$category->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Manage Questions</a>
              </div>
            </div>
            </div>
            @endforeach
          </div>
          <br>
          <div style="">
              {{ $categories->links() }}
            </div>
          <!-- Content Row -->
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

@include('partials.footer')
