@extends('client.layout_main')
@section('content')
    <div class="modal-result-exam  w-100 h-100 top-0 start-0  bg-white" style="position: fixed;z-index:3">
        <div class=" ">
            <h1 class="modal-title fs-5">KẾT QUẢ
                THI THỬ</h1>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        </div>
        <div class=" text-center text-black">
            <div class="img">
                <lord-icon src="https://cdn.lordicon.com/tqywkdcz.json" trigger="loop"
                    colors="primary:#4bb3fd,secondary:#f28ba8,tertiary:#ffc738,quaternary:#f24c00"
                    style="width:150px;height:150px">
                </lord-icon>
            </div>
            <div class=" mt-2 fw-semibold lh-base" style="font-size: 19px;">
                Chúc Mừng Bạn Đã Hoàn Thành Bài Thi Thử Kết Quả Đã Được Ghi Nhận Lại
            </div>
            <div class=" mt-4 fw-semibold" style="font-size: 19px;">
                <span class="mx-3 d-inline-block">Hoàn Thành Được: <strong
                        class="my-text-orange">{{ $history->point }}%</strong></span>
                <span class="mx-3 d-inline-block">Đánh Giá : <strong
                        class="my-text-orange">{{ $history->evaluate }}</strong>
                </span>

            </div>
        </div>
        <div class=" text-center mt-4">
            <a href="{{ route('client.index') }}" class="btn btn-primary">
                Bấm Vào Đây Để Về Trang Chủ
            </a>

            <div class="mt-3">
                <a class="btn my-bg-orange" data-bs-toggle="offcanvas" href="#offcanvasHistory" role="button"
                    aria-controls="offcanvasHistory" aria-current="page" href="#">
                    Bấm Vào Đây Để Xem Lịch Sử
                </a>
            </div>
        </div>
    </div>
@endsection
