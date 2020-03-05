$(document).ready(function () {
    $('#new_pwd').click(function () {
        var currentpassword = $('#current_pwd').val();
        $ajax({
            type: 'get',
            url: 'admin/checkpass',
            data: {current_pwd: current_pwd},
            success: function (resp) {
                //alert('resp');
                if (resp = "false") {
                    $('#chkPwd').html("<font color='red'>CurrentPassword is incorrect</font>");
                } else (resp = "true")
                {
                    $('#chkPwd').html("<font color='green'>CurrentPassword is correct</font>");
                }
            }, error: function () {
                alert('Error');
            }
        })
    });
});
