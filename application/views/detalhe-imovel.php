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
		<div class="row printable">
			<div class="medium-12 medium-centered columns">
				<h1>DETALHE DO IMÓVEL</h1>
				
				<div class="row">
					<div class="medium-3 columns">
						<?php if($status == 'Vendido'): ?>
							<img src="<?php echo base_url() ?>/images/btn-vendido.png" style="position: absolute" />
						<?php elseif($status == 'Alugado'): ?>	
							<img src="<?php echo base_url() ?>/images/btn-alugado.png" style="position: absolute" />
						<?php elseif($status == 'Oferta'): ?>	
							<img src="<?php echo base_url() ?>/images/btn-oferta.png" style="position: absolute" />
						<?php elseif($status == 'Oportunidade'): ?>	
							<img src="<?php echo base_url() ?>/images/btn-oportunidade.png" style="position: absolute" />
						<?php endif; ?>
						
						<?php if($capa != '0'): ?>
							<img src="<?php echo base_url() ?>/fotos-imoveis/<?php echo $capa ?>" />
						<?php else: ?>
							<img src="<?php echo base_url() ?>/images/sem-foto-cadastrada.jpg" />										
						<?php endif; ?>
					</div>
					<div class="medium-7 columns">
						<span class="font24px bold color-az">Cód.: <?php echo $codunico ?></span><br /><br />
						<span class="font24px bold color-az">R$ <?php echo number_format($valor, 2, ",", ".") ?></span><br />
						<span class="font24px bold color-az"><?php echo $tipo ?> para <?php echo $negocio ?></span><br /><br />
						<span><?php echo $endereco ?> - <?php echo $bairro ?><br /><?php echo $cidade ?></span><br /><br />
						<?php if($areaTotal != ' m²'): ?><span>Área total: - <?php echo $areaTotal ?></span><br /><?php else: ?><?php endif; ?>
						<?php if($areaCons != ' m²'): ?><span>Área Construída: - <?php echo $areaCons ?></span><br /><?php else: ?><?php endif; ?>
					</div>
					<div class="medium-2 columns text-center">
						<a target="_blank" href="<?php echo base_url() ?>imoveis/imprimir/<?php echo $codunico ?>" class="button colibri tiny">Imprimir Imóvel</a>
						<a href="javascript:void(0);" data-reveal-id="formAmigo" class="button colibri tiny">Enviar ao amigo</a>
					</div>
				</div>
				
				<div class="clearfix">&nbsp;</div>
				
				<?php if($dormitorios !='0' OR $suites !='0' OR $banheiros !='0' OR $garagem !='0' OR $salaTv !='0' OR $salaEstar !='0'): ?>
				<div class="row">
					<div class="medium-12 columns">
						<h5>DESCRIÇÃO</h5>
						<p>
							<?php
								echo $tipo.' com '; 
								if($dormitorios !='0'): echo $dormitorios.' '; endif; 
								if($suites !='0'): echo $suites.' '; endif; 
								if($banheiros !='0'): echo $banheiros.' '; endif; 
								if($garagem !='0'): echo $garagem.' '; endif; 
								if($salaTv !='0'): echo $salaTv.' '; endif; 
								if($salaEstar !='0'): echo $salaEstar.' '; endif; 
								if($salaJantar !='0'): echo $salaJantar.' '; endif; 
								if($sala2ambientes !='0'): echo $sala2ambientes.' '; endif; 
								if($cozinha !='0'): echo $cozinha.' '; endif; 
								if($cozinhaPlanejada !='0'): echo $cozinhaPlanejada.' '; endif; 
								if($cozinhaAmericana !='0'): echo $cozinhaAmericana.' '; endif; 
								if($cozinhaMineira !='0'): echo $cozinhaMineira.' '; endif; 
								if($lavabo !='0'): echo $lavabo.' '; endif; 
								if($areaServico!='0'): echo $areaServico.' '; endif; 
								if($quartoEmpregada !='0'): echo $quartoEmpregada.' '; endif; 
								if($quintal !='0'): echo $quintal.' '; endif; 
								if($copa !='0'): echo $copa.' '; endif; 
								if($escritorio !='0'): echo $escritorio.' '; endif; 
								if($despensa !='0'): echo $despensa.' '; endif; 
								if($porao !='0'): echo $porao.' '; endif; 
							?>
						</p>
					</div>
				</div>
				
				<div class="clearfix">&nbsp;</div>
				<?php endif; ?>
				
				<?php if($piscina !='0' OR $churrasqueira !='0' OR $jardim !='0' OR $jardimInverno !='0' OR $areaLazer !='0' OR $salaoJogos !='0' OR $sauna !='0' OR $hidromassagem !='0' OR $ofuroJacuzi !='0' OR $gourmet !='0' OR $sacada !='0' OR $varanda !='0' OR $portaoEletronico !='0' OR $interfone !='0' OR $aquecedorSolar !='0' OR $cercaEletrica !='0'): ?>
				<div class="row">
					<div class="medium-12 columns">
						<h5>DETALHES DO IMÓVEL</h5>
						<p>
							<?php 
								if($piscina !='0'): echo $piscina.' '; endif;  
								if($churrasqueira !='0'): echo $churrasqueira.' '; endif;  
								if($jardim !='0'): echo $jardim.' '; endif;  
								if($jardimInverno !='0'): echo $jardimInverno.' '; endif;   
								if($areaLazer !='0'): echo $areaLazer .' '; endif;   
								if($salaoJogos !='0'): echo $salaoJogos.' '; endif;   
								if($sauna !='0'): echo $sauna.' '; endif;   
								if($hidromassagem !='0'): echo $hidromassagem.' '; endif;   
								if($ofuroJacuzi !='0'): echo $ofuroJacuzi.' '; endif;   
								if($gourmet !='0'): echo $gourmet.' '; endif;   
								if($sacada !='0'): echo $sacada.' '; endif;   
								if($varanda !='0'): echo $varanda.' '; endif;   
								if($portaoEletronico !='0'): echo $portaoEletronico.' '; endif;   
								if($interfone !='0'): echo $interfone.' '; endif;   
								if($aquecedorSolar !='0'): echo $aquecedorSolar.' '; endif;   
								if($cercaEletrica !='0'): echo $cercaEletrica.' '; endif;   
							?>							
						</p>
					</div>
				</div>
				
				<div class="clearfix">&nbsp;</div>
				<?php endif; ?>
				
				<?php if($creche !='0' OR $faculdade !='0' OR $escola2grau !='0' OR $escola1grau !='0' OR $hospital !='0' OR $postoSaude !='0' OR $postoGasolina !='0' OR $onibus !='0' OR $parque !='0' OR $templo !='0' OR $farmacia !='0' OR $supermercado !='0' OR $mercado !='0' OR $padaria !='0' OR $acougue !='0' OR $pizzaria !='0' OR $restaurante !='0' OR $lanchonete !='0' OR $igrejaEvangelica !='0' OR $igrejaCatolica !='0'): ?>
				<div class="row">
					<div class="medium-12 columns">
						<h5>O QUE TEM POR PERTO</h5>
						<p>
							<?php 
								if($farmacia !='0'): echo $farmacia.' '; endif;  
								if($supermercado !='0'): echo $supermercado.' '; endif;  
								if($mercado !='0'): echo $mercado.' '; endif;  
								if($padaria !='0'): echo $padaria.' '; endif;  
								if($acougue !='0'): echo $acougue.' '; endif;  
								if($pizzaria !='0'): echo $pizzaria.' '; endif;  
								if($restaurante !='0'): echo $restaurante.' '; endif;  
								if($lanchonete !='0'): echo $lanchonete.' '; endif;  
								if($igrejaEvangelica !='0'): echo $igrejaEvangelica.' '; endif;  
								if($igrejaCatolica !='0'): echo $igrejaCatolica.' '; endif;  
								if($templo !='0'): echo $templo.' '; endif;  
								if($parque !='0'): echo $parque.' '; endif;  
								if($onibus !='0'): echo $onibus.' '; endif;  
								if($postoGasolina !='0'): echo $postoGasolina.' '; endif;  
								if($postoSaude !='0'): echo $postoSaude.' '; endif;  
								if($hospital !='0'): echo $hospital.' '; endif;  
								if($escola1grau !='0'): echo $escola1grau.' '; endif;  
								if($escola2grau !='0'): echo $escola2grau.' '; endif;  
								if($faculdade !='0'): echo $faculdade.' '; endif;  
								if($creche !='0'): echo $creche.' '; endif;  
							?>							
						</p>
					</div>
				</div>
				<?php endif; ?>
				
				<?php  if($observacoes): ?>
				<div class="clearfix">&nbsp;</div>
				
				<div class="row">
					<div class="medium-12 columns">
						<h5>OBSERVAÇÕES</h5>
						<p>
							<?php 
								echo $observacoes;  
							?>							
						</p>
					</div>
				</div>
				<?php  endif; ?>
				
				<div class="clearfix">&nbsp;</div>
				
				<?php if($fotos): ?>
				<div class="row">
					<div class="medium-12 columns">
						<h5>FOTOS DO IMÓVEL</h5>
						<ul data-clearing>
						<?php foreach($fotos as $foto): ?>
							<li><img src="<?php echo base_url() ?>/fotos-imoveis/<?php echo $foto -> foto ?>" width="200" data-caption="<?php echo $foto -> legenda ?>" class="foto-imovel" /></li>
						<?php endforeach; ?>							
						</ul>
					</div>
				</div>
				<?php endif; ?>





				<div id="formAmigo" class="reveal-modal tiny" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
				  <h2 id="modalTitle">Indicar oferta.</h2>
				  <p>Preencha o formulário abaixo para enviar esta oferta para um amigo.</p>
				  <form id="formulario">
				  	<div class="row">
				  		<div class="medium-6 columns">
				  			<label>
				  				Nome do amigo:
						  		<input type="text" name="nomeAmigo" />
				  			</label>
				  		</div>
				  		<div class="medium-6 columns">
				  			<label>
				  				E-mail do amigo:
						  		<input type="text" name="emailAmigo" />
				  			</label>
				  		</div>
				  	</div>
				  	<div class="row">
				  		<div class="medium-6 columns">
				  			<label>
				  				Seu nome:
						  		<input type="text" name="nome" />
				  			</label>
				  		</div>
				  		<div class="medium-6 columns">
				  			<label>
				  				Seu e-mail:
						  		<input type="text" name="email" />
				  			</label>
				  		</div>
				  	</div>
					<div class="clearfix">&nbsp;</div>
					
				  	<input type="hidden" name="url" value="<?php echo base_url(uri_string()); ?>" />
				  	<input type="submit" class="button colibri tiny right" value="Enviar E-mail" />
				  	
				  </form>
				  <p id="status">Enviando...</p>
				  <p id="sucessoEnvio">Enviado com Sucesso</p>
				  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
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
				var validator = $("#formulario").validate({
					rules : {
						nome : {
							required : true,
							minlength : 2
						},
						email : {
							required : true,
							email : true
						},
						nomeAmigo : {
							required : true,
							minlength : 2
						},
						emailAmigo : {
							required : true,
							email : true
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
						nomeAmigo : {
							required : "Digite o nome do amigo",
							minLength : "O seu nome deve conter, no mínimo, 2 caracteres"
						},
						emailAmigo : {
							required : "Digite o e-mail do amigo",
							email : "Digite um e-mail válido"
						}
						
					},
		
					submitHandler : function(form) {
						var dados = $(form).serialize();
						$('#status').show();
						$.ajax({
							type : "POST",
							url : "<?php echo base_url(); ?>imoveis/envia_email",
							data : dados,
							success : function(data) {						
								$('#sucessoEnvio').show();
								$('#status').hide();
								$('#formulario').each (function(){
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