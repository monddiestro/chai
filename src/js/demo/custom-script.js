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
    var work_id = $(this).val();
    var sel = $(this).closest('.modal-body').find('#helper_id');
    $.ajax({
        url: base_url + "request/pull_available_helpers/",
        type: "POST",
        data: { 'work_id':work_id },
        success: function(data) {
            sel.html(data);
            $('.selectpicker').selectpicker('refresh');
        }
    })
});

$('#btnChangePwd').on('click',function(){
    $('#currentPwd').prop('disabled',false);
    $(this).hide()
    $('#changePwd').show();
});

// set interval value to 0
var _changeInterval = null;

$('#currentPwd').on('keyup', function() {
    var current = $(this).val();
    var obj = $(this);
    var user_id = $('#user_id').val();
    // clear interval to avoid infinite loop
    clearInterval(_changeInterval);
    _changeInterval = setInterval(function() {
        // after typing with 1 second interval pull data through ajax
        clearInterval(_changeInterval);
        checkPassword(current,user_id,obj);
    }, 100);
});
// function to check password using ajax
function checkPassword(current, user_id,obj) {
    $.ajax({
        url: base_url + "admin/check_password/",
        type: "POST",
        data: { 'current': current, 'user_id': user_id },
        success: function(data) {
            if(data == "1") {
                obj.addClass('is-valid');
                obj.removeClass('is-invalid');
                $('#passwordFeedback').addClass('valid-feedback');
                $('#passwordFeedback').removeClass('invalid-feedback');
                $('#passwordFeedback').html('Password match!');
                $('#newPassword').show();
            } else {
                obj.addClass('is-invalid');
                obj.removeClass('is-valid');
                $('#passwordFeedback').addClass('invalid-feedback');
                $('#passwordFeedback').removeClass('valid-feedback');
                $('#passwordFeedback').html('Password did not match!');
                $('#newPassword').hide();
            }
        }
    });
}

$('#confirm_password').on('keyup',function(){
    var new_pwd = $('#new_password').val();
    var obj = $(this);
    var confirm_pwd = $(this).val();
    // clear interval to avoid infinite loop
    clearInterval(_changeInterval);
    _changeInterval = setInterval(function() {
        // after typing with 1 second interval pull data through ajax
        clearInterval(_changeInterval);
        checkMatchPassword(new_pwd,confirm_pwd,obj);
    }, 100);
});

function checkMatchPassword(new_pwd,confirm_pwd,obj) {
    if(new_pwd == confirm_pwd) {
        obj.addClass('is-valid');
        obj.removeClass('is-invalid');
        $('#confirmFeedback').removeClass('invalid-feedback').addClass('valid-feedback').html('Password match!');
        $('#btnSave').prop('disabled',false);
    } else {
        obj.addClass('is-invalid');
        obj.removeClass('is-valid');
        $('#confirmFeedback').removeClass('valid-feedback').addClass('invalid-feedback').html('Password did not match!');
        $('#btnSave').prop('disabled',true);
    }
}

$('#btnCancel').on('click',function(){
    resetInputs();
});

function resetInputs() {
    $('#btnChangePwd').show();
    $('#changePwd,#newPassword').hide();
    $('#new_password').val('');
    $('#confirm_password').val('');
    $('#currentPwd').val('');
    $('#currentPwd').prop('disabled',true);
    $('#btnSave').prop('disabled',true);
    $('#currentPwd,#new_password,#confirm_password').removeClass('is-invalid').removeClass('is-valid');
    $('#passwordFeedback,#confirmFeedback').hide();
    
}

$('#btnSave').on('click',function(){
    var pwd = $('#confirm_password').val();
    var user_id = $('#user_id').val();
    $.ajax({
        url: base_url + 'admin/api_password_update/',
        type: "POST",
        data: { 
            'password': pwd,
            'user_id': user_id
        },
        success: function(data) {
            $('#successPassword').show();
            $('#btnCancel').click();
        }
    });
});



