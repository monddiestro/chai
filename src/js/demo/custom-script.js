$('#newMember').on('click',function() {
    var unit_id = $(this).find('.unit_id').val();
    $('#unit_id').val(unit_id);
});