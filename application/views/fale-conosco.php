<!doctype html>
<html class="no-js" lang="pt-br">
	<head>
		<?php $this -> load -> view('includes/head'); ?>
	</head>
	<body>

		<!-- Topo -->
		<?php $this -> load -> view('includes/menu'); ?>
		
		<!-- Banner -->
		<?php $this -> load -> view('includes/banners'); ?>
		
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		

		<!-- Conteudo -->
		<div class="row">
			<div class="medium-12 medium-centered columns">
				<h1>FALE CONOSCO</h1>
				<p>Utilize o formulário abaixo para entrar em contato conosco.</p>
				
				<div class="row">
					<div class="medium-6 columns">

						<form method="post" action="" id="formularioContato" enctype="multipart/form-data">
							<div class="row">
    							<div class="medium-12 columns">
									<label>Nome</label>
									<input type="text" name="nome" id="nome" />
								</div>
							</div>
							<div class="row">
    							<div class="medium-12 columns">
									<label>E-mail</label>
									<input type="text" name="email" id="email" />
								</div>
							</div>
							<div class="row">
    							<div class="medium-12 columns">
									<label>Telefone</label>
								</div>
							</div>
							<div class="row">
    							<div class="medium-3 columns">
									<input type="text" name="ddd" id="ddd" />
								</div>
    							<div class="medium-9 columns">
									<input type="text" name="telefone" id="telefone" />
								</div>
							</div>
							<div class="row">
    							<div class="medium-12 columns">
									<label>Mensagem
										<textarea name="mensagem" id="mensagem" rows="3"></textarea>
									</label>
								</div>
							</div>
							<div class="row">
    							<div class="medium-12 columns">
									<input type="submit" class="button colibri right" value="Enviar E-mail" />
								</div>
							</div>
							
							
						</form>
						<p id="status">Enviando...</p>
						<p id="sucessoEnvio">Enviado com Sucesso</p>
					</div>
					<div class="medium-6 columns">

						<h5>Endereço</h5>
						<span>R General Osorio, 720, Letra: B; Sala: A <br/> Centro, Camanducaia, MG</span><br /><br />
						<h5>Telefone</h5>
						<span class="font24px">35 3433-3337</span><br /><br />
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3679.545353052371!2d-46.13798328446853!3d-22.745134037842174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cc00b47113f707%3A0x73a9189a32ac2f85!2sR.+Gen.+Os%C3%B3rio%2C+720%2C+Camanducaia+-+MG%2C+37650-000!5e0!3m2!1spt-BR!2sbr!4v1466778875750" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
						
					</div>
				</div>
							
				

			</div>
		</div>
		<!-- Fim Conteudo -->
		
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		
		<div class="row">
			<div class="medium-12 columns text-center">
				<hr />
			</div>
		</div>
		
		<!-- Busca -->
		<?php $this -> load -> view('includes/busca'); ?>
		
		

		<?php $this -> load -> view('includes/rodape'); ?>
		
		<?php $this -> load -> view('includes/scripts'); ?>
		<script src="<?php echo base_url(); ?>js/validate.js"></script>
		<script>

			$(document).ready(function() {
				var validator = $("#formularioContato").validate({
					rules : {
						nome : {
							required : true,
							minlength : 2
						},
						email : {
							required : true,
							email : true
						},
						telefone : {
							required : true,
							number : true
						},
						mensagem : {
							required : true,
							minlength : 15
						}
					},
		
					messages : {
						nome : {
							required : "Digite o seu nome",
							minLength : "O seu nome deve conter, no mínimo, 2 caracteres"
						},
						email : {
							required : "Digite o seu e-mail para contato",
							email : "Digite um e-mail válido"
						},
						telefone : {
							required : "Digite o seu telefone para contato"
						},
						mensagem : {
							required : "Digite a sua mensagem",
							minLength : "A sua mensagem deve conter, no mínimo, 2 caracteres"
						}
					},
		
					submitHandler : function(form) {
						var dados = $(form).serialize();
						$('#status').show();
						$.ajax({
							type : "POST",
							url : "<?php echo base_url(); ?>fale_conosco/envia_email",
							data : dados,
							success : function(data) {						
								$('#sucessoEnvio').show();
								$('#status').hide();
								$('#formularioContato').each (function(){
									this.reset();
								});
								
								var clearAlert = setTimeout(function() {
									$("#sucessoEnvio").fadeOut('slow');
								}, 5000);
							}
						});
						return false;
					}
				});
			});
			
			
			
		</script>
		
	</body>
</html>