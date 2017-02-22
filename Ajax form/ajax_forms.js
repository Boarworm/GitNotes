$(document).ready(function () {
    $("#ajaxform").submit(function () {
        var form = $(this);
        var error = false;
        if (!error) {
            var data = form.serialize();
            $.ajax({
                type: 'POST',
                url: '/ajax_forms.php',
                dataType: 'json',
                data: data,
                success: function (data) {
                    if (data['error']) {
                        console.log(data['error']);
                    } else {
                        console.log('Отправлено успешно');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
        return false;
    });
});