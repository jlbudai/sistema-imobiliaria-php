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
						
						<form action="<?php echo base_url() ?>admin/cadastrar-imovel" method="post" enctype="multipart/form-data" id="formulario">	
						
							<div class="row">
								<div class="medium-6 columns">
									<label>Código Único (Código para localizar o imóvel)
										<input type="text" name="codunico" id="codunico" />
									</label>
								</div>
								<div class="medium-6 columns">
									<label>Valor
										<input type="text" name="valor" id="valor" />
									</label>
								</div>
							</div>
							<div class="row">
								<div class="medium-6 columns">
									<label>Tipo de imóvel
										<select name="tipo">
											<?php foreach($tipos as $tipo): ?>
											<option value="<?php echo $tipo->tipo ?>"><?php echo $tipo->tipo ?></option>
											<?php endforeach; ?>
										</select>
									</label>
								</div>
								<div class="medium-6 columns">
									<label>Negócio
										<select name="negocio">
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
										<input type="text" name="endereco" id="endereco" />
									</label>
								</div>
							</div>
							<div class="row">
								<div class="medium-6 columns">
									<label>Cidade
										<select name="cidade" id="cidade">
											<option value="">Selecionar cidade</option>
											<?php foreach($cidades as $cidade): ?>
											<option value="<?php echo $cidade->cidade ?>"><?php echo $cidade->cidade ?></option>
											<?php endforeach; ?>										
										</select>
									</label>
								</div>
								<div class="medium-6 columns">
									<label>Bairro
										<select name="bairro" id="bairro"></select>
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
													<input type="text" name="areaTotal" />		
												</div>
												<div class="medium-6 columns">
													<select name="medidaAreaTotal">
														<option value="m²">m²</option>
														<option value="ha">ha</option>
													</select>		
												</div>
											</div>
										</div>
										<div class="medium-6 columns">
											<label>Área construída</label>
											<div class="row">
												<div class="medium-6 columns">
													<input type="text" name="areaCons" />		
												</div>
												<div class="medium-6 columns">
													<select name="medidaAreaCons">
														<option value="m²">m²</option>
														<option value="ha">ha</option>
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
													<input type="radio" name="destaque" value="Sim" />		
												</div>
												<div class="medium-4 columns">
													Sim		
												</div>
												<div class="medium-1 columns">
													<input type="radio" name="destaque" value="Não" checked="checked" />		
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
												<option value="Vendido">Vendido</option>
												<option value="Alugado">Alugado</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="medium-12 columns">
									<label> Imagem de Destaque (Esta é a foto que irá aparecer na chamada do imóvel)
										<input type="file" name="arquivo" />
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
												<option value="1 dormitório;">1</option>
												<option value="2 dormitórios;">2</option>
												<option value="3 dormitórios;">3</option>
												<option value="4 dormitórios;">4</option>
												<option value="5 dormitórios;">5</option>
												<option value="6 dormitórios;">6</option>
												<option value="7 dormitórios;">7</option>
												<option value="8 dormitórios;">8</option>
												<option value="9 dormitórios;">9</option>
												<option value="10 dormitórios;">10</option>
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
												<option value="sendo 1 suíte;">1</option>
												<option value="sendo 2 suítes;">2</option>
												<option value="sendo 3 suítes;">3</option>
												<option value="sendo 4 suítes;">4</option>
												<option value="sendo 5 suítes;">5</option>
												<option value="sendo 6 suítes;">6</option>
												<option value="sendo 7 suítes;">7</option>
												<option value="sendo 8 suítes;">8</option>
												<option value="sendo 9 suítes;">9</option>
												<option value="sendo 10 suítes;">10</option>
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
												<option value="1 banheiro;">1</option>
												<option value="2 banheiros;">2</option>
												<option value="3 banheiros;">3</option>
												<option value="4 banheiros;">4</option>
												<option value="5 banheiros;">5</option>
												<option value="6 banheiros;">6</option>
												<option value="7 banheiros;">7</option>
												<option value="8 banheiros;">8</option>
												<option value="9 banheiros;">9</option>
												<option value="10 banheiros;">10</option>
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
												<option value="garagem para 1 carro;">1</option>
												<option value="garagem para 2 carros;">2</option>
												<option value="garagem para 3 carros;">3</option>
												<option value="garagem para 4 carros;">4</option>
												<option value="garagem para 5 carros;">5</option>
												<option value="garagem para 6 carros;">6</option>
												<option value="garagem para 7 carros;">7</option>
												<option value="garagem para 8 carros;">8</option>
												<option value="garagem para 9 carros;">9</option>
												<option value="garagem para 10 carros;">10</option>
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
											<input type="checkbox" class="margin0" name="salaTv"  />
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
											<input type="checkbox" class="margin0" name="salaEstar"  />
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
											<input type="checkbox" class="margin0" name="salaJantar"  />
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
											<input type="checkbox" class="margin0" name="sala2ambientes"  />
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
											<input type="checkbox" class="margin0" name="cozinha"  />
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
											<input type="checkbox" class="margin0" name="cozinhaPlanejada"  />
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
											<input type="checkbox" class="margin0" name="cozinhaAmericana"  />
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
											<input type="checkbox" class="margin0" name="cozinhaMineira"  />
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
											<input type="checkbox" class="margin0" name="lavabo" />
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
											<input type="checkbox" class="margin0" name="areaServico" />
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
											<input type="checkbox" class="margin0" name="quartoEmpregada" />
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
											<input type="checkbox" class="margin0" name="quintal"  />
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
											<input type="checkbox" class="margin0" name="copa" />
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
											<input type="checkbox" class="margin0" name="escritorio" />
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
											<input type="checkbox" class="margin0" name="despensa" />
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
											<input type="checkbox" class="margin0" name="porao" />
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
											<input type="checkbox" class="margin0" name="piscina"  />
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
											<input type="checkbox" class="margin0" name="churrasqueira" />
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
											<input type="checkbox" class="margin0" name="jardim" />
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
											<input type="checkbox" class="margin0" name="jardimInverno" />
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
											<input type="checkbox" class="margin0" name="areaLazer" />
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
											<input type="checkbox" class="margin0" name="salaoJogos" />
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
											<input type="checkbox" class="margin0" name="sauna" />
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
											<input type="checkbox" class="margin0" name="hidromassagem" />
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
											<input type="checkbox" class="margin0" name="ofuroJacuzi" />
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
											<input type="checkbox" class="margin0" name="gourmet" />
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
											<input type="checkbox" class="margin0" name="sacada" />
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
											<input type="checkbox" class="margin0" name="varanda" />
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
											<input type="checkbox" class="margin0" name="portaoEletronico" />
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
											<input type="checkbox" class="margin0" name="interfone" />
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
											<input type="checkbox" class="margin0" name="aquecedorSolar" />
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
											<input type="checkbox" class="margin0" name="cercaEletrica" />
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
											<input type="checkbox" class="margin0" name="farmacia" />
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
											<input type="checkbox" class="margin0" name="supermercado" />
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
											<input type="checkbox" class="margin0" name="mercado" />
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
											<input type="checkbox" class="margin0" name="padaria" />
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
											<input type="checkbox" class="margin0" name="acougue" />
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
											<input type="checkbox" class="margin0" name="pizzaria" />
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
											<input type="checkbox" class="margin0" name="restaurante" />
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
											<input type="checkbox" class="margin0" name="lanchonete" />
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
											<input type="checkbox" class="margin0" name="igrejaEvangelica" />
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
											<input type="checkbox" class="margin0" name="igrejaCatolica" />
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
											<input type="checkbox" class="margin0" name="templo" />
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
											<input type="checkbox" class="margin0" name="parque" />
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
											<input type="checkbox" class="margin0" name="onibus" />
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
											<input type="checkbox" class="margin0" name="postoGasolina" />
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
											<input type="checkbox" class="margin0" name="postoSaude" />
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
											<input type="checkbox" class="margin0" name="hospital" />
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
											<input type="checkbox" class="margin0" name="escola1grau" />
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
											<input type="checkbox" class="margin0" name="escola2grau" />
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
											<input type="checkbox" class="margin0" name="faculdade" />
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
											<input type="checkbox" class="margin0" name="creche" />
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
									<textarea rows="3" name="observacoes"></textarea>
								</div>
							</div>
							
							<div class="row">
								<div class="medium-12 columns text-center">
									<input type="submit" class="button" value="Cadastrar Imóvel" />
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
				
				//VALIDAÇÃO
				var validator = $("#formulario").validate({
					rules : {
						codunico : {
							required : true,
							minlength : 4
						}
					},
		
					messages : {
						codunico : {
							required : "Digite o código do imóvel",
							minLength : "O Código Único deve conter, no mínimo, 4 caracteres"
						}
					},
					
				});
				
				
				
				
				//BAIRROS
		
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