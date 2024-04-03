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
		
		<nav class="top-bar" data-topbar role="navigation">
			<ul class="title-area">
				<li class="name">
					<h1><a href="#">Gerenciador de Conteúdo</a></h1>
				</li>
			</ul>
		</nav>
		
		<div class="clearfix">&nbsp;</div>
		
		<div class="row">
			<div class="medium-5 medium-centered columns panel">
				<h5>Recuperação de senha</h5>
				<?php
				echo form_open('admin/enviar_senha', '');
	
				if ($this -> session -> flashdata('erro_email')) {
					echo '<div class="alert-box alert">' . $this -> session -> flashdata('erro_email') . '</div>';
				}
				
				echo validation_errors('<div class="alert-box alert">', '</div>');

				echo form_input('email', set_value('email'), 'placeholder="seu e-mail" autofocus');
				echo form_submit(array('name' => 'enviar'), 'Reenviar senha', 'class="button round"');
				echo form_close();
				?>
			</div>
		</div>


		<!-- Include Scripts -->
		<?php $this->load->view('includes/scripts'); ?>
		
		<script>
			var clearAlert = setTimeout(function() {
				$(".alert-box").fadeOut('slow')
			}, 5000);
		
			$(document).on("click", ".alert a.close", function(event) {
				clearTimeout(clearAlert);
			});
		
			$(document).on("click", ".success a.close", function(event) {
				clearTimeout(clearAlert);
			});
		
			$(document).on("click", ".alert-box a.close", function(event) {
				event.preventDefault();
				$(this).closest(".alert-box").fadeOut(function(event) {
					$(this).remove();
				});
			});
		</script>

	</body>
</html>