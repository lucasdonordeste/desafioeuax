<p />
<div class="container-fluid">
	<h3>Criar Atividade</h3>
	<div>
		<form id="form_nova_tarefa" method="post" action="#">
			<input name="projeto_idprojeto" hidden="hidden"
				value="<?php echo $idprotocolo;?>" />
			<div class="form-group">
				<label class="col-lg-2 control-label">Descrição</label>
				<div class="col-lg-10">
					<input id="a_nome" name="a_nome" class="form-control" /><span
						class="help-block"></span>
					<span class="help-block"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Data Início</label>
				<div class="col-lg-10">
					<input id="a_inicio" name="a_inicio" class="form-control" type="date"/><span
						class="help-block"></span>
					<span class="help-block"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Data Fim</label>
				<div class="col-lg-10">
					<input id="a_fim" name="a_fim" class="form-control" type="date"/><span
						class="help-block"></span>
					<span class="help-block"></span>
				</div>
			</div>
			<div class="form-group text-center">
				<button type="submit" id="btn_save_tarefa" class="btn btn-primary">
					<i class="fa fa-save">&nbsp;Criar</i>
				</button>
				<span class="help-block"></span>
			</div>

		</form>
	</div>
</div>

<script>
    

$('#form_nova_tarefa').submit(function(){
       
        $.ajax({
            type:'POST',
            url: BASE_URL+'protocolo/ajax_criar_atividade',
            dataType:'json',
            data:$(this).serialize(),
            beforeSend:function(){

            $('#loader').html(loader);
            $('#modal-tarefa').modal();
            	
            },
    success:function(response){
       // clearErrors();
 
        if(response['status']){
           $('#loader').html('');          
           $('#modal-tarefa').modal('hide');
            alert(response['message']);

            
        }else{
            $('#loader').html('');             
            showErrorsModal(response['error_list']);
        }
    },
        error: function(response){
             console.log(response);
            }
            
        });
        
        return false;
    });


  
</script>
