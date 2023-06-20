@extends('admin.layout_main');

@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title text-center">{{ $title }}</h1>
            <hr class="mb-4">
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <form class="table-search-form row gx-1 align-items-center">
                                <div class="col-auto">
                                    <input type="text" id="search-orders" name="search"
                                        class="form-control search-orders" placeholder="Tên Danh Mục cần tìm?">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn app-btn-secondary">Search</button>
                                </div>
                            </form>

                        </div>

                        <div class="col-auto" style="margin-top:-6px !important">
                            <div class="dropdown">
                                <button class="btn btn-secondary  dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Lọc
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">


                                    <li class="dropdown-item">
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}">Từ
                                            Mới Tới Cũ</a>
                                    </li>

                                    <li class="dropdown-item">
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}">Từ
                                            Cũ Tới Mơi</a>
                                    </li>


                                </ul>
                            </div>

                        </div>
                        <!--//col-->


                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <div class="row  settings-section">

                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">STT</th>
                                        <th class="cell">Môn</th>
                                        <th class="cell">Ảnh</th>
                                        <th class="cell">Slug</th>

                                        <th class="cell">Status</th>

                                        <th class="cell"></th>
                                    </tr>
                                </thead>

                                @php
                                    
                                    $str = 0;
                                    
                                @endphp

                                <tbody>
                                    @foreach ($categories as $category)
                                        @php
                                            
                                            $str++;
                                            
                                        @endphp
                                        <tr id="row-{{ $category->id }}">
                                            <td class="cell">{{ $str }}</td>
                                            <td class="cell"><span class="truncate">
                                                    {{ $category->name }}
                                                </span></td>
                                            <td class="cell">
                                                <img class="object-fit-cover w-auto" style="height:74px"
                                                    src=" {{ $category->images }}" alt="">
                                            </td>
                                            <td class="cell"></span><span class="note"><span>
                                                        {{ $category->slug }}</span></td>
                                            <td class="cell"><span
                                                    class="badge  {{ $category->active == 1 ? 'bg-success' : 'bg-danger' }} ">

                                                    {{ $category->active == 1 ? 'Kích Hoạt' : 'Vô Hiệu' }}
                                                </span></td>

                                            <td class="cell">
                                                <span
                                                    class="btn-sm  d-flex justify-content-center
                                                    border-0
                                                    "
                                                    href="#">
                                                    <a onclick="removeRow({{ $category->id }},'/admin/category/delete/')"
                                                        class="px-2 pointer"><i
                                                            class="text-danger fs-4 fw-bold bi bi-trash-fill"></i></a>


                                                    <a href="{{ url("admin/category/show/$category->id") }}"
                                                        class="px-2"><i
                                                            class="text-primary fs-4 fw-bold bi bi-gear-fill"></i></a>

                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach








                                </tbody>
                            </table>
                        </div>
                        <!--//table-responsive-->

                    </div>
                    <!--//app-card-body-->
                </div>

                <div class="d-flex mt-5  justify-content-center"> {{ $categories->links() }}</div>
            </div>





        </div>
        <!--//container-fluid-->
    </div>
@endsection
