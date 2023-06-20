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

                <div class="col-12 ">
                    <div class="app-card app-card-settings shadow-sm p-4">

                        <div class="app-card-body ">
                            <form class="settings-form " enctype="multipart/form-data" method="post"
                                action="{{ route('admin.document.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Tên Tài Liệu</label>
                                    <input value="{{ old('name') }}" type="text"
                                        class="form-control
                                    
                                    
                                 
                                    "
                                        id="setting-input-2" name="name">


                                    @error('name')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Mô Tả Tài Liệu</label>
                                    <textarea style="height: 150px" type="text" class="form-control" id="setting-input-2" name="description"> {{ old('description') }}</textarea>


                                    @error('description')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="mb-3">
                                    <label class="input-group-text" for="inputGroupFile01">Upload file
                                        * tệp tin có định dạng doc, docx, xls, xlsx, ppt, pptx hoặc pdf
                                        <nav>


                                        </nav>
                                    </label>
                                    <input value="{{ old('doc') }}" type="file" name="doc"
                                        class="form-control
                                    
                                  
                                    "
                                        id="inputGroupFile01">

                                    @error('doc')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror
                                </div>






                                <div class="mb-3">
                                    <label for="" class="form-label d-block">Kích Hoạt</label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" id="active"
                                            value="1" checked>
                                        <label class="form-check-label" for="active">
                                            Có
                                        </label>


                                    </div>

                                    <div class="form-check">

                                        <input class="form-check-input" type="radio" name="active" id="noactive"
                                            value="0">
                                        <label class="form-check-label" for="noactive">
                                            Không
                                        </label>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label d-block">Danh Mục</label>
                                    <select class="form-select form-select-sm" name="category_id"
                                        aria-label=".form-select-lg example">
                                        {{-- <option>Chọn Danh Mục</option> --}}

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach


                                    </select>
                                    @error('category_id')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3   text-center">
                                    <button type="submit"
                                        class="btn app-btn-primary 
                               
                                  
                                    ">Thêm</button>
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
