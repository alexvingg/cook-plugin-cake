$('.ui-grid-content tbody tr').hover(
    function(){ $('td', this).addClass('ui-grid-hover');},
    function(){ $('td', this).removeClass('ui-grid-hover');}
);