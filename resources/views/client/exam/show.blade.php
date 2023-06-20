@extends('client.layout_main')


@section('content')
    <style>
        @media (min-width: 768px) and (max-width: 1023px) {}

        @media (max-width: 767px) {



            .exam-header {
                font-size: 13px !important;

            }

            .exam-header .item__title {
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .exam-header .item {
                padding: 8px 8px !important;
            }

            .exam-header .item lord-icon {
                width: 45px !important;
                height: 45px !important;
            }

            .main__content {
                padding-top: 5px !important;
                padding-bottom: 5px !important;
            }

            .main__content .item__question {
                font-size: 15px !important;
            }

            .main__content .item {
                line-height: 1.2 !important;
                font-size: 13px !important;

            }

            .main__content .main__send {
                top: 125% !important;
                left: 50% !important;
                transform: translateX(-50%);
            }



        }
    </style>


    <section class="exam-bg position-fixed top-0 start-0  w-100 h-100 z-0 ">

        <img src=" {{ asset('client/public/images/exam.jpg') }}" style="filter: blur(4px)"
            class=" w-100  top-0 w-100 position-relative  d-block object-fit-cover h-100 text-center" alt="">
    </section>


    <section class="exam-header mt-3  position-relative z-1">
        <div class="row justify-content-between">
            <div class="col-4 col-sm-3">
                <div class="item rounded-3 bg-white d-flex align-items-center flex-column px-2 py-3">
                    <div class="item__img">
                        <lord-icon src="https://cdn.lordicon.com/ajkxzzfb.json" trigger="loop"
                            colors="primary:#ffc738,secondary:#4bb3fd" style="width:60px;height:60px">
                        </lord-icon>
                    </div>
                    <div class="item__title text-uppercase z-3 fw-bold" style="color:var(--c__black-secondary) !important">
                        LÝ Thế Vinh
                    </div>
                </div>
            </div>
            <div class="col-4 col-sm-3">
                <div class="item rounded-3 bg-white d-flex align-items-center flex-column px-2 py-3">
                    <div class="item__img">
                        <lord-icon src="https://cdn.lordicon.com/mgmiqlge.json" trigger="loop"
                            colors="primary:#3a3347,secondary:#f24c00,tertiary:#4bb3fd,quaternary:#ebe6ef"
                            style="width:60px;height:60px">
                        </lord-icon>
                    </div>
                    <div class="item__title text-uppercase z-3 fw-bold " style="color:var(--c__black-secondary) !important">



                        <span class="exam-time" data-time={{ $questions[0]->exam->time }}>
                            {{ $questions[0]->exam->time }}</span>


                    </div>
                </div>
            </div>

            <div class="col-4 col-sm-3">
                <div class="item rounded-3 bg-white d-flex align-items-center flex-column px-2 py-3">
                    <div class="item__img">
                        <lord-icon src="https://cdn.lordicon.com/ckatldkn.json" trigger="loop"
                            colors="primary:#646e78,secondary:#08a88a,tertiary:#ebe6ef" style="width:60px;height:60px">
                        </lord-icon>
                    </div>
                    <div class="item__title text-uppercase z-3 fw-bold" style="color:var(--c__black-secondary) !important">



                        <span class="my-text-orange"><span class="progress_exam"></span>/{{ $questions->total() }}</span>
                    </div>
                </div>
            </div>


        </div>

    </section>


    <section class="exam-main position-relative z-1 mt-3 ">

        <div class="main__header px-3 py-3 z-3 fs-15 fw-semibold bg-white  rounded-4"
            style="background-color: var(--c__orange) !important;">
            {{ $title }}
        </div>

        <div class="main__content position-relative px-3 py-4 z-3 bg-white  mt-3 rounded-2  " style="color: #2e2e2e;">
            <form>

                @foreach ($questions as $question)
                    <div class="item mt-1">
                        <div class="item__question py-2 fw-bold" style="font-size: 18px;">
                            {{ $question->content }}
                        </div>
                        <div class="item__result px-4" id="question-result-{{ $question->id }}">
                            @php
                                $str = 0;
                            @endphp
                            @foreach ($question->answers as $answer)
                                @php
                                    $str++;
                                @endphp
                                <div class="form-check py-1">
                                    <input class="form-check-input" type="radio" name="question-{{ $question->id }}"
                                        value="{{ $str }}"
                                        onchange="changeRadio(this, '{{ $question }}', '{{ $question->answers }}','{{ $question->exam->time }}')">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ $answer->content }}
                                    </label>
                                </div>
                            @endforeach


                        </div>
                    </div>
                @endforeach

                <div class="main__send  btn position-absolute my-bg-orange text-white d-flex align-items-center mt-4 mt-sm-0"
                    style="top:105%" id="finish_exam" data-exam={{ $questions[0]->exam->id }}>
                    <span>
                        <lord-icon src="https://cdn.lordicon.com/kofdvwty.json" trigger="loop"
                            colors="primary:#ffc738,secondary:#4bb3fd" style="width:35px;height:35px">
                        </lord-icon>
                        </lord-icon>
                    </span> <span class="ms-2"> Nộp Bài</span>
                </div>
            </form>


        </div>


        <div class="main__pagination mt-3 ">


            <div class="d-flex mt-5  justify-content-center"> {{ $questions->links() }}</div>
        </div>


    </section>
@endsection



@section('js')
    <script>
        if (JSON.parse(sessionStorage.getItem("exam"))) {
            $(".progress_exam").text(JSON.parse(sessionStorage.getItem("exam")).length);
        } else {
            $(".progress_exam").text("0")
        }

        let list_question_id = [];
        $(".item__result").each(function(index, value) {
            list_question_id.push($(value).attr("id").split('-')[2]);
        });

        let exam = JSON.parse(sessionStorage.getItem("exam")) || [];
        let filterExam = [];

        for (let i = 0; i < exam.length; i++) {
            if (list_question_id.includes(exam[i].question_id)) {
                filterExam.push(exam[i].question_id);
            }
        }

        $(".item__result").each(function(index, value) {
            let questions_id = $(value).attr("id").split('-')[2];

            if (filterExam.length <= 0) {
                return;
            } else {
                if (filterExam.includes(questions_id)) {
                    findValue = [...exam].find((val) => {
                        return val.question_id == questions_id;
                    });

                    $(value).find("input").each((index, radio) => {
                        $(radio).removeAttr("checked");

                        if ($(radio).val() == findValue.value) {
                            $(radio).attr("checked", true);
                        }
                    });
                }
            }
        });

        function changeRadio(element, question, list_answer, time) {
            let answers_radio = JSON.parse(list_answer);
            let question_radios = JSON.parse(question);

            let data = {
                question_id: $(element).attr("name").split('-')[1],
                value: $(element).val(),
            };

            let exam = JSON.parse(sessionStorage.getItem("exam")) || [];

            const filterExam = [...exam].filter((val) => {
                return val.question_id == data.question_id;
            });

            if (filterExam.length <= 0) {
                exam.push(data);

                sessionStorage.setItem("exam", JSON.stringify(exam));



                $(".progress_exam").text(JSON.parse(sessionStorage.getItem("exam")).length);
            } else {
                let index = [...exam].findIndex((val) => {
                    return val.question_id == data.question_id;
                });
                exam.splice(index, 1);
                exam.push(data);

                sessionStorage.setItem("exam", JSON.stringify(exam));
                console.log(JSON.parse(sessionStorage.getItem("exam")).length);
                $(".progress_exam").text(JSON.parse(sessionStorage.getItem("exam")).length);

            }
        }

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });



        $("#finish_exam").click(function() {
                let data = JSON.parse(sessionStorage.getItem("exam"));
                console.log(data);

                // if (data == null) {


                //     confirm("Bạn Chưa làm câu nào cả, hãy làm ít nhất 1 câu")



                //     location.reload();

                // } else {
                // alert("ádaasd")


                $.ajax({
                    url: `/exam/submit/` + $(this).attr("data-exam"),
                    dataType: 'json',
                    contentType: 'application/json',
                    method: 'post',
                    data: JSON.stringify(
                        data
                    ),

                    success: function(response) {
                        // console.log("data", response.data.history)
                        let data = response.data.history;
                        location.href = "/exam/show_result/" + data.id;





                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi (nếu có)
                    }
                });
            }



            // }

        )


        if (sessionStorage.getItem("time_exam") <= 1 || !sessionStorage.getItem("time_exam")) {

            let timeEle = $(".exam-header .exam-time");
            let getFirstTime = Number(timeEle.attr("data-time"));

            const initialTime = getFirstTime;
            sessionStorage.setItem("time_exam", initialTime);
        }

        if (sessionStorage.getItem("time_exam")) {
            setInterval(countdown, 1000);
        }

        function countdown() {
            let timeEle = $(".exam-header .exam-time");
            let time = Number(sessionStorage.getItem("time_exam"));

            if (time > 0) {
                time--;
                sessionStorage.setItem("time_exam", time);
                timeEle.text(time); // Hiển thị thời gian còn lại
            } else {

                $("#finish_exam").click();

                // return;
                // // location.reload();


                // mai sua



            }
        }

        // Gọi hàm đếm ngược khi trang được tải lần đầu



        // var intervalID = setInterval(() => {
        //         let time = Number(sessionStorage.getItem("time_exam"));




        //         // let result_time = Number(sessionStorage.getItem("time_exam")) - 1

        //         timeEle.text(result_time);

        //         if (result_time == 0) {

        //             clearInterval(intervalID);

        //             $("#finish_exam").click();
        //             return;


        //         }


        //     },
        //     1000);
    </script>
@endsection
