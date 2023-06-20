@extends('admin.layout_main')
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

                <div class="col-12 ">
                    <div class="app-card app-card-settings shadow-sm p-4">

                        <div class="app-card-body ">
                            <form class="settings-form " enctype="multipart/form-data" method="post"
                                action="{{ route('admin.exam.store') }}">

                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Tên Bài Thi</label>
                                    <input value="{{ old('title') }}" type="text"
                                        class="form-control
                                    
                                    
                                 
                                    "
                                        id="setting-input-2" name="title">


                                    @error('title')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Mô Tả Bài Thi</label>
                                    <textarea style="height: 150px" type="text" class="form-control" id="setting-input-2" name="description">{{ old('description') }} </textarea>


                                    @error('description')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Thời Gian (s)</label>
                                    <input type="number" value="1" min="1" max="36000"
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
                               
                                  
                                    ">Thêm</button>
                                </div>



                                @csrf
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
