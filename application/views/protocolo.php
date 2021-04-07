
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
			<li class="active"><a href="#tab_recebidos" role="tab"
				data-toggle="tab"></a></li>
<!-- 			<li><a href="#tab_emitidos" role="tab" data-toggle="tab">Documentos
					Emitidos</a></li> -->
		</ul>

		<div class="tab-content">
			<div id="tab_recebidos" class="tab-pane active">
				<div class="container-fluid">
					<h2>Meus Projetos</h2>

					<a id="btn_add_protocolo" class="btn btn-primary btn-lg"><i
						class="fa fa-plus">&nbsp;Novo Projeto</i></a>
					<table id="dt_protocolos" class="table table-hover">
						<thead>
							<tr class="tableheader">
								<th class="no-sort">Nome</th>
								<th class="no-sort">Início</th>
								<th class="no-sort">Fim</th>
								<th class="no-sort">Ações</th>
							</tr>

						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<div id="modal_projetos" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">x</button>
				<h4 class="modal-title">Novo Projeto</h4>
			</div>
			<div id="loader"></div>			
			<div class="modal-body">
				<form id="form_projeto" method="post" action="">
					<input name="idprojeto" hidden="hidden" />

					<div class="form-group">
						<label class="col-lg-2 control-label">Nome</label>
						<div class="col-lg-10">
							<input id="p_nome" name="p_nome" class="form-control" /> <span
								class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Inicio</label>
						<div class="col-lg-10">
							<input id="p_inicio" name="p_inicio" class="form-control" type="date"/> <span
								class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Fim</label>
						<div class="col-lg-10">


							<input id="p_fim" name="p_fim" class="form-control" type="date" />
							 <span
							class="help-block"></span>
						</div>
					</div>

					<div class="form-group">
					
						<div class="col-lg-6">
							

						</div>
					</div>
					<div class="form-group">
						<button type="submit" id="btn_save_doc" class="btn btn-success">
							<i class="fa fa-save">&nbsp;Salvar</i>
						</button>
						<span class="help-block"></span>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<div id="modal_detalhes_protocolo" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">x</button>
				<h3 class="modal-title">Detalhes do Projeto</h3>
			</div>
			<div class="modal-body" id="list-tramitacao">
				<div class="loader" role="status" style="margin:50px auto;">
  					<span class="sr-only">Loading...</span>
				</div>				
			</div>
		</div>
	</div>
</div>
<div id="modal-tarefa" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">x</button>
				<h4 class="modal-title">Detalhes</h4>
			</div>
			<div class="modal-body" id="form-tarefa">
				<div class="loader" role="status" style="margin:50px auto;">
  					<span class="sr-only">Loading...</span>
				</div>				</div>
		</div>
	</div>
</div>
