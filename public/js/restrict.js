$(function(){
    $('#btn_add_protocolo').click(function(){
        clearErrors();
        $('#form_projeto')[0].reset();
        $('#modal_projetos').modal();
    });
    

 
    
    function active_btn_protocolo(){
    	   $('.btn-view-barcode').click(function(){
    		  id_protocolo = $(this).attr('protocolo_id');

        	window.open(BASE_URL+'protocolo/ajax_view_barcode/'+id_protocolo, "minhaJanela", "height=500,width=500",);    	            

    	        return false;
    	    });  

    	   $('.btn-view-protodetalhes').click(function(){
              
              id_protocolo = $(this).attr('protocolo_id');                
                $.ajax({
                    type:'POST',
                    url: BASE_URL+'protocolo/ajax_get_detalhes_projeto/'+id_protocolo,
                    dataType:'json',
                    data:$(this).serialize(),
                    beforeSend:function(){
                    clearErrors();

                    
                $("#list-tramitacao").html(loader);
                $('#modal_detalhes_protocolo').modal();
                            
                    },
            success:function(response){
                //clearErrors();
         
                if(response['status']){
                    $("#list-tramitacao").html(response['data']);                    
                    
                }else{
                    showErrorsModal(response['error_list']);
                }
            },
                error: function(response){
                     console.log(response);
                    }
                    
                });                
                    

        	
            });  
            
            
    	   $('.btn-create-atividade').click(function(){

            id = '#modal_tarefa';                
    
     
              
              id_projeto = $(this).attr('projeto_id');                
                $.ajax({
                    type:'POST',
                    url: BASE_URL+'protocolo/ajax_nova_atividade/'+id_projeto,
                    dataType:'json',
                    data:$(this).serialize(),
                    beforeSend:function(){

                $("#list-tramitacao").html(loader);
                $('#modal-tarefa').modal();


                    },
            success:function(response){
                //clearErrors();
         
                if(response['status']){
                	$('#form-tarefa').html(response['data']);                    

                    
                }else{
                    showErrorsModal(response['error_list']);
                }
            },
                error: function(response){
                     console.log(response);
                    }
                    
                });                
                    

        	
            });  
              	
    	
    }
    
    
    var dt_protocolo = $('#dt_protocolos').dataTable({
        'lengthChange': false,
        'autoWidth':false,
        'processing':true,
        'serverSide':true,
        'ajax': {
            'url':BASE_URL+'protocolo/ajax_list_protocolos',
            'type': 'POST'
        },
        "language": {
            "url": "public/js/Portuguese-Brasil.json"},
        'columnDefs':[
            {targets: 'no-sort', orderable:false},
            {target:'dt-center', className:'dt-center'},
            {targets: 0, "width": '40%'},
            {targets: 1, "width": '10%'},
            {targets: 2, "width": '10%'},            
        ],
        'initComplete':function(){
        	active_btn_protocolo();
        },
        'drawCallback':function(){
        	active_btn_protocolo();
        }
    });    
    
    
   $('#form_projeto').submit(function(){
        $.ajax({
            type:'POST',
            url: BASE_URL+'protocolo/ajax_save_projeto',
            dataType:'json',
            data:$(this).serialize(),
            beforeSend:function(){
            clearErrors();
                            
                id = '#btn_save_doc';
                $("#loader").html(loader);

            },
    success:function(response){
        clearErrors();
 
        if(response['status']){
            $("#loader").html('');            
            $('#modal_projetos').modal('hide');
            dt_protocolo.api().ajax.reload();
            
        }else{
            $("#loader").html('');            
            showErrorsModal(response['error_list']);
        }
    },
        error: function(response){
             console.log(response);
            }
            
        });
        
        return false;
    });
    

	$('#modal-tarefa').on('hide.bs.modal',function(){
		dt_protocolo.api().ajax.reload();		
	});

	$('#modal-tarefa').on('click',function(){
		
	});

})