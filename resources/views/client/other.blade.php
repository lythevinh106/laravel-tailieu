   <!-- other -->

   <section class="progress position-fixed top-0 start-0 w-0 " style="background-color: var(--c__orange);height: 3px;">

   </section>

   <!-- ///modal-result -->

   <div class="modal modal-alert-result fade " id="exampleModalToggle" aria-hidden="true"
       aria-labelledby="exampleModalToggleLabel" tabindex="-1">
       <div class="modal-dialog modal-dialog-centered 
        modal-fullscreen text-black">
           <div class="modal-content ">
               <div class="modal-header ">
                   <h1 class="modal-title fs-5" id="exampleModalToggleLabel text-center w-100 fw-semibold">KẾT QUẢ
                       THI THỬ</h1>
                   <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
               </div>
               <div class="modal-body text-center">
                   <div class="modal-body-img">
                       <lord-icon src="https://cdn.lordicon.com/tqywkdcz.json" trigger="loop"
                           colors="primary:#4bb3fd,secondary:#f28ba8,tertiary:#ffc738,quaternary:#f24c00"
                           style="width:150px;height:150px">
                       </lord-icon>
                   </div>
                   <div class="modal-body-title mt-2 fw-semibold lh-base" style="font-size: 19px;">
                       Chúc Mừng Bạn Đã Hoàn Thành Bài Thi Thử Kết Quả Đã Được Ghi Nhận Lại
                   </div>
                   <div class="modal-body-result mt-4 fw-semibold" style="font-size: 19px;">
                       <span class="mx-3 d-inline-block">Số Câu: <strong class="my-text-orange">14/15</strong>
                       </span>
                       <span class="mx-3 d-inline-block">Số Điểm: <strong class="my-text-orange">9</strong></span>
                   </div>
               </div>
               <div class="modal-footer text-center">
                   <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Quay Về
                       Trang Chủ
                   </button>
               </div>
           </div>
       </div>
   </div>







   {{-- <div class="modal-result-exam  w-100 h-100 top-0 start-0  bg-white" style="position: fixed;z-index:9999999">
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
               <span class="mx-3 d-inline-block">Số Câu: <strong class="my-text-orange">14/15</strong>
               </span>
               <span class="mx-3 d-inline-block">Số Điểm: <strong class="my-text-orange">9</strong></span>
           </div>
       </div>
       <div class=" text-center mt-4">
           <a href="{{ route('client.index') }}" class="btn btn-primary">
               Bấm Vào Đây Để Về Trang Chủ
           </a>
       </div>
   </div> --}}
