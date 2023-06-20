


setTimeout(() => {
    $(".my-toast.show").removeClass("show");
}, 8000)



$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function uploadthumb(selector, selectorImage) {


    $(selector).on('change', function () {
        var form = new FormData();
        var blobUrl = URL.createObjectURL($(this)[0].files[0]);


        $(selectorImage).attr('src', blobUrl);

    });


}

function removeRow(id, url) {
    $confirm = confirm("Xóa mà không thể khôi phục. Bạn có chắc ?");

    if ($confirm) {
        // console.log(id)
        $.ajax({
            type: "DELETE",
            url: url,
            data: {
                id: Number(id),
            },
            dataType: "JSON",
            success: function (response) {

                if (response.code != 201 || response.code != 200) {

                    alert(response.message);


                    // location.reload();
                    let string = "#row-" + id;
                    $(string).remove();
                    //console.log(typeof response.list_children_deleted);
                    // if (response.list_children_deleted.length > 0) {
                    //     for (let children of response.list_children_deleted) {
                    //         let string2 = "#row-" + children;
                    //         $(string2).remove();
                    //     }
                    // }
                } else {
                    alert("Xóa lỗi :" + response.message);
                }
            },
        });
    }
}


///document-module










// create

function handleCreate(element, link, exam_id) {

    var formData = $(element).closest('.form-create').serializeArray();


    result_form = [];
    formData.forEach(function (item) {
        result_form[item.name] = item.value;
    });


    $.ajax({
        url: link,
        type: 'post',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify({
            ...result_form,
        }),
        success: function (response) {



            // Xử lý phản hồi thành công từ server

            // console.log(response);

            if (response.success == true) {


                $(".form-create [id^='error']").each(function (index, value) {
                    $(value).text("");
                });

                setTimeout(() => {
                    $('.toast.my-toast.show').removeClass("show");
                }, 5000);



                let data = response.data;
                $('.form-create')[0].reset();


                var formRadioShow = data.answer.map(function (answer) {
                    return `<div class="form-check my-2">
          <input class="form-check-input" type="radio"
        name="radio-question-${data.question.id}"
        id="radio-question-${answer.id}" disabled
        ${answer.is_correct == 1 ? 'checked' : ''}>
       <label class="form-check-label"
          for="radio-question-${answer.id}">
        <strong></strong> ${answer.content}
      </label>
       </div>`;
                }).join('');


                let stt = 0;

                let formRadioUpdate = data.answer.map(function (answer) {
                    stt++;
                    return `
                    <div class="mb-2">
                                     <div class="input-group">
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="radio"
                                                        name="is_correct" value="${stt}"
                                                        ${answer.is_correct == 1 ? 'checked' : ''}
                                                        aria-label="Radio button for following text input">
                                                </div>
                                                <input type="text" class="form-control"
                                                    name="content${stt}"
                                                    placeholder="đáp án ${stt}"
                                                    aria-label="Text input with radio button"
                                                    value="${answer.content}">
                                            </div>
                                            <div id="error-update-${data.question.id}-content${stt}"
                                                class="bg-danger  px-3 mt-2 text-white">
                                            </div>

                                            

                                        </div>
                    `;
                }).join('');













                $("#accordionWrapper").prepend(
                    `
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-info text-white  " type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapse${data.question.id}"
                                aria-expanded="true"
                                aria-controls="panelsStayOpen-collapse${data.question.id}">
                                ${data.question.content}

                            </button>


                        </h2>

                        <div id="panelsStayOpen-collapse${data.question.id}"
                            class="accordion-collapse collapse ">
                            <div class="accordion-body ">
                                <button class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#updateModal-${data.question.id}">

                                    <span class=""><i
                                            class="bi bi-gear-fill fw-bold fs-3 text-white"></i></span>

                                </button>
                                <button onclick="
                                            handleDelete(${data.question.id},'/admin/question/delete')
                                          
                                     
                                            " class="px-2 pointer btn btn-danger"><i class="text-white fs-4 fw-bold bi bi-trash-fill "></i></button>


                                ${formRadioShow}
                               


                            </div>
                        </div>
                    </div>

               
                  
                    <div class="modal fade " id="updateModal-${data.question.id}" tabindex="-1"
                        aria-labelledby="createExamLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                            <form 
                                
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
                                            <textarea style="height: 100px" class="form-control" name="title" placeholder="Nhập Nội Dung">${data.question.content}</textarea>



                                        </div>


                                    </div>
                                    <div id="error-update-${data.question.id}-title"
                                        class="bg-danger  px-3 mt-2 text-white">
                                    </div>
                                    <div class="mb-3 py-3">

                                        <label for="title" class="col-form-label fw-semibold">Đáp
                                            Án:</label>
                                    </div>

                                   
                                    ${formRadioUpdate}






                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>

                                    <div
                                    onclick="handleUpdate(this, '/admin/question/edit/${exam_id}/${data.question.id}',${exam_id})"
                                    
                                    class="btn btn-primary text-white">Cập Nhật Câu
                                        Hỏi</div>
                                </div>

                              
                            </form>
                        </div>
                    </div>
`)



                ////close modal




                // adddtoast


                $("body").append(`
                
                
                <div class=" toast my-toast align-items-center position-fixed  text-bg-primary border-0  show fade"
    style="top: 8%;right: 1%;z-index: 999999 !important" role="alert" aria-live="assertive" aria-atomic="true"
         data-bs-autohide="true">
<div class="d-flex bg-white text-black">
<div
class="toast-body d-flex align-items-center justify-content-between w-100 bg-success



      text-white">
<span> ${response.message} </span> <img class="ms-3" src="public/images/bell.gif" alt="">

<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
</div>


</div>

</div>
                `)










            }

            setTimeout(() => {
                $(".my-toast.show").removeClass("show");
            }, 3000)


        },
        error: function (xhr, status, errors) {
            // Xử lý lỗi từ server

            if (JSON.parse(xhr.responseText).success == false) {
                let dataErros = JSON.parse(xhr.responseText).errors;
                // console.log(dataErros)
                $(".form-create [id^='error']").each(function (index, value) {
                    $(value).text("");
                });

                for (let error in dataErros) {

                    $('#' + 'error-' + error).text(dataErros[error]);
                }

            }



        }
    });


}














// update
function handleUpdate(element, link, exam_id) {



    var formData = $(element).closest('.form-update').serializeArray();


    result_form = [];
    formData.forEach(function (item) {
        result_form[item.name] = item.value;
    });



    // Gửi Ajax request
    $.ajax({
        url: link,
        type: 'post',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify({
            ...result_form,
        }),

        success: function (response) {

            if (response.success == true) {
                let data = response.data;



                // $(`updateModal-${data.question.id }`).modal('hide');


                // $('.form-create')[0].reset();

                $(".form-update [id^='error']").each(function (index, value) {
                    $(value).text("");
                });

                var Parent = $('#panelsStayOpen-collapse' + data.question.id)
                    .closest('.accordion-item');





                // console.log(data);
                var formRadioShow = data.answer.map(function (answer) {
                    return `<div class="form-check my-2">
                                 <input class="form-check-input" type="radio"
                               name="radio-question-${data.question.id}"
                               id="radio-question-${answer.id}" disabled
                               ${answer.is_correct == 1 ? 'checked' : ''}>
                              <label class="form-check-label"
                                 for="radio-question-${answer.id}">
                               <strong></strong> ${answer.content}
                             </label>
                              </div>`;
                }).join('');


                let stt = 0;

                var formRadioUpdate = data.answer.map(function (answer) {
                    stt++;
                    return `
                                           <div class="mb-2">
                                                            <div class="input-group">
                                                                       <div class="input-group-text">
                                                                           <input class="form-check-input mt-0" type="radio"
                                                                               name="is_correct" value="${stt}"
                                                                               ${answer.is_correct == 1 ? 'checked' : ''}
                                                                               aria-label="Radio button for following text input">
                                                                       </div>
                                                                       <input type="text" class="form-control"
                                                                           name="content${stt}"
                                                                           placeholder="đáp án ${stt}"
                                                                           aria-label="Text input with radio button"
                                                                           value="${answer.content}">
                                                                   </div>
                                                                   <div id="error-update-${data.question.id}-content${stt}"
                                                                       class="bg-danger  px-3 mt-2 text-white">
                                                                   </div>
                       
                                                               </div>
                                           `;
                }).join('');
















                $(Parent).html(
                    `
                              <div class="accordion-item">
                               <h2 class="accordion-header">
                                           <button class="accordion-button bg-info text-white  " type="button"
                                                       data-bs-toggle="collapse"
                                                       data-bs-target="#panelsStayOpen-collapse${data.question.id}"
                                                       aria-expanded="true"
                                                       aria-controls="panelsStayOpen-collapse${data.question.id}">
                                                       ${data.question.content}
                       
                                                   </button>
                       
                       
                                               </h2>
                       
                                               <div id="panelsStayOpen-collapse${data.question.id}"
                                                   class="accordion-collapse collapse ">
                                                   <div class="accordion-body ">
                                                       <button class="btn btn-warning" data-bs-toggle="modal"
                                                           data-bs-target="#updateModal-${data.question.id}">
                       
                                                           <span class=""><i
                                                                   class="bi bi-gear-fill fw-bold fs-3 text-white"></i></span>
                       
                                                       </button>
                                                       <button onclick="
                                            handleDelete(${data.question.id},'/admin/question/delete')
                                          
                                     
                                            " class="px-2 pointer btn btn-danger"><i class="text-white fs-4 fw-bold bi bi-trash-fill "></i></button>
                       
                       
                                                       ${formRadioShow}
                                                      
                       
                       
                                                   </div>
                                               </div>
                                           </div>
                       
                                          
                       
                                           <div class="modal fade " id="updateModal-${data.question.id}" tabindex="-1"
                                               aria-labelledby="createExamLabel" aria-hidden="true">
                                               <div class="modal-dialog ">
                                                   <form 
                                                      
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
                                                                   <textarea style="height: 100px" class="form-control" name="title" placeholder="Nhập Nội Dung">${data.question.content}</textarea>
                       
                       
                       
                                                               </div>
                       
                       
                                                           </div>
                                                           <div id="error-update-${data.question.id}-title"
                                                               class="bg-danger  px-3 mt-2 text-white">
                                                           </div>
                                                           <div class="mb-3 py-3">
                       
                                                               <label for="title" class="col-form-label fw-semibold">Đáp
                                                                   Án:</label>
                                                           </div>
                       
                                                          
                                                           ${formRadioUpdate}
                       
                       
                       
                       
                       
                       
                                                       </div>
                                                       <div class="modal-footer">
                                                           <button type="button" class="btn btn-secondary"
                                                               data-bs-dismiss="modal">Close</button>
                                                               <div class="btn-update btn btn-primary text-white"
                                                               onclick="handleUpdate(this, '/admin/question/edit/${exam_id}/${data.question.id}',${exam_id})"
                                                               
                                                               >
                                                               Cập Nhật Câu Hỏi
                                                           </div>
                                                       </div>
                       
                                               
                                                   </form>
                                               </div>
                                           </div>
                       `)

                // adddtoast


                $("body").append(`
                                       
                                       
                                       <div class=" toast my-toast align-items-center position-fixed  text-bg-primary border-0  show fade"
                           style="top: 8%;right: 1%;z-index: 999999 !important" role="alert" aria-live="assertive" aria-atomic="true"
                                data-bs-autohide="true">
                       <div class="d-flex bg-white text-black">
                       <div
                       class="toast-body d-flex align-items-center justify-content-between w-100 bg-success
                       
                       
                       
                             text-white">
                       <span> ${response.message} </span> <img class="ms-3" src="public/images/bell.gif" alt="">
                       
                       <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                       </div>
                       
                       
                       </div>
                       
                       </div>
                `)


            }
            setTimeout(() => {
                $(".my-toast.show").removeClass("show");
            }, 3000)
        },
        error: function (xhr, status, errors) {
            // Xử lý lỗi từ server
            if (JSON.parse(xhr.responseText).success == false) {



                let dataErros = JSON.parse(xhr.responseText).errors;
                let responseErr = JSON.parse(xhr.responseText).data;

                console.log(dataErros);
                console.log(responseErr);

                for (let error in dataErros) {


                    $(element).closest('.form-update').find('#' + 'error-update-' + responseErr.question_id +
                        "-" + error)
                        .text(dataErros[error]);




                    console.log()
                }




                // error-update-10-content1

            }


            // console.log(dataErr.success)
            // console.log(errors.responseText.errors);
            // Hiển thị thông báo lỗi
            // alert('Đã xảy ra lỗi! Vui lòng thử lại.');

            // Thực hiện các hành động khác (nếu cần)
        }



    })
}





////delete




function handleDelete(id, link) {
    removeRow(id, link);

    location.reload()

}




////change radio

function changeRadio(element, question, list_answer) {


    // event.preventDefault();

    let data = {
        question_id: $(this).attr("name").split('-')[1],
        value: $(this).val(),



    }

    let exam = JSON.parse(localStorage.getItem("exam")) || [];

    // console.log(exam);

    const filterExam = [...exam].filter((val) => {
        // console.log(data.question_id);
        // console.log(val.question_id);
        return val.question_id == data.question_id
    });




    if (filterExam.length <= 0) {
        exam.push(data);

        localStorage.setItem("exam", JSON.stringify(exam));
        $(".progress_exam").text(exam.length + 1);


        // let question_wrapper = $(`#question-result-${data.question_id}`)




        // return

        // let str = 0;











        // let radios = $(`#question-result-${data.question_id} input`).each(function(i, val) {



        // });






    } else {
        let index = [...exam].findIndex((val) => {
            return val.question_id == data.question_id
        });
        exam.splice(index, 1);
        exam.push(data);



        localStorage.setItem("exam", JSON.stringify(exam));
    }
















    // localStorage.setItem("exam", [{JSON.stringify(data)]);








    // var selectedValue = $(this).val();

    // $.ajax({
    //     url: `/exam/update/${data.name}`,
    //     dataType: 'json',
    //     contentType: 'application/json',
    //     method: 'post',
    //     data: JSON.stringify(
    //         data
    //     ),

    //     success: function(response) {
    //         // Xử lý phản hồi từ máy chủ (nếu cần)
    //     },
    //     error: function(xhr, status, error) {
    //         // Xử lý lỗi (nếu có)
    //     }
    // });
};







