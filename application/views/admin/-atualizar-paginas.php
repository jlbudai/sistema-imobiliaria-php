<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="pt-br">
	<!--<![endif]-->
	<head>
		<?php $this -> load -> view('includes/head'); ?>
	</head>
	<body>
	<div class="row">
		<div class="twelve columns">
			<?php
			echo form_open('admin/atualizar/'.$idPagina);
				echo validation_errors('<div class="alert-box alert">', '<a href="" class="close">&times;</a></div>');
		
				if ($this -> session -> flashdata('cadastrook')) {
					echo '<div class="alert-box success">' . $this -> session -> flashdata('cadastrook') . '<a href="" class="close">&times;</a></div>';
				}
		
				echo form_input(array('name' => 'titulo'), set_value('titulo', $tituloPagina), 'autofocus');
				echo form_textarea(array('name' => 'conteudo'),  set_value('conteudo', $conteudo), 'placeholder="conteúdo"');
				echo '<br/><br/>';
				echo form_submit(array('name' => 'cadastrar'), 'Cadastrar', 'class="button round"');
			echo form_close();
			?>
		</div>
	</div>


		<!-- Include Scripts -->
		<?php $this -> load -> view('includes/scripts'); ?>
		
		<script src="<?php echo base_url().'javascripts/ckeditor/ckeditor.js' ?>"></script>
		<script>
			CKEDITOR.replace( 'conteudo' );
		</script>


	</body>
</html>


