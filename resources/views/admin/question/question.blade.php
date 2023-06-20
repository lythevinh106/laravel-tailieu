@php
    $module_active = session('module_active');
    
@endphp
@extends('admin.layout_main');

@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title text-center">{{ $title }}</h1>
            <hr class="mb-4">
            <div class="col-auto mb-4">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">


                            <button class="btn  btn-primary text-white btn_create" data-bs-toggle="modal"
                                data-bs-target="#createExam">Thêm Nội Dung Câu Hỏi</button>



                        </div>

                        <div class="col-auto d-flex align-items-center">
                            <form class="table-search-form row gx-1 align-items-center my-auto">
                                <div class="col-auto">
                                    <input type="text" id="search-orders" name="search"
                                        class="form-control search-orders" placeholder="tên Câu Hỏi cần tìm?">
                                </div>
                                <div class="col-auto ">
                                    <button type="submit" class="btn app-btn-secondary">Search</button>
                                </div>
                            </form>

                        </div>
                        <!--//col-->



                    </div>
                    <!--//row-->
                </div>

            </div>

            {{-- ///create-modal --}}
            <div class="modal fade " id="createExam" tabindex="-1" aria-labelledby="createExamLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <form method="post" class="form-create modal-content d-block">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createExamLabel">Nội Dung Câu Hỏi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="title" class="col-form-label fw-semibold">Nội Dung Câu Hỏi:</label>
                                <div class="form-floating">
                                    <textarea style="height: 100px" class="form-control" name="title" placeholder="Nhập Nội Dung" id="floatingTextarea"></textarea>

                                </div>


                            </div>
                            <div id="error-title" class="bg-danger  px-3 mt-2 text-white"></div>
                            <div class="mb-3 py-3">

                                <label for="title" class="col-form-label fw-semibold">Đáp Án:</label>
                            </div>

                            <div class="mb-2">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input checked class="form-check-input mt-0" type="radio" name="is_correct"
                                            value="1" aria-label="Radio button for following text input">
                                    </div>
                                    <input type="text" class="form-control" name="content1" placeholder="đáp án 1"
                                        aria-label="Text input with radio button">



                                </div>
                                <div id="error-content1" class="bg-danger  px-3 mt-2 text-white"></div>
                            </div>
                            <div class="mb-2">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="radio" name="is_correct" value="2"
                                            aria-label="Radio button for following text input">
                                    </div>
                                    <input type="text" class="form-control" name="content2" placeholder="đáp án 2"
                                        aria-label="Text input with radio button">
                                </div>

                                <div id="error-content2" class="bg-danger  px-3 mt-2 text-white"></div>
                            </div>
                            <div class="mb-2">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="radio" name="is_correct" value="3"
                                            aria-label="Radio button for following text input">
                                    </div>
                                    <input type="text" class="form-control" name="content3" placeholder="đáp án 3"
                                        aria-label="Text input with radio button">
                                </div>
                                <div id="error-content3" class="bg-danger  px-3 mt-2 text-white"></div>

                            </div>
                            <div class="mb-2">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="radio" name="is_correct"
                                            value="4" aria-label="Radio button for following text input">
                                    </div>
                                    <input type="text" class="form-control" name="content4" placeholder="đáp án 4"
                                        aria-label="Text input with radio button">
                                </div>
                                <div id="error-content4" class="bg-danger  px-3 mt-2 text-white"></div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <div class="btn btn-primary text-white"
                                onclick="handleCreate(this, '/admin/question/store/{{ $exam->id }}', {{ $exam->id }})">
                                Tạo
                                Câu Hỏi</div>
                        </div>

                        {{-- @csrf --}}
                    </form>
                </div>
            </div>

            <div class="row  settings-section">

                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body p-5">

                        <div class="accordion" id="accordionWrapper">
                            @foreach ($questions as $question)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-info text-white  " type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapse{{ $question->id }}"
                                            aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapse{{ $question->id }}">
                                            {{ $question->content }}

                                        </button>


                                    </h2>

                                    <div id="panelsStayOpen-collapse{{ $question->id }}"
                                        class="accordion-collapse collapse ">
                                        <div class="accordion-body ">
                                            <button class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#updateModal-{{ $question->id }}">

                                                <span class=""><i
                                                        class="bi bi-gear-fill fw-bold fs-3 text-white"></i></span>

                                            </button>

                                            <button
                                                onclick="
                                            handleDelete({{ $question->id }},'/admin/question/delete')
                                          
                                     
                                            "
                                                class="px-2 pointer btn btn-danger"><i
                                                    class="text-white fs-4 fw-bold bi bi-trash-fill "></i></button>
                                            @foreach ($question->answers as $answer)
                                                <div class="form-check my-2">
                                                    <input class="form-check-input " type="radio"
                                                        name="radio-question-{{ $question->id }}"
                                                        id="radio-question-{{ $answer->id }}" disabled
                                                        {{ $answer->is_correct == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="radio-question-{{ $answer->id }}">
                                                        <strong></strong> {{ $answer->content }}
                                                    </label>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div>
                                </div>

                                {{-- modal-update --}}

                                <div class="modal fade " id="updateModal-{{ $question->id }}" tabindex="-1"
                                    aria-labelledby="createExamLabel" aria-hidden="true">
                                    <div class="modal-dialog ">
                                        <form {{-- method="post"  --}} {{-- action="/admin/question/edit/{{ $exam->id }}/{{ $question->id }}" --}}
                                            class="form-update modal-content d-block">


                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="createExamLabel">Nội Dung Câu Hỏi</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label for="title" class="col-form-label fw-semibold">Nội Dung Câu
                                                        Hỏi:</label>
                                                    <div class="form-floating">
                                                        <textarea style="height: 100px" class="form-control" name="title" placeholder="Nhập Nội Dung">{{ $question->content }}</textarea>



                                                    </div>


                                                </div>
                                                <div id="error-update-{{ $question->id }}-title"
                                                    class="bg-danger  px-3 mt-2 text-white">
                                                </div>
                                                <div class="mb-3 py-3">

                                                    <label for="title" class="col-form-label fw-semibold">Đáp
                                                        Án:</label>
                                                </div>

                                                @php
                                                    $stt = 0;
                                                @endphp
                                                @foreach ($question->answers as $answer)
                                                    @php
                                                        $stt++;
                                                    @endphp
                                                    <div class="mb-2">
                                                        <div class="input-group">
                                                            <div class="input-group-text">
                                                                <input class="form-check-input mt-0" type="radio"
                                                                    name="is_correct" value="{{ $stt }}"
                                                                    {{ $answer->is_correct == 1 ? 'checked' : '' }}
                                                                    aria-label="Radio button for following text input">
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                name="content{{ $stt }}"
                                                                placeholder="đáp án {{ $stt }}"
                                                                aria-label="Text input with radio button"
                                                                value="{{ $answer->content }}">
                                                        </div>
                                                        <div id="error-update-{{ $question->id }}-content{{ $stt }}"
                                                            class="bg-danger  px-3 mt-2 text-white">
                                                        </div>

                                                    </div>
                                                @endforeach



                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <div class="btn-update btn btn-primary text-white"
                                                    onclick="handleUpdate(this, '/admin/question/edit/{{ $exam->id }}/{{ $question->id }}', {{ $exam->id }})">
                                                    Cập Nhật Câu Hỏi
                                                </div>
                                            </div>

                                            {{-- @csrf --}}
                                        </form>
                                    </div>
                                </div>
                            @endforeach





                        </div>

                    </div>
                    <!--//app-card-body-->

                    {{-- <div class="d-flex mt-5  justify-content-center"> {{ $exams->links() }}</div> --}}

                    <div class="d-flex mt-5  justify-content-center"> {{ $questions->links() }}</div>
                </div>
            </div>





        </div>
        <!--//container-fluid-->
    </div>
@endsection



@section('js')
    <script>
        $(document).ready(function() {




            //             $('.form-create').submit(function(event) {
            //                 event.preventDefault(); 



            //                 var formData = $(this).serializeArray();
            //                 result_form = [];
            //                 formData.forEach(function(item) {
            //                     result_form[item.name] = item.value;
            //                 });


            //                 url = $(this).attr("action");





            //                 $.ajax({
            //                     url: url, 
            //                     type: 'POST',
            //                     dataType: 'json',
            //                     contentType: 'application/json',
            //                     data: JSON.stringify({
            //                         ...result_form,
            //                     }),
            //                     success: function(response) {






            //                         if (response.success == true) {


            //                             $(".form-create [id^='error']").each(function(index, value) {
            //                                 $(value).text("");
            //                             });

            //                             setTimeout(() => {
            //                                 $('.toast.my-toast.show').removeClass("show");
            //                             }, 5000);



            //                             let data = response.data;
            //                             $('.form-create')[0].reset();


            //                             var formRadioShow = data.answer.map(function(answer) {
            //                                 return `<div class="form-check my-2">
        //                       <input class="form-check-input" type="radio"
        //                     name="radio-question-${data.question.id}"
        //                     id="radio-question-${answer.id}" disabled
        //                     ${answer.is_correct == 1 ? 'checked' : ''}>
        //                    <label class="form-check-label"
        //                       for="radio-question-${answer.id}">
        //                     <strong></strong> ${answer.content}
        //                   </label>
        //                    </div>`;
            //                             }).join('');


            //                             let stt = 0;

            //                             var formRadioUpdate = data.answer.map(function(answer) {
            //                                 stt++;
            //                                 return `
        //                                 <div class="mb-2">
        //                                                  <div class="input-group">
        //                                                             <div class="input-group-text">
        //                                                                 <input class="form-check-input mt-0" type="radio"
        //                                                                     name="is_correct" value="${stt}"
        //                                                                     ${answer.is_correct == 1 ? 'checked' : ''}
        //                                                                     aria-label="Radio button for following text input">
        //                                                             </div>
        //                                                             <input type="text" class="form-control"
        //                                                                 name="content${stt}"
        //                                                                 placeholder="đáp án ${stt}"
        //                                                                 aria-label="Text input with radio button"
        //                                                                 value="${answer.content}">
        //                                                         </div>
        //                                                         <div id="error-update-${data.question.id}-content${stt}"
        //                                                             class="bg-danger  px-3 mt-2 text-white">
        //                                                         </div>

        //                                                     </div>
        //                                 `;
            //                             }).join('');













            //                             $("#accordionWrapper").prepend(
            //                                 `
        //                                 <div class="accordion-item">
        //                                     <h2 class="accordion-header">
        //                                         <button class="accordion-button bg-info text-white  " type="button"
        //                                             data-bs-toggle="collapse"
        //                                             data-bs-target="#panelsStayOpen-collapse${data.question.id }"
        //                                             aria-expanded="true"
        //                                             aria-controls="panelsStayOpen-collapse${data.question.id }">
        //                                             ${data.question.content}

        //                                         </button>


        //                                     </h2>

        //                                     <div id="panelsStayOpen-collapse${data.question.id }"
        //                                         class="accordion-collapse collapse ">
        //                                         <div class="accordion-body ">
        //                                             <button class="btn btn-warning" data-bs-toggle="modal"
        //                                                 data-bs-target="#updateModal-${data.question.id }">

        //                                                 <span class=""><i
        //                                                         class="bi bi-gear-fill fw-bold fs-3 text-white"></i></span>

        //                                             </button>


        //                                             ${formRadioShow}



        //                                         </div>
        //                                     </div>
        //                                 </div>

        //                                 {{-- modal-update --}}

        //                                 <div class="modal fade " id="updateModal-${data.question.id }" tabindex="-1"
        //                                     aria-labelledby="createExamLabel" aria-hidden="true">
        //                                     <div class="modal-dialog ">
        //                                         <form method="post"
        //                                             action="/admin/question/edit/${data.question.exam_id }/${data.question.id }"
        //                                             class="form-update modal-content d-block">
        //                                             <div class="modal-header">
        //                                                 <h1 class="modal-title fs-5" id="createExamLabel">Nội Dung Câu Hỏi</h1>
        //                                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
        //                                                     aria-label="Close"></button>
        //                                             </div>
        //                                             <div class="modal-body">

        //                                                 <div class="mb-3">
        //                                                     <label for="title" class="col-form-label fw-semibold">Nội Dung Câu
        //                                                         Hỏi:</label>
        //                                                     <div class="form-floating">
        //                                                         <textarea style="height: 100px" class="form-control" name="title" placeholder="Nhập Nội Dung">${data.question.content }</textarea>



        //                                                     </div>


        //                                                 </div>
        //                                                 <div id="error-update-${data.question.id }-title"
        //                                                     class="bg-danger  px-3 mt-2 text-white">
        //                                                 </div>
        //                                                 <div class="mb-3 py-3">

        //                                                     <label for="title" class="col-form-label fw-semibold">Đáp
        //                                                         Án:</label>
        //                                                 </div>


        //                                                 ${formRadioUpdate }






        //                                             </div>
        //                                             <div class="modal-footer">
        //                                                 <button type="button" class="btn btn-secondary"
        //                                                     data-bs-dismiss="modal">Close</button>
        //                                                 <button type="submit" class="btn btn-primary text-white">Cập Nhật Câu
        //                                                     Hỏi</button>
        //                                             </div>

        //                                             @csrf
        //                                         </form>
        //                                     </div>
        //                                 </div>
        //       `)






            //                             $("body").append(`


        //                             <div class=" toast my-toast align-items-center position-fixed  text-bg-primary border-0  show fade"
        //                 style="top: 8%;right: 1%;z-index: 88 !important" role="alert" aria-live="assertive" aria-atomic="true"
        //                      data-bs-autohide="true">
        //             <div class="d-flex bg-white text-black">
        //             <div
        //             class="toast-body d-flex align-items-center justify-content-between w-100 bg-success



        // 	          	text-white">
        //             <span> ${response.message} </span> <img class="ms-3" src="public/images/bell.gif" alt="">

        //             <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        //         </div>


        //     </div>

        // </div>
        //                             `)










            //                         }










            //                     },
            //                     error: function(xhr, status, errors) {


            //                         if (JSON.parse(xhr.responseText).success == false) {
            //                             let dataErros = JSON.parse(xhr.responseText).errors;

            //                             $(".form-create [id^='error']").each(function(index, value) {
            //                                 $(value).text("");
            //                             });

            //                             for (let error in dataErros) {

            //                                 $('#' + 'error-' + error).text(dataErros[error]);
            //                             }

            //                         }



            //                     }
            //                 });
            //             });

















            // update
            //             $('.form-update .btn-update').click(function(event) {


            //                 console.log("asdad");

            //                 var formData = $(this).serializeArray();
            //                 result_form = [];
            //                 formData.forEach(function(item) {
            //                     result_form[item.name] = item.value;
            //                 });


            //                 url = $(this).attr("action");


            //                 $.ajax({
            //                     url: "/admin/question/edit/2/78",
            //                     type: 'post',
            //                     headers: {
            //                         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            //                     },
            //                     dataType: 'json',
            //                     contentType: 'application/json',
            //                     data: JSON.stringify({
            //                         ...result_form,
            //                     }),

            //                     success: function(response) {
            //                         return;
            //                         if (response.success == true) {
            //                             let data = response.data;




            //                             $(".form-update [id^='error']").each(function(index, value) {
            //                                 $(value).text("");
            //                             });

            //                             var Parent = $('#panelsStayOpen-collapse' + data.question.id)
            //                                 .closest('.accordion-item');






            //                             var formRadioShow = data.answer.map(function(answer) {
            //                                 return `<div class="form-check my-2">
        //                       <input class="form-check-input" type="radio"
        //                     name="radio-question-${data.question.id}"
        //                     id="radio-question-${answer.id}" disabled
        //                     ${answer.is_correct == 1 ? 'checked' : ''}>
        //                    <label class="form-check-label"
        //                       for="radio-question-${answer.id}">
        //                     <strong></strong> ${answer.content}
        //                   </label>
        //                    </div>`;
            //                             }).join('');


            //                             let stt = 0;

            //                             var formRadioUpdate = data.answer.map(function(answer) {
            //                                 stt++;
            //                                 return `
        //                                 <div class="mb-2">
        //                                                  <div class="input-group">
        //                                                             <div class="input-group-text">
        //                                                                 <input class="form-check-input mt-0" type="radio"
        //                                                                     name="is_correct" value="${stt}"
        //                                                                     ${answer.is_correct == 1 ? 'checked' : ''}
        //                                                                     aria-label="Radio button for following text input">
        //                                                             </div>
        //                                                             <input type="text" class="form-control"
        //                                                                 name="content${stt}"
        //                                                                 placeholder="đáp án ${stt}"
        //                                                                 aria-label="Text input with radio button"
        //                                                                 value="${answer.content}">
        //                                                         </div>
        //                                                         <div id="error-update-${data.question.id}-content${stt}"
        //                                                             class="bg-danger  px-3 mt-2 text-white">
        //                                                         </div>

        //                                                     </div>
        //                                 `;
            //                             }).join('');
















            //                             $(Parent).html(
            //                                 `
        //                                 <div class="accordion-item">
        //                                     <h2 class="accordion-header">
        //                                         <button class="accordion-button bg-info text-white  " type="button"
        //                                             data-bs-toggle="collapse"
        //                                             data-bs-target="#panelsStayOpen-collapse${data.question.id }"
        //                                             aria-expanded="true"
        //                                             aria-controls="panelsStayOpen-collapse${data.question.id }">
        //                                             ${data.question.content}

        //                                         </button>


        //                                     </h2>

        //                                     <div id="panelsStayOpen-collapse${data.question.id }"
        //                                         class="accordion-collapse collapse ">
        //                                         <div class="accordion-body ">
        //                                             <button class="btn btn-warning" data-bs-toggle="modal"
        //                                                 data-bs-target="#updateModal-${data.question.id }">

        //                                                 <span class=""><i
        //                                                         class="bi bi-gear-fill fw-bold fs-3 text-white"></i></span>

        //                                             </button>


        //                                             ${formRadioShow}



        //                                         </div>
        //                                     </div>
        //                                 </div>

        //                                 {{-- modal-update --}}

        //                                 <div class="modal fade " id="updateModal-${data.question.id }" tabindex="-1"
        //                                     aria-labelledby="createExamLabel" aria-hidden="true">
        //                                     <div class="modal-dialog ">
        //                                         <form method="post"
        //                                             action="/admin/question/edit/${data.question.exam_id }/${data.question.id }"
        //                                             class="form-update modal-content d-block">
        //                                             <div class="modal-header">
        //                                                 <h1 class="modal-title fs-5" id="createExamLabel">Nội Dung Câu Hỏi</h1>
        //                                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
        //                                                     aria-label="Close"></button>
        //                                             </div>
        //                                             <div class="modal-body">

        //                                                 <div class="mb-3">
        //                                                     <label for="title" class="col-form-label fw-semibold">Nội Dung Câu
        //                                                         Hỏi:</label>
        //                                                     <div class="form-floating">
        //                                                         <textarea style="height: 100px" class="form-control" name="title" placeholder="Nhập Nội Dung">${data.question.content }</textarea>



        //                                                     </div>


        //                                                 </div>
        //                                                 <div id="error-update-${data.question.id }-title"
        //                                                     class="bg-danger  px-3 mt-2 text-white">
        //                                                 </div>
        //                                                 <div class="mb-3 py-3">

        //                                                     <label for="title" class="col-form-label fw-semibold">Đáp
        //                                                         Án:</label>
        //                                                 </div>


        //                                                 ${formRadioUpdate }






        //                                             </div>
        //                                             <div class="modal-footer">
        //                                                 <button type="button" class="btn btn-secondary"
        //                                                     data-bs-dismiss="modal">Close</button>
        //                                                 <button type="submit" class="btn btn-primary text-white">Cập Nhật Câu
        //                                                     Hỏi</button>
        //                                             </div>

        //                                             @csrf
        //                                         </form>
        //                                     </div>
        //                                 </div>
        //       `)

            //                             // adddtoast


            //                             $("body").append(`


        //                             <div class=" toast my-toast align-items-center position-fixed  text-bg-primary border-0  show fade"
        //                 style="top: 8%;right: 1%;z-index: 88 !important" role="alert" aria-live="assertive" aria-atomic="true"
        //                      data-bs-autohide="true">
        //             <div class="d-flex bg-white text-black">
        //             <div
        //             class="toast-body d-flex align-items-center justify-content-between w-100 bg-success



        // 	          	text-white">
        //             <span> ${response.message} </span> <img class="ms-3" src="public/images/bell.gif" alt="">

        //             <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        //         </div>


        //     </div>

        // </div>
        //                             `)









            //                         }
            //                     },
            //                     error: function(xhr, status, errors) {

            //                         if (JSON.parse(xhr.responseText).success == false) {



            //                             let dataErros = JSON.parse(xhr.responseText).errors;
            //                             let responseErr = JSON.parse(xhr.responseText).data;


            //                             for (let error in dataErros) {

            //                                 $('#' + 'error-update-' + responseErr.question_id +
            //                                         "-" + error)
            //                                     .text(dataErros[error]);


            //                                 console.log(('#' + 'error-update-' + responseErr.question_id +
            //                                     "-" + error))

            //                                 #error - update - 75 - content2
            //                             }




            //                             // error-update-10-content1

            //                         }


            //                     }
            //                 });
            //             });







        });
    </script>
@endsection
