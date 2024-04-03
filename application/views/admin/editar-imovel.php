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



						<h4>Cadastrar Novo Imóvel</h4>
						<?php
							if ($this -> session -> flashdata('sucesso')) {
								echo '<div class="alert-box success">' . $this -> session -> flashdata('sucesso') . '<a href="" class="close">&times;</a></div>';
							}
						?>
						<form action="<?php echo base_url() ?>admin/atualizar-imovel" method="post" enctype="multipart/form-data">
							
						
							<div class="row">
								<div class="medium-6 columns">
									<label>Código Único (Código para localizar o imóvel)
										<input type="text" name="codunico" id="codunico" value="<?php echo $codunico ?>" />
									</label>
								</div>
								<div class="medium-6 columns">
									<label>Valor
										<input type="text" name="valor" id="valor" value="<?php echo number_format($valor, 2, ",", ".") ?>" />
									</label>
								</div>
							</div>
							<div class="row">
								<div class="medium-6 columns">
									<label>Tipo de imóvel
										<select name="tipo">
											<option value="<?php echo $tipoAtual ?>"><?php echo $tipoAtual ?></option>
											<option value="<?php echo $tipoAtual ?>">&nbsp;</option>
											<?php foreach($tipos as $tipo): ?>
											<option value="<?php echo $tipo->tipo ?>"><?php echo $tipo->tipo ?></option>
											<?php endforeach; ?>
										</select>
									</label>
								</div>
								<div class="medium-6 columns">
									<label>Negócio
										<select name="negocio">
											<option value="<?php echo $negocioAtual ?>"><?php echo $negocioAtual ?></option>
											<option value="<?php echo $negocioAtual ?>">&nbsp;</option>
											<?php foreach($negocios as $negocio): ?>
											<option value="<?php echo $negocio->negocio ?>"><?php echo $negocio->negocio ?></option>
											<?php endforeach; ?>
										</select>
									</label>
								</div>
							</div>
							<div class="row">
								<div class="medium-12 columns">
									<label>Endereço
										<input type="text" name="endereco" id="endereco" value="<?php echo $endereco ?>" />
									</label>
								</div>
							</div>
							<div class="row">
								<div class="medium-6 columns">
									<label>Cidade
										<select name="cidade" id="cidade">
											<option value="<?php echo $cidadeAtual ?>"><?php echo $cidadeAtual ?></option>
											<option value="<?php echo $cidadeAtual ?>">&nbsp;</option>
											<?php foreach($cidades as $cidade): ?>
											<option value="<?php echo $cidade->cidade ?>"><?php echo $cidade->cidade ?></option>
											<?php endforeach; ?>										
										</select>
									</label>
								</div>
								<div class="medium-6 columns">
									<label>Bairro
										<select name="bairro" id="bairro">
											<option value="<?php echo $bairroAtual ?>"><?php echo $bairroAtual ?></option>
											<option value="<?php echo $bairroAtual ?>">&nbsp;</option>
										</select>
									</label>
								</div>
							</div>
							<div class="row">
								<div class="medium-6 columns">
									<div class="row">
										<div class="medium-6 columns">
											<label>Área total</label>		
											<div class="row">
												<div class="medium-6 columns">
													<input type="text" name="areaTotal" value="<?php echo $areaTotal ?>" />		
												</div>
												<div class="medium-6 columns">
													<select name="medidaAreaTotal">
														<option value="m²" <?php if($medidaAreaTotal =='m²'): echo 'selected="selected"'; endif; ?>>m²</option>
														<option value="ha" <?php if($medidaAreaTotal =='ha'): echo 'selected="selected"'; endif; ?>>ha</option>
													</select>		
												</div>
											</div>
										</div>
										<div class="medium-6 columns">
											<label>Área construída</label>
											<div class="row">
												<div class="medium-6 columns">
													<input type="text" name="areaCons" value="<?php echo $areaCons ?>" />		
												</div>
												<div class="medium-6 columns">
													<select name="medidaAreaCons">
														<option value="m²" <?php if($medidaAreaCons =='m²'): echo 'selected="selected"'; endif; ?>>m²</option>
														<option value="ha" <?php if($medidaAreaCons =='ha'): echo 'selected="selected"'; endif; ?>>ha</option>
													</select>		
												</div>
											</div>												
										</div>
									</div>
								</div>
								
								<div class="medium-6 columns">
									<div class="row">
										<div class="medium-6 columns">
											<label>Imóvel em Destaque?</label>
											<div class="row">
												<div class="medium-1 columns">
													<input type="radio" name="destaque" value="Sim" <?php if($destaque=='Sim'): echo 'checked="checked"'; endif; ?> />		
												</div>
												<div class="medium-4 columns">
													Sim		
												</div>
												<div class="medium-1 columns">
													<input type="radio" name="destaque" value="Não"  <?php if($destaque=='Não'): echo 'checked="checked"'; endif; ?>/>		
												</div>
												<div class="medium-4 columns end">
													Não
												</div>
											</div>
										</div>
										<div class="medium-6 columns">
											<label>Status do Imóvel</label>
											<select name="status">
												<option value="0"></option>
												<option value="Vendido" <?php if($status=='Vendido'): echo 'selected="selected"'; endif; ?>>Vendido</option>
												<option value="Alugado" <?php if($status=='Alugado'): echo 'selected="selected"'; endif; ?>>Alugado</option>
												<option value="Oferta" <?php if($status=='Oferta'): echo 'selected="selected"'; endif; ?>>Oferta</option>
												<option value="Oportunidade" <?php if($status=='Oportunidade'): echo 'selected="selected"'; endif; ?>>Oportunidade</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="medium-12 columns">
									<label> Imagem de Destaque (Esta é a foto que irá aparecer na chamada do imóvel)
										<input type="file" name="arquivo">
									</label>
								</div>
							</div>
							
							<h5>Dependências</h5>
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-4 columns">
											<select class="margin0" name="dormitorios">
												<option value="0">0</option>
												<option value="1 dormitório;" <?php if($dormitorios =='1 dormitório;'): echo 'selected="selected"'; endif; ?>>1</option>
												<option value="2 dormitórios;" <?php if($dormitorios =='2 dormitórios;'): echo 'selected="selected"'; endif; ?>>2</option>
												<option value="3 dormitórios;" <?php if($dormitorios =='3 dormitórios;'): echo 'selected="selected"'; endif; ?>>3</option>
												<option value="4 dormitórios;" <?php if($dormitorios =='4 dormitórios;'): echo 'selected="selected"'; endif; ?>>4</option>
												<option value="5 dormitórios;" <?php if($dormitorios =='5 dormitórios;'): echo 'selected="selected"'; endif; ?>>5</option>
												<option value="6 dormitórios;" <?php if($dormitorios =='6 dormitórios;'): echo 'selected="selected"'; endif; ?>>6</option>
												<option value="7 dormitórios;" <?php if($dormitorios =='7 dormitórios;'): echo 'selected="selected"'; endif; ?>>7</option>
												<option value="8 dormitórios;" <?php if($dormitorios =='8 dormitórios;'): echo 'selected="selected"'; endif; ?>>8</option>
												<option value="9 dormitórios;" <?php if($dormitorios =='9 dormitórios;'): echo 'selected="selected"'; endif; ?>>9</option>
												<option value="10 dormitórios;" <?php if($dormitorios =='10 dormitórios;'): echo 'selected="selected"'; endif; ?>>10</option>
											</select>
										</div>
										<div class="medium-8 columns">
											dormitórios
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-4 columns">
											sendo 
										</div>
										<div class="medium-4 columns">
											<select class="margin0" name="suites">
												<option value="0">0</option>
												<option value="sendo 1 suíte;" <?php if($suites =='sendo 1 suíte;'): echo 'selected="selected"'; endif; ?>>1</option>
												<option value="sendo 2 suítes;" <?php if($suites =='sendo 2 suítes;'): echo 'selected="selected"'; endif; ?>>2</option>
												<option value="sendo 3 suítes;" <?php if($suites =='sendo 3 suítes;'): echo 'selected="selected"'; endif; ?>>3</option>
												<option value="sendo 4 suítes;" <?php if($suites =='sendo 4 suítes;'): echo 'selected="selected"'; endif; ?>>4</option>
												<option value="sendo 5 suítes;" <?php if($suites =='sendo 5 suítes;'): echo 'selected="selected"'; endif; ?>>5</option>
												<option value="sendo 6 suítes;" <?php if($suites =='sendo 6 suítes;'): echo 'selected="selected"'; endif; ?>>6</option>
												<option value="sendo 7 suítes;" <?php if($suites =='sendo 7 suítes;'): echo 'selected="selected"'; endif; ?>>7</option>
												<option value="sendo 8 suítes;" <?php if($suites =='sendo 8 suítes;'): echo 'selected="selected"'; endif; ?>>8</option>
												<option value="sendo 9 suítes;" <?php if($suites =='sendo 9 suítes;'): echo 'selected="selected"'; endif; ?>>9</option>
												<option value="sendo 10 suítes;" <?php if($suites =='sendo 10 suítes;'): echo 'selected="selected"'; endif; ?>>10</option>
											</select>
										</div>
										<div class="medium-4 columns">
											suítes
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-4 columns">
											<select class="margin0" name="banheiros">
												<option value="0">0</option>
												<option value="1 banheiro;" <?php if($banheiros =='1 banheiro;'): echo 'selected="selected"'; endif; ?>>1</option>
												<option value="2 banheiros;" <?php if($banheiros =='2 banheiros;'): echo 'selected="selected"'; endif; ?>>2</option>
												<option value="3 banheiros;" <?php if($banheiros =='3 banheiros;'): echo 'selected="selected"'; endif; ?>>3</option>
												<option value="4 banheiros;" <?php if($banheiros =='4 banheiros;'): echo 'selected="selected"'; endif; ?>>4</option>
												<option value="5 banheiros;" <?php if($banheiros =='5 banheiros;'): echo 'selected="selected"'; endif; ?>>5</option>
												<option value="6 banheiros;" <?php if($banheiros =='6 banheiros;'): echo 'selected="selected"'; endif; ?>>6</option>
												<option value="7 banheiros;" <?php if($banheiros =='7 banheiros;'): echo 'selected="selected"'; endif; ?>>7</option>
												<option value="8 banheiros;" <?php if($banheiros =='8 banheiros;'): echo 'selected="selected"'; endif; ?>>8</option>
												<option value="9 banheiros;" <?php if($banheiros =='9 banheiros;'): echo 'selected="selected"'; endif; ?>>9</option>
												<option value="10 banheiros;" <?php if($banheiros =='10 banheiros;'): echo 'selected="selected"'; endif; ?>>10</option>
											</select>
										</div>
										<div class="medium-8 columns">
											banheiros
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-4 columns">
											garagem
										</div>
										<div class="medium-4 columns">
											<select class="margin0" name="garagem">
												<option value="0">0</option>
												<option value="garagem para 1 carro" <?php if($garagem =='garagem para 1 carro'): echo 'selected="selected"'; endif; ?>>1</option>
												<option value="garagem para 2 carros" <?php if($garagem =='garagem para 2 carros'): echo 'selected="selected"'; endif; ?>>2</option>
												<option value="garagem para 3 carros" <?php if($garagem =='garagem para 3 carros'): echo 'selected="selected"'; endif; ?>>3</option>
												<option value="garagem para 4 carros" <?php if($garagem =='garagem para 4 carros'): echo 'selected="selected"'; endif; ?>>4</option>
												<option value="garagem para 5 carros" <?php if($garagem =='garagem para 5 carros'): echo 'selected="selected"'; endif; ?>>5</option>
												<option value="garagem para 6 carros" <?php if($garagem =='garagem para 6 carros'): echo 'selected="selected"'; endif; ?>>6</option>
												<option value="garagem para 7 carros" <?php if($garagem =='garagem para 7 carros'): echo 'selected="selected"'; endif; ?>>7</option>
												<option value="garagem para 8 carros" <?php if($garagem =='garagem para 8 carros'): echo 'selected="selected"'; endif; ?>>8</option>
												<option value="garagem para 9 carros" <?php if($garagem =='garagem para 9 carros'): echo 'selected="selected"'; endif; ?>>9</option>
												<option value="garagem para 10 carros" <?php if($garagem =='garagem para 10 carros'): echo 'selected="selected"'; endif; ?>>10</option>
											</select>
										</div>
										<div class="medium-4 columns">
											carros
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="salaTv" <?php if($salaTv !='0'): echo 'checked="checked"'; endif; ?>/>
										</div>
										<div class="medium-10 columns end">
											Sala de TV
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="salaEstar" <?php if($salaEstar !='0'): echo 'checked="checked"'; endif; ?>/>
										</div>
										<div class="medium-10 columns end">
											Sala de estar
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="salaJantar"  <?php if($salaJantar !='0'): echo 'checked="checked"'; endif; ?>/>
										</div>
										<div class="medium-10 columns end">
											Sala de jantar
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="sala2ambientes" <?php if($sala2ambientes !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											sala com 2 ambientes
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="cozinha"  <?php if($cozinha !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Cozinha
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="cozinhaPlanejada" <?php if($cozinhaPlanejada !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Cozinha planejada
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="cozinhaAmericana" <?php if($cozinhaAmericana !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Cozinha americana
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="cozinhaMineira" <?php if($cozinhaMineira !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Cozinha mineira
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="lavabo" <?php if($lavabo !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Lavabo
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="areaServico" <?php if($areaServico !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Área de Serviço
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="quartoEmpregada" <?php if($quartoEmpregada !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Quarto Empregada
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="quintal" <?php if($quintal !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Quintal
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="copa"  <?php if($copa !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Copa
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="escritorio"  <?php if($escritorio !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Escritório
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="despensa"  <?php if($despensa !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Despensa
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="porao" <?php if($porao !='0'): echo 'checked="checked"'; endif; ?>  />
										</div>
										<div class="medium-10 columns end">
											Porão
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							<h5>Detalhes</h5>
							
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="piscina" <?php if($piscina !='0'): echo 'checked="checked"'; endif; ?>  />
										</div>
										<div class="medium-10 columns end">
											Piscina
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="churrasqueira" <?php if($churrasqueira !='0'): echo 'checked="checked"'; endif; ?>  />
										</div>
										<div class="medium-10 columns end">
											Churrasqueira
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="jardim" <?php if($jardim !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Jardim com grama
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="jardimInverno" <?php if($jardimInverno !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Jardim de inverno
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="areaLazer" <?php if($areaLazer !='0'): echo 'checked="checked"'; endif; ?>/>
										</div>
										<div class="medium-10 columns end">
											Área de Lazer
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="salaoJogos" <?php if($salaoJogos !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Salão de jogos
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="sauna" <?php if($sauna !='0'): echo 'checked="checked"'; endif; ?>/>
										</div>
										<div class="medium-10 columns end">
											Sauna
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="hidromassagem" <?php if($hidromassagem !='0'): echo 'checked="checked"'; endif; ?>/>
										</div>
										<div class="medium-10 columns end">
											Hidromassagem
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="ofuroJacuzi" <?php if($ofuroJacuzi !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Ofurô / Jacuzi
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="gourmet" <?php if($gourmet !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Espaço Goumet
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="sacada" <?php if($sacada !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Sacada
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="varanda"  <?php if($varanda !='0'): echo 'checked="checked"'; endif; ?>/>
										</div>
										<div class="medium-10 columns end">
											Varanda
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="portaoEletronico" <?php if($portaoEletronico !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Portão Eletrônico
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="interfone" <?php if($interfone !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Interfone
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="aquecedorSolar" <?php if($aquecedorSolar !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Aquecedor solar
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="cercaEletrica" <?php if($cercaEletrica !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Cerca Elétrica
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							
							
							<h5>O que tem perto</h5>
							
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="farmacia" <?php if($farmacia !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Farmárcia
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="supermercado"  <?php if($supermercado !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Supermercado
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="mercado"  <?php if($mercado !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Mercado
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="padaria"  <?php if($padaria !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Padaria
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="acougue"  <?php if($acougue !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Açougue
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="pizzaria"  <?php if($pizzaria !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Pizzaria
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="restaurante"  <?php if($restaurante !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Restaurante
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="lanchonete"  <?php if($lanchonete !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Lanchonete
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="igrejaEvangelica" <?php if($igrejaEvangelica !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Igreja Evangélica
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="igrejaCatolica" <?php if($igrejaCatolica !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Igreja Católica
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="templo" <?php if($templo !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Templo
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="parque" <?php if($parque !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Praça/Parque/Clube
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="onibus"  <?php if($onibus !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Ponto de ônibus
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="postoGasolina" <?php if($postoGasolina !='0'): echo 'checked="checked"'; endif; ?>  />
										</div>
										<div class="medium-10 columns end">
											Posto de Gasolina
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="postoSaude"  <?php if($postoSaude !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Posto de Saúde
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="hospital" <?php if($hospital !='0'): echo 'checked="checked"'; endif; ?>  />
										</div>
										<div class="medium-10 columns end">
											Hospital
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							<!-- Linha -->
							<div class="row collapse">
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="escola1grau" <?php if($escola1grau !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Escola de 1º Grau
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="escola2grau"  <?php if($escola2grau !='0'): echo 'checked="checked"'; endif; ?> />
										</div>
										<div class="medium-10 columns end">
											Escola de 2º Grau
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="faculdade" <?php if($faculdade !='0'): echo 'checked="checked"'; endif; ?>/>
										</div>
										<div class="medium-10 columns end">
											Faculdade
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
								<!-- Coluna -->
								<div class="medium-3 columns panel">
									<div class="row">
										<div class="medium-1 columns">
											<input type="checkbox" class="margin0" name="creche"  <?php if($creche !='0'): echo 'checked="checked"'; endif; ?>/>
										</div>
										<div class="medium-10 columns end">
											Creche
										</div>
									</div>
								</div>
								<!-- FIM Coluna -->
							</div>
							<!-- FIM Linha -->
							
							<h5>Observações / Informações Adicionais</h5>
							<div class="row">
								<div class="medium-12 columns text-center">
									<textarea rows="3" name="observacoes"><?php echo $observacoes; ?></textarea>
								</div>
							</div>
							
							<div class="row">
								<div class="medium-12 columns text-center">
									<input type="hidden" name="idImovel" value="<?php echo $idImovel ?>" />
									<input type="button" name="Cancelar" value="Cancelar" onclick="javascript:history.back();" class="button alert" />
									<input type="submit" class="button" value="Atualizar Imóvel" />
								</div>
							</div>
						
						</form>

					</div>		
					
					
					
				</div>
			</div>
		</div>


		<!-- Include Scripts -->
		<?php $this->load->view('admin/scripts'); ?>
		<script src="<?php echo base_url(); ?>js/jquery.maskMoney.js"></script>
		<script>
			$("#valor").maskMoney({thousands:'.', decimal:','});
		</script>
		<script>
			var path = '<?php echo base_url(); ?>';
		</script>
		<script>
		
		
			$(document).ready(function() {
		
				$("select[name=cidade]").change(function() {
		
					var cidade = $(this).val();
		
					resetaCombo('bairro');
		
					$.ajax({
						type : 'POST',
						url : path + 'admin/lista_bairros/' + cidade,
						success : function(data) {
		
							var opts = "";
							for (var i = 0; i < data.length; i++) {
								opts += "<option value='" + data[i].bairro + "'>" + data[i].bairro + "</option>";
							}
							$("#bairro").append(opts);
		
							//alert(data);
		
						}
					});
				});
				

			});
			
			function resetaCombo(el) {
				$("select[name='" + el + "']").empty();
				var option = document.createElement('option');
				$(option).attr({
					value : ''
				});
				$(option).append('Selecione o Bairro');
				$("select[name='" + el + "']").append(option);
			}
			
		</script>
		
		

	</body>
</html>