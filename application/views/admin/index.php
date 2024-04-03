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
				<h5>Efetue o login</h5>
				
				<?php
				if ($this -> session -> flashdata('erro_login')):
					echo '<div class="alert-box alert">' . $this -> session -> flashdata('erro_login') . '</div>';
				endif;
				
				if ($this -> session -> flashdata('logout')):
					echo '<div class="alert-box success">' . $this -> session -> flashdata('logout') . '</div>';
				endif;
				
				if ($this -> session -> flashdata('acesso')):
					echo '<div class="alert-box alert">' . $this -> session -> flashdata('acesso') . '</div>';
				endif;
				
				if ($this -> session -> flashdata('sucesso_email')):
					echo '<div class="alert-box success">' . $this -> session -> flashdata('sucesso_email') . '</div>';
				endif;

				echo form_open('admin/login', 'class=""');
				
				echo form_input('email', set_value('email'), 'autofocus  placeholder="e-mail cadastrado"');
				echo form_error('email', '<div class="alert-box alert">','</div>');
				echo "<br />";
				echo form_password('senha', set_value('senha'), 'placeholder="senha"');
				echo form_error('senha', '<div class="alert-box alert">','</div>');
				echo '<br />';
				echo form_submit(array('name' => 'enviar'), 'Login', 'class="button round"');
				echo anchor('admin/recuperar_senha','Esqueci minha senha', 'class="right" style="padding-top:15px;"');
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