// update base_url 
var base_url = "http://localhost/toteng/";
$('#newMember').on('click',function() {
    var unit_id = $(this).find('.unit_id').val();
    $('#unit_id').val(unit_id);
});
$("select[name='unit_id']").on('change',function(){
    var unit_id = $(this).val();
    var sel = $(this).closest('.modal-content').find('select[name="member_id"]')
    $.ajax({
         url: base_url + 'admin/unit_members/',
         type: "POST",
         data: { 'unit_id' : unit_id },
         success: function(data) {
            var opt = data;
            sel.html(opt);
            $('.selectpicker').selectpicker('refresh');
         }
    });
});
$('input[name="current"]').keyup(function() {
    var current = $(this).val();
    var user_id = $(this).closest('.modal-body').find('input[name="user_id"]').val();
    var object = $(this);
    var new_pass = $(this).closest('.modal-body').find('input[name="new"]');
    var confirm = $(this).closest('.modal-body').find('input[name="confirm"]');
    $.ajax({
        url: base_url + "admin/check_password/",
        type: "POST",
        data: { 'current': current, 'user_id': user_id },
        success: function(data) {
            if(data == '1') {
                object.removeClass('is-invalid');
                object.addClass('is-valid');
                new_pass.prop('disabled', false);
                confirm.prop('disabled', false);
            } else {
                object.removeClass('is-valid');
                object.addClass('is-invalid');
                new_pass.prop('disabled', true);
                confirm.prop('disabled', false);
            }
        }
    });
});

$('input[name="confirm"]').keyup(function () {
    var confirm = $(this).val();
    var new_pass = $(this).closest('.modal-body').find('input[name="new"]').val();
    if(confirm == new_pass) {
        $(this).closest('.modal-content').find('.btn-primary').prop('disabled',false);
    } else {
        $(this).closest('.modal-content').find('.btn-primary').prop('disabled',true);
    }
});

$('#newRequestModal #work_id').on('change',function() {
    // var work_id = $(this).val();
    // var sel = $(this).closest('.modal-body').find('#helper_id');
    // $.ajax({
    //     url: base_url + ""
    // })
});
