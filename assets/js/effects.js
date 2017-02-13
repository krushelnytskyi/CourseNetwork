//Show and hide "city type"  and "country select" on /jobs page
$(document).ready(function(){
    $('.drill_down_links').click(function(){
        $(this).parent().children('div.drill_down_body').toggle('normal');
        return false;
    });

    $('.proposal-link').click(function(){
        $('div.proposal-form').toggle('normal');
        return false;
    });
});
