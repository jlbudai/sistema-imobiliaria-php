<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="pt-br">
	<!--<![endif]-->
	<head>
		<?php $this->load->view('admin/head'); ?>
	</head>
	<body>
		
		<?php $this->load->view('admin/topo'); ?>
		
		<div class="row.full">
			<div class="medium-2 columns bgd-cz5 padding0 margin0 panel">
				<?php $this->load->view('admin/menu'); ?>		
			</div>
			<div class="medium-10 columns">
				<div class="clearfix">&nbsp;</div>
				<div class="row">
					<div class="medium-12 columns">

						<h4>Atualizar Páginas</h4>
						<p>Utilize os campos abaixo para atualizar as páginas do site. Cada página deve ser atualizada individualmente.</p>
						<?php
							if ($this -> session -> flashdata('sucesso')) {
								echo '<div class="alert-box success">' . $this -> session -> flashdata('sucesso') . '<a href="" class="close">&times;</a></div>';
							}
						?>
						
						<form action="<?php echo base_url() ?>admin/atualizar-pagina" method="post" enctype="multipart/form-data">	
							<div class="row">
								<div class="medium-12 columns">
									<label>Título da Página
										<input type="text" name="titulo" id="titulo" value="<?php echo $sobre->titulo; ?>" />
									</label>
								</div>
							</div>
							<div class="row">
								<div class="medium-12 columns">
									<label>Conteúdo da página
										<textarea rows="3" name="conteudo"><?php echo $sobre->conteudo; ?></textarea>
									</label>
								</div>
							</div>
							
							<div class="clearfix">&nbsp;</div>
							
							<div class="row">
								<div class="medium-12 columns text-center">
									<input type="hidden" name="id" value="<?php echo $sobre->id; ?>" />
									<input type="submit" class="button" value="Atualizar Página" />
								</div>
							</div>
						</form>
						
						<div class="clearfix">&nbsp;</div>
						
						<form action="<?php echo base_url() ?>admin/atualizar-pagina" method="post" enctype="multipart/form-data">	
							<div class="row">
								<div class="medium-12 columns">
									<label>Título da Página
										<input type="text" name="titulo" id="titulo" value="<?php echo $servicos->titulo; ?>" />
									</label>
								</div>
							</div>
							<div class="row">
								<div class="medium-12 columns">
									<label>Conteúdo da página
										<textarea rows="3" name="conteudo" class="ckeditor"><?php echo $servicos->conteudo; ?></textarea>
									</label>
								</div>
							</div>
							
							<div class="clearfix">&nbsp;</div>
							
							<div class="row">
								<div class="medium-12 columns text-center">
									<input type="hidden" name="id" value="<?php echo $servicos->id; ?>" />
									<input type="submit" class="button" value="Atualizar Página" />
								</div>
							</div>
						</form>
						
						<div class="clearfix">&nbsp;</div>
						
						<form action="<?php echo base_url() ?>admin/atualizar-pagina" method="post" enctype="multipart/form-data">	
							<div class="row">
								<div class="medium-12 columns">
									<label>Título da Página
										<input type="text" name="titulo" id="titulo" value="<?php echo $loteamentos->titulo; ?>" />
									</label>
								</div>
							</div>
							<div class="row">
								<div class="medium-12 columns">
									<label>Conteúdo da página
										<textarea rows="3" name="conteudo" class="ckeditor"><?php echo $loteamentos->conteudo; ?></textarea>
									</label>
								</div>
							</div>
							
							<div class="clearfix">&nbsp;</div>
							
							<div class="row">
								<div class="medium-12 columns text-center">
									<input type="hidden" name="id" value="<?php echo $loteamentos->id; ?>" />
									<input type="submit" class="button" value="Atualizar Página" />
								</div>
							</div>
						</form>
						
						
					</div>		
					
					
					
				</div>
			</div>
		</div>


		<!-- Include Scripts -->
		<?php $this->load->view('admin/scripts'); ?>
		<script src="<?php echo base_url().'js/ckeditor/ckeditor.js' ?>"></script>
		<script>
			CKEDITOR.replace( 'conteudo' );
		</script>
		

	</body>
</html>