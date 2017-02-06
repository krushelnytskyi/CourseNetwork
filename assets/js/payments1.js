$(document).ready(function() {
        $("#content1 div").hide(); // Скрытое содержимое
        $("#tabs1 li:first").attr("id","current"); // Какой таб показать первым
        $("#content1 div:first").fadeIn(); // Показ первого контента таба
 
    $('#tabs1 input').focus(function(f) {
        f.preventDefault();
        $("#content1 div").hide(); //Скрыть всё содержимое
        $("#tabs1 li").attr("id",""); //Сброс идентификаторов
        $(this).parent().attr("id","current"); // Активация идентификаторов
        $('#' + $(this).attr('value')).fadeIn(); // Показать содержимое текущей вкладки
    });
})();
