@extends('admin.layout_main');

@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title text-center">{{ $title }}</h1>
            <hr class="mb-4">
            <div class="row  settings-section">
                <div class="col-12">
                    <a href="{{ route('admin.document.index') }}"
                        class="btn bg-primary text-white d-inline-block ms-auto mb-3 ">Danh Sách</a>
                </div>
                <div class="col-12 ">
                    <div class="app-card app-card-settings shadow-sm p-4 ">

                        <div class="app-card-body ">
                            <form class="settings-form " enctype="multipart/form-data" method="post"
                                action="{{ url("admin/document/edit/$document->id") }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Tên Tài Liệu</label>
                                    <input value="{{ $document->name }}" type="text"
                                        class="form-control 
                                    
                                    
                                 
                                    "
                                        id="setting-input-2" name="name">


                                    @error('name')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Mô Tả Tài Liệu</label>
                                    <textarea style="height: 150px" type="text" class="form-control" id="setting-input-2"
                                        name="description">{{ $document->description }}</textarea>
                                    @error('description')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="mb-3">
                                    <label class="input-group-text" for="upload-category">Upload File

                                        * tệp tin có định dạng doc, docx, xls, xlsx, ppt, pptx hoặc pdf
                                        <nav>


                                        </nav>

                                    </label>
                                    <input type="file" name="doc"
                                        class="form-control 
                                    
                                  
                                    "
                                        id="upload-category">

                                    @error('doc')
                                        <div class="bg-danger  px-3 mt-2 text-warning">{{ $message }}</div>
                                    @enderror



                                </div>



                                <div class="mb-3">
                                    <label for="" class="form-label d-block">Kích Hoạt</label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" id="active"
                                            value="1" {{ $document->active == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="active">
                                            Có
                                        </label>


                                    </div>

                                    <div class="form-check">

                                        <input {{ $document->active == 0 ? 'checked' : '' }} class="form-check-input"
                                            type="radio" name="active" id="noactive" value="0">
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
                                            <option {{ $category->id == $document->category_id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach


                                    </select>
                                    @error('category_id')
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


                    </div>

                </div>
            </div>


        </div>

    </div>
@endsection


@section('js')
    <script type="text/javascript"></script>
@endsection
