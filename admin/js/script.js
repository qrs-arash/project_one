
$(document).ready(function () {



    if ($('#body').length > 0) {
        ClassicEditor
            .create(document.querySelector('#body'));

    }

    $('#selectAllBoxes').click(function (e) {
        if (this.checked) {
            $('.checkBoxes').each(function () {
                this.checked = true;
            })
        } else {
            $('.checkBoxes').each(function () {
                this.checked = false;
            })
        }
    });
    var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    $('body').prepend(div_box);
    $('#load-screen').delay(500).fadeOut(200, function () {
        $(this).remove();
    });


});

function loadUsersOnline(){
    $.get("function.php?onlineusers=result",function(data){
        $(".useronline").text(data);
    });
}
setInterval(function(){
    loadUsersOnline();
},500);
