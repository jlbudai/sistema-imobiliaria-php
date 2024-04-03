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



						<h4>Cadastrar Fotos</h4>
						<?php
							if ($this -> session -> flashdata('sucesso')) {
								echo '<div class="alert-box success">' . $this -> session -> flashdata('sucesso') . '<a href="" class="close">&times;</a></div>';
							}
							
							echo 'Cadastrando fotos para o imóvel: <b>'.$imovel -> CodUnico. '</b>';
						?>
	



						<div id="upload">Selecionar Fotos</div>
						<div id="status"></div>
						<div class="clearfix">&nbsp;</div>
						<button id="btn-enviar">ENVIAR FOTOS</button>
						<div class="clearfix">&nbsp;</div>
						<h5>Fotos Cadastradas</h5>
						<?php  
							if ($fotos):
								echo '<p>Para excluir uma foto, clique sobre a mesma.</p>';
								echo '<ul class="small-block-grid-1 medium-block-grid-4 large-block-grid-4 text-center">';
								foreach ($fotos as $foto) :
							?>
								<li>
								<a href="<?php echo base_url() ?>admin/excluir_foto/<?php echo $foto -> idFoto; ?>/<?php echo $this->uri->segment(3); ?>"><img src="<?php echo base_url().'fotos-imoveis/'.$foto -> foto; ?>" width="150" /></a>
								<p><?php echo $foto -> legenda; ?></p>
								</li>
							<?php
								endforeach;
								echo '<ul>';								
							else :
								echo 'Não existem registros.';
							endif;
						?>
						<div class="clearfix">&nbsp;</div>
					</div>		
				</div>
			</div>
		</div>


		<!-- Include Scripts -->
		<?php $this->load->view('admin/scripts'); ?>
		<script src="<?php echo base_url(); ?>js/jquery.uploadfile.js"></script>
		
		<script>
			var clearAlert = setTimeout(function() {
				$(".alert-box").fadeOut('slow')
			}, 5000);

			
			
			
		</script>
		<script>

			var extraObj = $("#upload").uploadFile({
				url : "<?php echo base_url(); ?>admin/upload_fotos",
				method : "POST",
				allowedTypes : "bmp,jpg,png,gif",
				fileName : "arquivo",
				formData: {"idImovel":<?php echo $this->uri->segment(3); ?>},
				multiple : true,
				showPreview:true,
 				previewHeight: "67px",
 				previewWidth: "100px",
				extraHTML:function()
				{
			    	var html = "<div><b>Legenda para a Foto:</b><input type='text' name='legenda' value='' />";
			    	html += "<div><b>Ordem da Foto: <br/>(Usar apenas números, por exemplo: 1 = primeira, 2 = segunda, 3 = terceira, etc)</b><input type='text' name='ordem' value='' />";
					html += "</div>";
					return html;    		
				},
				autoSubmit:false,
				onSuccess : function(files, data, xhr) {
					setTimeout(function() {
						$(".ajax-file-upload-statusbar").fadeOut('slow')
					}, 5000);
					
				},
				afterUploadAll:function(){
					window.setTimeout('location.reload()', 1000);
				},
				onError : function(files, status, errMsg) {
					$("#status").html("<font color='red'>Erro no upload</font>");
				}
			});
			
			$("#btn-enviar").click(function()
			{
				extraObj.startUpload();
			}); 

		
		</script>

	</body>
</html>