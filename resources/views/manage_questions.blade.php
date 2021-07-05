@include('partials.navbar')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$categoryName}} Questions</h1>
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
                  <div class="row">
                    <div class="col-lg-4">  
                      <a class="btn-success btn btn-block" href="#" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add New Question</a>
                    </div>
                    <div class="col-lg-4">  
                      <a class="btn-info btn btn-block" href="#" data-toggle="modal" data-target="#bulkModal"><i class="fas fa-file-csv"></i> Bulk Import</a>
                    </div>
                    <div class="col-lg-4 text-right">  
                      <a class="btn-dark btn" href="{{ route('questions') }}"><i class="fas fa-arrow-left"></i> Back To All Questions</a>
                    </div>
                  </div>
                  <br>
                  <!-- Add Category Modal-->
                  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add New Question in {{$categoryName}}</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="{{ route('question.add', ['id'=>$category->id]) }}">
                          @csrf
                          <input name="category_id" value="{{$category->id}}" class="form-control" type="hidden">
                          <div class="form-group text-left">
                            <label>Question</label>
                            <input name="question" type="text" class="form-control" placeholder="Enter a Question">
                          </div>
                          <div class="form-group text-left">
                            <label>True Answer</label>
                            <input name="true_answer" type="text" class="form-control" placeholder="Enter a true answer">
                          </div>
                          <div class="form-group text-left">
                            <label>False Answer 1</label>
                            <input name="false_answer1" type="text" class="form-control" placeholder="Enter a false answer">
                          </div>
                          <div class="form-group text-left">
                            <label>False Answer 2</label>
                            <input name="false_answer2" type="text" class="form-control" placeholder="Enter another false answer">
                          </div>
                          <div class="form-group text-left">
                            <label>False Answer 3</label>
                            <input name="false_answer3" type="text" class="form-control" placeholder="Enter another false answer">
                          </div>
                          <div class="form-group text-left">
                            <label>Points</label>
                            <input name="points" type="text" class="form-control" placeholder="Enter number of points">
                          </div>
                          <div class="form-group text-left">
                          <label>Choose a level</label>
                          <select name="level" class="custom-select">
                            <option selected value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                            <option value="expert">Expert</option>
                          </select>
                          </div>
                          <div class="text-right">
                          <button class="btn btn-sm btn-success" type="submit">Save Question</button>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--  Bulk Import Modal-->
                  <div class="modal fade" id="bulkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Import questions via csv file to {{$categoryName}}</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" enctype="multipart/form-data" action="{{ route('question.bulk.import', ['id'=>$category->id]) }}">
                          @csrf
                          <input name="category_id" value="{{$category->id}}" class="form-control" type="hidden">
                          <div class="form-group text-left">
                            <label>Select a file</label>
                            <input name="file" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control">
                          </div>
                          <div class="text-right">
                          <button class="btn btn-sm btn-success" type="submit">Upload File</button>
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
                          <th scope="col">Question</th>
                          <th scope="col">Level</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($related_questions as $question)
                        <tr>
                        <td>{{$question->question}}</td>
                        <td>{{$question->level}}</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{$question->id}}"><i class="fas fa-edit"></i> Edit</a>
                          <!-- Edit Question Modal-->
                  <div class="modal fade" id="editModal{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit question</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="{{ route('question.update', ['question'=>$question->id]) }}">
                          @csrf
                          <input name="category_id" value="{{$category->id}}" class="form-control" type="hidden">
                          <div class="form-group text-left">
                            <label>Question</label>
                            <input name="question" type="text" class="form-control" value="{{$question->question}}">
                          </div>
                          <div class="form-group text-left">
                            <label>True Answer</label>
                            <input name="true_answer" type="text" class="form-control" value="{{$question->true_answer}}">
                          </div>
                          <div class="form-group text-left">
                            <label>False Answer 1</label>
                            <input name="false_answer1" type="text" class="form-control" value="{{$question->false_answer1}}">
                          </div>
                          <div class="form-group text-left">
                            <label>False Answer 2</label>
                            <input name="false_answer2" type="text" class="form-control" value="{{$question->false_answer2}}">
                          </div>
                          <div class="form-group text-left">
                            <label>False Answer 3</label>
                            <input name="false_answer3" type="text" class="form-control" value="{{$question->false_answer3}}">
                          </div>
                          <div class="form-group text-left">
                            <label>Points</label>
                            <input name="points" type="text" class="form-control" value="{{$question->points}}">
                          </div>
                          <div class="form-group text-left">
                          <label>Choose a level</label>
                          <select name="level" class="custom-select">
                            <option @if($question->level == "easy") selected @endif value="easy">Easy</option>
                            <option @if($question->level == "medium") selected @endif value="medium">Medium</option>
                            <option @if($question->level == "hard") selected @endif value="hard">Hard</option>
                            <option @if($question->level == "expert") selected @endif value="expert">Expert</option>
                          </select>
                          </div>
                          <div class="text-right">
                          <button class="btn btn-sm btn-success" type="submit">Save Changes</button>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
                          <a href="{{ route('question.delete', ['question'=>$question->id]) }}" class="btn btn-danger btn-sm"><i class="fas fa-minus-circle"></i> Delete</a>
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                      </table>
                      <div>
                        {{ $related_questions->links() }}
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