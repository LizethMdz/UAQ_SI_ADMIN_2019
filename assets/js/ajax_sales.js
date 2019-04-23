$(function(){
    $('#desde').on('change', function(){
        var desde = $('#desde').val();
        var hasta = $('#hasta').val();
        $.ajax({
            type: "POST",
            url: "p_search_sale.php",
            data: 'desde='+ desde + '&hasta= ' + hasta ,
            success: function (datos) {
                $('#sales').html(datos);
                
            }
        });
        return false;
    });

    $('#hasta').on('change', function(){
        var desde = $('#desde').val();
        var hasta = $('#hasta').val();
        $.ajax({
            type: "POST",
            url: "p_search_sale.php",
            data: 'desde= '+ desde + '&hasta= ' + hasta ,
            success: function (datos) {
                $('#sales').html(datos);
                
            }
        });
        return false;
    });
});
