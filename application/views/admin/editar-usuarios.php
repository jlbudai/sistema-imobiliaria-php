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
						
						<h4>Editar Usuário</h4>
						
						<div class="row">
							<div class="medium-8 columns">
							<?php
							
								echo form_open('admin/atualizar_usuario');
			
								echo form_input('nome', $nome, 'class="input-text" autofocus placeholder="Nome"').'<br/>';
								echo form_error('nome', '<div class="alert-box alert">','<a href="" class="close">&times;</a></div>');
								echo form_input('email', $email, 'class="input-text" placeholder="E-mail" disabled').'<br/>';
								echo form_error('email', '<div class="alert-box alert">','<a href="" class="close">&times;</a></div>');
								echo form_password('senha', set_value('senha'), 'class="input-text" maxlength="10" placeholder="Senha (até 10 caracteres)"').'<br/>';
								echo form_error('senha', '<div class="alert-box alert">','<a href="" class="close">&times;</a></div>');
								echo form_password('senha2', set_value('senha2'), 'class="input-text" maxlength="10" placeholder="Repetir Senha"').'<br/>';
								echo form_error('senha2', '<div class="alert-box alert" >','<a href="" class="close">&times;</a></div>');
								$valores = array(
									''	=> 'Selecione o Nivel de Acesso',
									'administrador' => 'Administrador',
									'usuario' => 'Usuário'
			            		);
								echo form_dropdown('nivel',$valores,$nivel,'').'<br/>';
								echo form_hidden('id', $id);
								echo form_error('nivel', '<div class="alert-box alert">','</div>');
								
							?>
							<input type="button" name="Cancelar" value="Cancelar" onclick="javascript:history.back();" class="button alert" />	
							<?php
								echo form_submit(array('name' => 'atualizar'), 'Atualizar', 'class="button success"');
								echo form_close();
							?>
								
							</div>
							<div class="medium-4 columns panel">
								<p>Para <b>NÃO</b> atualizar a senha, basta deixar o campo SENHA e REPETIR SENHA em branco.</p><br />
								<p>Os e-mails são únicos no sistema, por isso não podem ser editados. Para alterar o e-mail, será preciso cadastrar um novo usuário e excluir o usuário antigo.</p>
							</div>
						</div>


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