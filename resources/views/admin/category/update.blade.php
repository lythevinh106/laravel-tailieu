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
                    <a href="{{ route('admin.category.index') }}"
                        class="btn bg-primary text-white d-inline-block ms-auto mb-3 ">Danh Sách</a>
                </div>
                <div class="col-12 ">
                    <div class="app-card app-card-settings shadow-sm p-4 ">

                        <div class="app-card-body ">
                            <form class="settings-form " enctype="multipart/form-data" method="post"
                                action="{{ url("admin/category/edit/$category->id") }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Tên Danh Mục</label>
                                    <input value="{{ $category->name }}" type="text"
                                        class="form-control 
                                    
                                    
                                 
                                    "
                                        id="setting-input-2" name="name">


                                    @error('name')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Mô Tả Danh Mục</label>
                                    <textarea style="height: 150px" type="text" class="form-control" id="setting-input-2" name="description">
                                        {{ $category->description }}
                                   </textarea>
                                    @error('description')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="mb-3">
                                    <label class="input-group-text" for="upload-category">Upload Ảnh Đại Diên
                                        * ưu tiên ảnh(1450x750)
                                        <nav>


                                        </nav>
                                    </label>
                                    <input value="{{ old('images') }}" type="file" name="images"
                                        class="form-control 
                                    
                                  
                                    "
                                        id="upload-category">

                                    @error('images')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 image-demo">
                                    <img src="{{ $category->images }}" class="img-thumbnail object-fit-cover w-auto "
                                        style="height: 120px" alt="">
                                </div>






                                <label for="" class="form-label d-block">Kích Hoạt</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="active" id="active"
                                        value="1" {{ $category->active == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">
                                        Có
                                    </label>


                                </div>

                                <div class="form-check">

                                    <input class="form-check-input" type="radio" name="active" id="noactive"
                                        value="0" {{ $category->active == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="noactive">
                                        Không
                                    </label>
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
        uploadthumb("#upload-category", ".image-demo img");
    </script>
@endsection
