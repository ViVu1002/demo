$(document).ready(function () {
    const URL = "http://127.0.0.1:8000";
    $('body').on('click', '#edit-post', function () {
        var id = $(this).data('id');
        $.get(URL + `/person/${id}` + `/edit`, function (data) {
            $("#postCrudModal").html("Edit student");
            $('#btn-save').val("edit-post");
            $("#ajax-crud-modal").modal('show');
            $("#id").val(data.id);
            $("#name").val(data.name);
            $("#email").val(data.email);
            $(".radio:checked").val(data.gender);
            $("#address").val(data.address);
            $("#phone").val(data.phone);
            $("#faculty_id").val(data.faculty_id);
            $("#date").val(data.date);
            $("#file").attr('src', data.image);
            $("#slug").val(data.slug);
        });
    });

    $("#editForm").on('submit', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: URL + `/person/` + $("#editForm input[name=id]").val(),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.errors) {
                    console.log(data);
                    $('#message').css('display', 'block');
                    $.each(data, function (key, value) {
                        $("#message").find("ul").append('<li>' + value + '</li>');
                    });
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);
                }
                if (data.success) {
                    console.log(data);
                    alert('Update success');
                    $('#ajax-crud-modal').modal('hide');
                    location.reload();
                }
            },
        });
    });
});