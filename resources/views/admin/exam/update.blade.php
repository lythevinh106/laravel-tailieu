@extends('admin.layout_main');
{{-- @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif --}}
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title text-center">{{ $title }}</h1>
            <hr class="mb-4">
            <div class="row  settings-section">
                <div class="col-12">
                    <a href="{{ url('admin/question/index/' . $exam->id) }}"
                        class="btn bg-primary text-white d-inline-block ms-auto mb-3 ">cập nhật câu hỏi</a>
                </div>
                <div class="col-12 ">
                    <div class="app-card app-card-settings shadow-sm p-4 ">

                        <div class="app-card-body ">
                            <form class="settings-form " method="post" action="{{ url("admin/exam/edit/$exam->id") }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Tên Bài Thi</label>
                                    <input value="{{ $exam->title }}" type="text"
                                        class="form-control 
                                    
                                    
                                 
                                    "
                                        id="setting-input-2" name="title">


                                    @error('title')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Mô Tả Bài Thi</label>
                                    <textarea style="height: 150px" type="text" class="form-control" id="setting-input-2" name="description">{{ $exam->description }}</textarea>


                                    @error('description')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror



                                </div>

                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Thời Gian (s)</label>
                                    <input type="number" value="{{ $exam->time }}" min="1" max="36000"
                                        class="form-control
                                    
                                    
                                 
                                    "
                                        id="setting-input-2" name="time">


                                    @error('time')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror
                                </div>



















                                <div class="mb-3   text-center">
                                    <button type="submit"
                                        class="btn app-btn-primary 
                               
                                  
                                    ">Cập
                                        Nhật</button>
                                </div>


                            </form>
                        </div>
                        <!--//app-card-body-->

                    </div>
                    <!--//app-card-->
                </div>
            </div>





        </div>
        <!--//container-fluid-->
    </div>
@endsection


@section('js')
    <script type="text/javascript">
        uploadthumb("#upload-exam", ".image-demo img");
    </script>
@endsection
