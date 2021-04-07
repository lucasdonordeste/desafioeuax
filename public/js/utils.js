/**
 * 
 */
 
 const BASE_URL = "http://desafioeuax.lucasrodrigues.dev.br/";

function clearErrors(){
    $('.has-error').removeClass('has-error');
    $('.help-block').html('');
}

function showErrors(error_list){
    clearErrors();

    $.each(error_list, function(id, message){
        $(id).parent().parent().addClass('has-error');
        $(id).parent().siblings(".help-block").html(message);
        
        console.log(message);
    })
}

function showErrorsModal(error_list){
    clearErrors();

    $.each(error_list, function(id, message){
        $(id).parent().parent().addClass('has-error');
        $(id).siblings(".help-block").html(message);
        
        console.log(message);
    })
}


function loadingImg(message = ""){
    return "<i class='fa fa-circle-o-notch fa-spin'></i>&nbsp;"+message;

}

function loader(message = ""){
    return '<div class="loader" role="status" style="margin:50px auto;"><span class="sr-only">Carregando...</span></div>';

}

