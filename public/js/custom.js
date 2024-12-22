"use strict";

$('form.frm-submit-data').on('submit', function (e) {
    var $this = $(this);
    e.preventDefault();
    var btn = $this.find('[type="submit"]');
    $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function () {
            button(btn,'loading');
        },
        success: function (data) {
            button(btn,'reset');
            $('.error').html("");
            if (data.status == "fail") {
                $.each(data.error, function (index, value) {
                    $this.find("[name='" + index + "']").addClass('is-invalid').after("<div class='invalid-feedback'>" + value + '</div>');

                    show_toastr('Error', value, 'error')
                });

                button(btn,'reset');
            } else {
                if (data.url) {
                    location.reload(true);
                } else if (data.status == "access_denied") {
                    window.location.href = base_url + "dashboard";
                } else {
                    location.reload(true);
                }
            }
        },
        error: function () {
            button(btn,'reset');
        }
    });
});


$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

var site_url = $('meta[name="base-url"]').attr("content");

$(document).ready(function () {
    comman_function();

    if ($(".dataTable-desc").length > 0) {
        $(".dataTable-desc").DataTable({
            order: [[3, "desc"]],
        });
    }

    if ($(".dataTable").length > 0) {
        $(".dataTable").DataTable();
    }

    if ($(".dataTable2").length > 0) {
        $(".dataTable2").DataTable();
    }

    if ($(".dataTable3").length > 0) {
        $(".dataTable3").DataTable();
    }

    if ($(".dataTable4").length > 0) {
        $(".dataTable4").DataTable();
    }

    if ($(".dataTable-5").length > 0) {
        $(".dataTable-5").DataTable({
            pageLength : 5,
          });
    }
});
$(document).ready(function () {
    var table = $(".dataTable1").DataTable({
        lengthChange: false,
        buttons: ["copy", "excel", "pdf", "print"],
    });

    table
        .buttons()
        .container()
        .appendTo("#DataTables_Table_0_wrapper .col-md-6:eq(0)");
});

$(document).on("input", ".autogrow", function () {
    $(this)
        .height("auto")
        .height($(this)[0].scrollHeight - 18);
});

$(document).on("click",'a[data-ajax-popup="true"], button[data-ajax-popup="true"], div[data-ajax-popup="true"]',
    function () {
        var title = $(this).data("title");
        var size = $(this).attr("data-size") == "" ? "md" : $(this).attr("data-size");
        var url = $(this).data("url");

        $("#commanModel .modal-title").html(title);
        $("#commanModel .modal-dialog").removeClass("modal-lg").removeClass("modal-md").removeClass("modal-sm");
        $("#commanModel .modal-dialog").addClass("modal-" + size);

        $.ajax({
            url: url,
            success: function (data) {
                $("#commanModel .extra").html(data);
                $("#commanModel").modal("show");

                $("#theme_id").trigger("change");

                // Product Page
                $("#enable_product_variant").trigger("change");
                $("#variant_tag").trigger("change");
                $("#maincategory").trigger("change");

                // Review Page
                $("#category_id").trigger("change");

                // coupone Code Page
                $(".code").trigger("click");
                comman_function();
                flat_picker();

                if ($(".multi-select").length > 0) {
                    $($(".multi-select")).each(function (index, element) {
                        var id = $(element).attr("id");
                        var multipleCancelButton = new Choices("#" + id, {
                            removeItemButton: true,
                        });
                    });
                }

                if ($(".dataTable").length > 0) {
                    $(".dataTable").DataTable();
                }

            },
            error: function (data) {
                data = data.responseJSON;
            },
        });


    }
);

function flat_picker() {

    var today = new Date();
    var cuur_time = today.getHours() + ":" + today.getMinutes();

    $("#due_date").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d h:i:s",
        mode: "range",
        locale: {
            firstDayOfWeek: 7, // set start day of week to Sunday
        },
        time_24hr: true,
        minDate: today,
        onChange: function (selectedDates, dateStr, instance) {},
    });

    $("#timesheet_date").flatpickr({
        dateFormat: "d-m-Y",
        locale: {
            firstDayOfWeek: 7, // set start day of week to Sunday
        },

        maxDate: today,

        onChange: function (selectedDates, dateStr, instance) {},
    });

    $(".single-date").flatpickr({
        enableTime: true,
        dateFormat: "d-m-Y h:i:s",
        time_24hr: true,
        onChange: function (selectedDates, dateStr, instance) {},
    });
}
function multi_select() {
    if ($(".select2").length > 0) {
        $($(".select2")).each(function (index, element) {
            var id = $(element).attr("id");
            var multipleCancelButton = new Choices("#" + id, {
                removeItemButton: true,
            });
        });
    } else {
    }
}

$(document).on("click", ".bs-pass-para", function () {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
    });
    swalWithBootstrapButtons
        .fire({
            title: $(this).data("confirm"),
            text: $(this).data("text"),
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            reverseButtons: false,
        })
        .then((result) => {
            if (result.isConfirmed) {
                $("#" + $(this).data("confirm-yes")).trigger("submit");
            } else if (result.dismiss === Swal.DismissReason.cancel) {
            }
        });
});

function comman_function() {
    if ($('[data-role="tagsinput"]').length > 0) {
        $('[data-role="tagsinput"]').each(function (index, element) {
            var obj_id = $(this).attr("id");
            var textRemove = new Choices(document.getElementById(obj_id), {
                delimiter: ",",
                editItems: true,
                removeItemButton: true,
            });
        });
    }
}

function show_toastr(title, message, type) {
    var o, i;
    var icon = "";
    var cls = "";
    if (type == "success") {
        var audio = $('#success-audio')[0];
        console.log(audio)
            if (audio !== undefined) {
                audio.play();
            }
        cls = "primary";
        notifier.show(
            "Success",
            message,
            "success",
            site_url + "/public/assets/images/notification/ok-48.png",
            4000
        );
    } else {
        var audio = $('#error-audio')[0];
            if (audio !== undefined) {
                audio.play();
            }
        cls = "danger";
        notifier.show(
            "Error",
            message,
            "danger",
            site_url +
                "/public/assets/images/notification/high_priority-48.png",
            4000
        );
    }
}

PurposeStyle = function () {
    var e = getComputedStyle(document.body);
    return {
        colors: {
            gray: {
                100: "#f6f9fc",
                200: "#e9ecef",
                300: "#dee2e6",
                400: "#ced4da",
                500: "#adb5bd",
                600: "#8898aa",
                700: "#525f7f",
                800: "#32325d",
                900: "#212529",
            },
            theme: {
                primary: e.getPropertyValue("--primary")
                    ? e.getPropertyValue("--primary").replace(" ", "")
                    : "#6e00ff",
                info: e.getPropertyValue("--info")
                    ? e.getPropertyValue("--info").replace(" ", "")
                    : "#00B8D9",
                success: e.getPropertyValue("--success")
                    ? e.getPropertyValue("--success").replace(" ", "")
                    : "#36B37E",
                danger: e.getPropertyValue("--danger")
                    ? e.getPropertyValue("--danger").replace(" ", "")
                    : "#FF5630",
                warning: e.getPropertyValue("--warning")
                    ? e.getPropertyValue("--warning").replace(" ", "")
                    : "#FFAB00",
                dark: e.getPropertyValue("--dark")
                    ? e.getPropertyValue("--dark").replace(" ", "")
                    : "#212529",
            },
            transparent: "transparent",
        },
        fonts: { base: "Nunito" },
    };
};

var PurposeStyle = PurposeStyle();

/********* Cart Popup ********/
$(".wish-header").on("click", function (e) {
    e.preventDefault();
    setTimeout(function () {
        $("body").addClass("no-scroll wishOpen");
        $(".overlay").addClass("wish-overlay");
    }, 50);
});

$("body").on("click", ".overlay.wish-overlay, .closewish", function (e) {
    e.preventDefault();
    $(".overlay").removeClass("wish-overlay");
    $("body").removeClass("no-scroll wishOpen");
});

if ($(".multi-select").length > 0) {
    $($(".multi-select")).each(function (index, element) {
        var id = $(element).attr("id");
        var multipleCancelButton = new Choices("#" + id, {
            removeItemButton: true,
        });
    });
}

function image_upload_bar(type = "") {

    $("#progressContainer").css('display', '')
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    const resultDiv = document.getElementById('result');

    let progress = 0;
    let interval = 20; // Change from const to let

    if (type == 'pdf' || type == 'php' ||type == 'word' ) {
        interval = 100; // Adjust the interval duration for the desired animation speed
    }
    if (type == 'zip') {
        interval = 400;

    }


    function simulateUpload() {
        if (progress <= 100) {
            progressBar.value = progress;
            progressText.textContent = progress.toFixed(2) + '%';
            progress += 5; // Simulate progress increase

            setTimeout(simulateUpload, interval);
        } else {
            resultDiv.textContent = 'Simulation completed';
        }
    }

    simulateUpload(); // Start the simulation when the page loads
}

$(document).on("click", ".bs-pass-para-user-delete", function () {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
    });
    swalWithBootstrapButtons
        .fire({
            title: $(this).data("confirm"),
            text: $(this).data("text"),
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            reverseButtons: false,
        })
        .then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire({
                    title:'Please Comfirm Action',
                    input: 'text',
                    inputLabel:'What action you want to perform?',
                    inputPlaceholder: 'Delete',
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    reverseButtons: false,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        if($('#swal2-input').val()=='delete' || $('#swal2-input').val()=='Delete' || $('#swal2-input').val()=='DELETE')
                        {
                            $("#" + $(this).data("confirm-yes")).trigger("submit");
                        }
                        else{
                            alert('Your Defined Action Is Invalid.')
                        }
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                    }
                });

            } else if (result.dismiss === Swal.DismissReason.cancel) {
            }
        });
});

var i = 2;

$('#addAgrement').click(function() {
    var count = $(this).attr('data-count');
    count++;
    var html = `
    <div class="agrement_row"> 
   
    <div class="form-group">
         <div class="row">
                <div class="col-sm-1 col-md-offset-2">
                    <input type="text" class="form-control" placeholder="" value="`+count+`" readonly>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="form-control " id="file" name="points[]" placeholder="" value="">
                    <span id="file_msg" style="display:none" class="text-danger"></span>
                </div>
                <div class="col-sm-1">
                    <button class="btn btn-danger pull-right removeRow" type='button'><i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
    `
    i++;
    $(this).attr('data-count',count)
    $('#AgrementArea').append(html);
})

$(document).on('click', '.removeRow', function() {
    $(this).closest('.agrement_row').remove();
});


function button(btn,status){
    const text  =  btn.text();
    if(status=='loading'){
        btn.attr('disabled','disabled')
        btn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"> </span> `+text)
    }
    else{
        btn.html('')
        btn.removeAttr('disabled','disabled')
        btn.html(text)
    }
   
}



