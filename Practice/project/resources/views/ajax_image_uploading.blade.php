<!DOCTYPE html>
<html>
<head>
    <title>Ajax Image Upload with Laravel</title>
</head>
<body style="background: lightgrey">
<center>
    <br/><br/>
    <div style="width:350px;height: 350px; border: 1px solid whitesmoke ;text-align: center;position: relative" id="image">
        <img width="100%" height="100%" id="preview_image" src="{{asset('images/noimage.jpg')}}"/>
        <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
    </div>
    <p>
        <a href="javascript:changeProfile()" style="text-decoration: none;">
            <i class="glyphicon glyphicon-edit"></i> Change
        </a>&nbsp;&nbsp;
        <a href="javascript:removeFile()" style="color: red;text-decoration: none;">
            <i class="glyphicon glyphicon-trash"></i>
            Remove
        </a>
    </p>
    <input type="file" id="file" style="display: none"/>
    <input type="hidden" id="file_name"/>
</center>
<!-- JavaScripts -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/2c7a93b259.js"></script>
<script>
    function changeProfile() {
        $('#file').click();
    }
    $('#file').change(function () {
        if ($(this).val() != '') {
            upload(this);

        }
    });
    function upload(img) {
        var form_data = new FormData();
        form_data.append('file', img.files[0]);
        form_data.append('_token', '{{csrf_token()}}');
        $('#loading').css('display', 'block');
        $.ajax({
            url: "{{url('ajax-image-upload')}}",
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.fail) {
                    $('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
                    alert(data.errors['file']);
                }
                else {
                    $('#file_name').val(data);
                    $('#preview_image').attr('src', '{{asset('uploads')}}/' + data);
                }
                $('#loading').css('display', 'none');
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
                $('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
            }
        });
    }
    function removeFile() {
        if ($('#file_name').val() != '')
            if (confirm('Are you sure want to remove profile picture?')) {
                $('#loading').css('display', 'block');
                var form_data = new FormData();
                form_data.append('_method', 'DELETE');
                form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: "ajax-remove-image/" + $('#file_name').val(),
                    data: form_data,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
                        $('#file_name').val('');
                        $('#loading').css('display', 'none');
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            }
    }
</script>{{ Html::link_to_action('ImageController@hello','hello') }}

<a href="" >



call_hello_function

</a>
</body>
</html>
<!-- 10+10+120+10+360+5+360+300+30+10+240+480+120+120+180+5+10+120+540+60+10+300+360+30+960+5+5+180+240+240+120+5 -->