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
            var opt = '<option value="" hidden>Select Car Owner</option>' + data;
            sel.html(opt);
         }
    });
});