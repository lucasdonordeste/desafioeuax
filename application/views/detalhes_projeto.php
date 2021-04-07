<p />

<?php 
	$finalizadas = count($atividades_finalizadas);
	$total = count($atividades);
	
	if($total > 0){
		$percentual = ($finalizadas*100)/$total;

		$atrasado = 'Não';



		if($atividades_pendentes){
			if(strtotime($atividades_pendentes[0]->a_fim) > strtotime($projeto->p_fim)){
				$atrasado = 'Sim';

			}else{
				$atrasado = 'Não';
			}
		}
	}else{
			$atrasado = 'Não';
			$percentual = 0;

	}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<h4>Projeto:</h4>
		<div class="alert alert-info col-lg-7">
			<h3><?php echo $projeto->p_nome; ?></h3><br />
				<strong>Início: </strong><?php echo date_format(date_create($projeto->p_inicio), 'd/m/y'); ?>
				<strong>Fim: </strong><?php echo date_format(date_create($projeto->p_fim), 'd/m/y'); ?><br />
				<h5>Estatísticas</h5>
				<strong>Atividades Prontas: </strong><?php echo $finalizadas.' de '.$total;?><br />

				<strong>% Completo: </strong><?php echo round($percentual,2).'%'; ?><br />
				<strong>Atrasado: </strong><?php echo $atrasado;?>

<?php 

?>

				<button class="btn btn-danger btn-delete-projeto" projeto_id="<?php echo $projeto->idprojeto;?>">
    	                       <i class="fa fa-danger">Excluir Projeto</i>
                               </button>	
		</div>
		<div class="col-lg-3">
<?php


    ?>


<?php
?>	
	</div>


		<div class="col-lg-12">


			<h4>Atividades:</h4>	

					<table id="dt_protocolos" class="table table-hover">
						<thead>
							<tr class="tableheader">
								<th class="no-sort">Nome</th>
								<th class="no-sort">Início</th>
								<th class="no-sort">Fim</th>
								<th class="no-sort">Concluída</th>								
								<th class="no-sort">Ações</th>
							</tr>

						</thead>
						<tbody>

<?php




foreach ($atividades as $atividade) {

?> 

<tr>
	<td><?php echo $atividade->a_nome;?></td>
	<td><?php echo date_format(date_create($atividade->a_inicio), 'd/m/y');?></td>
	<td><?php echo date_format(date_create($atividade->a_fim), 'd/m/y');?></td>
	<td><?php if($atividade->a_finalizada){echo 'Sim';}else{echo 'Não';}?></td>
	<td>
		<button class="btn btn-danger btn-delete-atividade" atividade_id="<?php echo $atividade->idatividade;?>">
    	                       <i class="fa fa-edit">Excluir</i>
                               </button>		
<?php		
if(!$atividade->a_finalizada){ ?>
		<button class="btn btn-success btn-ended-atividade" atividade_id="<?php echo $atividade->idatividade;?>">
    	                       <i class="fa fa-edit">Concluír Atividade</i>
                               </button>
<?php };?>

                           </td>
</tr>
  

<?php };?>	
	</tbody>
	</table>
		</div>

	</div>
</div>
<style>

h5{
    font-weight:bold;
}
.divisor {
	border-bottom: 1px solid #d9edf7;
	padding: 5px 0 15px 0;
	width: 70%;
	margin-left: 2%;
}

.seta_fluxo {
	padding: 10px 10px;
	background: #fbf8d0;
	border: 4px solid #fff;
	border-radius: 0 25px 25px 0;
	font-style: italic;
	font-size: 0.9em;
	display: inline-block;
	vertical-align: text-top;
}

.fluxo_active {
	font-weight: 600;
	background: #b0f1af;
	border-bottom: 3px solid #808080;
	font-style: normal;
	font-size: 1em;
}
</style>

<script>

$('.btn-delete-projeto').click(function(){
    
	   projeto_id = $(this).attr('projeto_id');                
     $.ajax({
         type:'POST',
         url: BASE_URL+'protocolo/ajax_excluir_projeto/'+projeto_id,
         dataType:'json',
         data:$(this).serialize(),
         
         beforeSend:function(){
         clearErrors();

         id = '.btn-delete-projeto';
         $(id).siblings(".help-block").html(loadingImg('Aguarde...'));

         },
 success:function(response){

     if(response['status']){

         window.alert(response['message']);
                    
         $('#modal_detalhes_protocolo').modal('hide');


         
     }else{
         showErrorsModal(response['error_list']);
     }
 },
     error: function(response){
          console.log(response);
         }
         
     });                

 });

$('.btn-ended-atividade').click(function(){
    
	   id_atividade = $(this).attr('atividade_id');                
     $.ajax({
         type:'POST',
         url: BASE_URL+'protocolo/ajax_finalizar_atividade/'+id_atividade,
         dataType:'json',
         data:$(this).serialize(),
         
         beforeSend:function(){
         clearErrors();

         id = '#btn-ended-atividade';
         $(id).siblings(".help-block").html(loadingImg('Aguarde...'));

         },
 success:function(response){

     if(response['status']){

         window.alert(response['message']);
                    
         $('#modal_detalhes_protocolo').modal('hide');

         
     }else{
         showErrorsModal(response['error_list']);
     }
 },
     error: function(response){
          console.log(response);
         }
         
     });                

 });

$('.btn-delete-atividade').click(function(){
    
	   id_atividade = $(this).attr('atividade_id');                
     $.ajax({
         type:'POST',
         url: BASE_URL+'protocolo/ajax_excluir_atividade/'+id_atividade,
         dataType:'json',
         data:$(this).serialize(),
         
         beforeSend:function(){
         clearErrors();

         id = '#btn-ended-atividade';
         $(id).siblings(".help-block").html(loadingImg('Aguarde...'));

         },
 success:function(response){

     if(response['status']){

         window.alert(response['message']);
                    
         $('#modal_detalhes_protocolo').modal('hide');

         
     }else{
         showErrorsModal(response['error_list']);
     }
 },
     error: function(response){
          console.log(response);
         }
         
     });                

 });



</script>