// Call the dataTables jQuery plugin
$('input[name="user_image"]').on('change',function() {
    var image_preview = $(this).closest('.modal-content').find('#imagePreview');
    readURL(this,image_preview);
});
$('input[name="car_image"]').on('change',function() {
    var image_preview = $(this).closest('.modal-content').find('#imagePreview');
    readURL(this,image_preview);
});

function readURL(input,image_preview) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(image_preview).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}