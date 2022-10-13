
$('#imageInput').on('change', function () {
    var file = "";
    var arrLength = $(this).prop('files');
    file += "<ul>";
    for (var i=0; i<arrLength.length; i++){
      file += "<li>"
      file += $(this).prop('files')[i].name;
      file += "</li>";
    }
    file += "</ul>";
    
    $('#fileSelected').html(file);
});