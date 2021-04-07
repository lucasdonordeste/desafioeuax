		<section style="min-height: calc(100vh - 83px)" class="light-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-offset-3 col-lg-6 text-center">
						<div class="section-title">
							<h2>Área Restrita</h2>
								
						</div>
					</div>
				</div>
			</div>
<div class="container">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab_recebidos" role="tab" data-toggle="tab" >Documentos Recebidos</a></li>
<!-- 		<li><a href="#tab_emitidos" role="tab" data-toggle="tab">Documentos Emitidos</a></li> -->
	</ul>

	<div class="tab-content">
		<div id="tab_recebidos" class="tab-pane active">
			<div class="container-fluid">
				<h2>Documentos recebidos</h2>
				

			</div>
		</div>
<!-- 		<div id="tab_emitidos" class="tab-pane">Documentos Emitidos</div>
 -->	</div>
</div>
		</section>
		
		<div id="modal_recebidos" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">x</button>
						<h4 class="modal-title">Receber Documentos</h4>
					</div>
					<div class="modal-body">
<!-- 						<form id="form_recebimento" method="post" action="http://localhost/smsi_sys/restrict/ajax_save_protocolo"> -->

						<form id="form_recebimento" method="post" action="http://localhost/smsi_sys/protocolo/ajax_save_protocolo">
							<input name="idprotocolo" hidden />
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Origem</label>
								<div class="col-lg-10">
									<input id="p_origem" name="p_origem" class="form-control" />
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Destino</label>
								<div class="col-lg-10">
									<input id="p_destino" name="p_destino" class="form-control" />
									<span class="help-block"></span>
								</div>
							</div>
<!-- 							<div class="form-group"> -->
<!-- 								<label class="col-lg-2 control-label">Data na origem</label> -->
<!-- 								<div class="col-lg-10"> -->
<!-- 									<input type="date" id="p_data" name="p_data" class="form-control" placeholder="Data no documento"/> -->
<!-- 									<span class="help-block"></span> -->
<!-- 								</div> -->
<!-- 							</div> -->
							<div class="form-group">
								<label class="col-lg-2 control-label">Descrição</label>
								<div class="col-lg-10">
									<textarea id="p_descricao" name="p_descricao" class="form-control"></textarea>
									<span class="help-block"></span>
								</div>
							</div>
<!-- 							<div class="form-group"> -->
<!-- 								<label class="col-lg-2 control-label">Status</label> -->
<!-- 								<div class="col-lg-10"> -->
<!-- 									<input id="p_status" name="p_status" class="form-control" /> -->
<!-- 									<span class="help-block"></span> -->
<!-- 								</div> -->
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Tipo</label>
								<div class="col-lg-10">
									<select id="p_tipo" name="p_tipo" class="form-control">
										<option value="">Selecione...</option>
										<option value="Solicitação">Solicitação</option>
										<option value="Solicitação">Informativo</option>										
									</select>
									<span class="help-block"></span>
								</div>
							</div>														
							<div class="form-group text-center">
									<button type="submit" id="btn_save_doc" class="btn btn-primary"><i class="fa fa-save">&nbsp;Salvar</i></button>
									<span class="help-block"></span>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
		