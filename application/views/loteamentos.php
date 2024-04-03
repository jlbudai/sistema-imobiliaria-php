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
				<h1><?php echo $conteudo->titulo ?></h1>
				<?php echo $conteudo->conteudo ?>
			</div>
					
			<div class="clearfix">&nbsp;</div>	
			<div class="clearfix">&nbsp;</div>
			
			<h4 class="cor-lr">Cadastre-se em nossa lista de espera!</h4>	
			<form method="post" action="" id="formularioContato" enctype="multipart/form-data">
				<div class="row">
					<div class="medium-6 columns">
						<label>Nome</label>
						<input type="text" name="nome" id="nome" />
					</div>
					<div class="medium-6 columns">
						<label>E-mail</label>
						<input type="text" name="email" id="email" />
					</div>
				</div>
				<div class="row">
					<div class="medium-6 columns">
					</div>
				</div>
				<div class="row">
					<div class="medium-6 columns">
						<label>Telefone</label>
						<input type="text" name="telefone" id="telefone" />
					</div>
					<div class="medium-6 columns">
						<label>Celular</label>
						<input type="text" name="celular" id="celular" />
					</div>
				</div>
				<div class="row">
					<div class="medium-12 columns">
						<label>Qual empreendimento tem interesse? (Ex: Loteamento Recanto dos Ipês)</label>
						<input type="text" name="empreendimento" id="empreendimento" />
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
						celular : {
							required : true,
							number : true
						},
						empreendimento : {
							required : true
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
						celular : {
							required : "Digite o seu telefone para contato"
						},
						empreendimento : {
							required : "Digite o empreendimento que tem interesse.",
						}
					},
		
					submitHandler : function(form) {
						var dados = $(form).serialize();
						$('#status').show();
						$.ajax({
							type : "POST",
							url : "<?php echo base_url(); ?>fale_conosco/envia_espera_empreendimento",
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