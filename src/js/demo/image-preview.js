// Call the dataTables jQuery plugin
$('#btnSelectImage').on('change',function() {
    var image_preview = $('#imagePreview');
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