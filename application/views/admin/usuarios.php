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



						<h4>Cadastrar novo Usuário</h4>
						<?php
							echo form_open('admin/cadastrar_usuario', 'style="margin: 20px;"');
				
							if ($this -> session -> flashdata('sucesso')) {
								echo '<div class="alert-box success">' . $this -> session -> flashdata('sucesso') . '<a href="" class="close">&times;</a></div>';
							}
							
							if ($this -> session -> flashdata('edicaook')) {
								echo '<div class="alert-box success">' . $this -> session -> flashdata('edicaook') . '<a href="" class="close">&times;</a></div>';
							}
		
							echo form_input('nome', set_value('nome'), 'class="input-text" autofocus placeholder="Nome"');
							echo form_error('nome', '<div class="alert-box alert">','</div>');
							echo form_input('email', set_value('email'), 'class="input-text" placeholder="E-mail"');
							echo form_error('email', '<div class="alert-box alert">','</div>');
							echo form_password('senha', set_value('senha'), 'class="input-text" maxlength="10" placeholder="Senha (até 10 caracteres)"');
							echo form_error('senha', '<div class="alert-box alert">','</div>');
							echo form_password('senha2', set_value('senha2'), 'class="input-text" maxlength="10" placeholder="Repetir Senha"');
							echo form_error('senha2', '<div class="alert-box alert">','</div>');
							$valores = array(
								''	=> 'Selecione o Nivel de Acesso',
								'administrador' => 'Administrador',
								'usuario' => 'Usuário'
		            		);
							echo form_dropdown('nivel',$valores,'','class="input-text"');
							echo form_error('nivel', '<div class="alert-box alert">','</div>');
							echo form_hidden('acesso', date('Y-m-d'));
							echo form_submit(array('name' => 'cadastrar'), 'Cadastrar', 'class="button success"');
							echo form_close();
						?>
		
		
						<h4>Usuários Cadastrados</h4>
						<?php
						if ($this -> session -> flashdata('deleteok')):
							echo '<div class="alert-box success">' . $this -> session -> flashdata('deleteok') . '<a href="" class="close">&times;</a></div>';
						endif;
						
						if ($usuarios):
							$this -> table -> set_heading('Nome', 'E-mail', 'Tipo', '');
							foreach ($usuarios as $linha) :
								$this -> table -> add_row($linha -> nome, $linha -> email, $linha-> nivel, '<a href="'.base_url().'admin/editar_usuario/'.$linha->id.'" class="button [tiny small large]">Editar</a> <a href="'.base_url().'admin/deletar_usuario/'.$linha->id.'" class="button alert [tiny small large]">Excluir</a>');
							endforeach;
							echo $this -> table -> generate();
							echo !empty($paginacao) ? $paginacao : '';
							
						else :
							echo 'Não existem usuários registrados.';
						endif;
						
						
						
						?>

					</div>		
				</div>
			</div>
		</div>


		<!-- Include Scripts -->
		<?php $this->load->view('admin/scripts'); ?>
		
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