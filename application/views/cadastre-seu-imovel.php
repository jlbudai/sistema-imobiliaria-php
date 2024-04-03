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
				<h1>CADASTRE SEU IMÓVEL</h1>
				<p>Utilize o formulario abaixo para efetuar o pré cadastro de seu imóvel. Entraremos em contato posteriormente para confirmação.</p>
				<br />
				<form method="post" action="" id="formularioContato">
				<h5>DADOS PESSOAIS</h5>
				
				<div class="row">
					<div class="medium-6 columns">
						<label>Nome
							<input type="text" name="nome" id="nome" />
						</label>
					</div>		
					<div class="medium-6 columns">
						<label>Endereço
							<input type="text" name="endereco_pessoa" />
						</label>
					</div>		
				</div>
				<div class="row">
					<div class="medium-6 columns">
						<label>E-mail
							<input type="text" name="email" id="email" />
						</label>
					</div>		
					<div class="medium-6 columns">
						<label>Telefone</label>
							<div class="row">
								<div class="medium-2 columns">
									<input type="text" name="ddd" id="ddd" />		
								</div>
								<div class="medium-10 columns">
									<input type="text" name="telefone" id="telefone" />		
								</div>
							</div>
					</div>		
				</div>
				
				<h5>DADOS DO IMÓVEL</h5>
				
				<div class="row">
					<div class="medium-6 columns">
						<label>Tipo do Imóvel (Casa, Apartamento, Sítio)
							<input type="text" name="tipo" id="tipo" />
						</label>
					</div>		
					<div class="medium-6 columns">
						<label>Finalidade (Compra, Venda, Locação, Temporada)
							<input type="text" name="finalidade" id="finalidade" />
						</label>
					</div>		
				</div>
				<div class="row">
					<div class="medium-6 columns">
						<label>Valor Pretendido
							<input type="text" name="valor" id="valor" />
						</label>
					</div>		
					<div class="medium-6 columns">
						<label>Cidade onde se localiza o imóvel</label>
							<div class="row">
								<div class="medium-10 columns">
									<input type="text" name="cidade" />		
								</div>
								<div class="medium-2 columns">
									<select name="estado">
					                	<option value="AC">AC</option>
					                	<option value="AL">AL</option>
					                	<option value="AP">AP</option>
					                	<option value="AM">AM</option>
					                	<option value="BA">BA</option>
					                	<option value="CE">CE</option>
					                	<option value="ES">ES</option>
					                	<option value="DF">DF</option>
				                        <option value="GO">GO</option>
					                	<option value="MA">MA</option>
					                	<option value="MT">MT</option>
					                	<option value="MS">MS</option>
					                	<option value="MG">MG</option>
					                	<option value="PA">PA</option>
					                	<option value="PB">PB</option>
					                	<option value="PR">PR</option>
					                	<option value="PE">PE</option>
					                	<option value="PI">PI</option>
					                	<option value="RJ">RJ</option>
					                	<option value="RN">RN</option>
					                	<option value="RS">RS</option>
					                	<option value="RO">RO</option>
					                	<option value="RR">RR</option>
					                	<option value="SC">SC</option>
					                	<option value="SP">SP</option>
					                	<option value="SE">SE</option>
					                	<option value="TO">TO</option>
									</select>		
								</div>
							</div>
					</div>		
				</div>
				<div class="row">
					<div class="medium-6 columns">
						<label>Endereço do imóvel
							<input type="text" name="endereco-imovel" />
						</label>
					</div>		
					<div class="medium-6 columns">
						<label>Bairro
							<input type="text" name="bairro" />
						</label>
					</div>		
				</div>
				<div class="row">
					<div class="medium-12 columns">
						<label>Descrição do imóvel (Descreva os detalhes do imóvel, sala comercial, galpão, depósito, imóvel com quantidade de quartos, banheiros, salas, garagem e demais informações)
							<textarea rows="5" name="descricao"></textarea>
						</label>
					</div>									
				</div>
				<div class="row">
					<div class="medium-12 columns">
						<input type="submit" class="button colibri right" />
					</div>									
				</div>
			</form>
				<p id="status">Enviando...</p>
				<p id="sucessoEnvio">Enviado com Sucesso</p>


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
							url : "<?php echo base_url(); ?>fale_conosco/envia_cadastro/",
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