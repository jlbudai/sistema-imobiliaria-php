		<div class="row">
			<div class="medium-12 medium-centered columns">
				<h1>ENCONTRE SEU IMÓVEL</h1>				
				<p>Utilize os campos abaixo para fazer sua busca ou utilize o código do imóvel no campo ao lado.</p>		
				<div class="row">
					<form method="post" action="<?php echo base_url() ?>busca/resultado">
					<div class="medium-8 columns">
						<div class="row">
							<div class="medium-1 columns">
								<span class="pad8x0 left">Negócio</span>
							</div>		
							<div class="medium-5 columns">
								<select name="negocio">
									<option value="">Selecione</option>
									<?php foreach($negocios as $negocio): ?>
									<option value="<?php echo $negocio->negocio ?>"><?php echo $negocio->negocio ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="medium-1 columns">
								<span class="pad8x0 left">Imóvel</span>
							</div>		
							<div class="medium-5 columns">
								<select name="tipo">
									<option value="">Todos os imóveis</option>
									<?php foreach($tipos as $tipo): ?>
									<option value="<?php echo $tipo->tipo ?>"><?php echo $tipo->tipo ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>						
						<div class="row">
							<div class="medium-1 columns">
								<span class="pad8x0 left">Cidade</span>
							</div>		
							<div class="medium-5 columns">
								<select name="cidade" id="cidade">
									<option value="">Todas as cidades</option>
									<?php foreach($cidades as $cidade): ?>
									<option value="<?php echo $cidade->cidade ?>"><?php echo $cidade->cidade ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="medium-1 columns">
								<span class="pad8x0 left">Bairro</span>
							</div>		
							<div class="medium-5 columns">
								<select name="bairro" id="bairro">
									<option></option>
								</select>
							</div>
						</div>						
						<div class="row">
							<div class="medium-1 columns">
								<span class="pad8x0 left">Valor</span>
							</div>		
							<div class="medium-5 columns">
								<select name="faixapreco" id="faixapreco">
									<option value="">Todos os valores</option>
									<option value="0a50000">Até R$ 50.000,00</option>";
									<option value="50000a100000">R$ 50.000,00 à R$ 100.000,00</option>
									<option value="100000a200000">R$ 100.000,00 à R$ 200.000,00</option>
									<option value="200000a300000">R$ 200.000,00 à R$ 300.000,00</option>
									<option value="300000a400000">R$ 300.000,00 à R$ 400.000,00</option>
									<option value="400000a500000">R$ 400.000,00 à R$ 500.000,00</option>
									<option value="500000a10000000">Acima de R$ 500.000,00</option>

								</select>
							</div>
							<div class="medium-6 columns text-center">
								<input type="submit" class="button colibri small" value="BUSCAR" />
							</div>
						</div>						
					</form>
					</div>		
					<div class="medium-4 columns text-center">
						<div class="busca-codigo">
							<form method="post" action="<?php echo base_url() ?>busca/codigo">
								<p>Buscar pelo código</p>
								<input type="text" name="codigo" />
								<input type="submit" class="button colibri2 small" value="BUSCAR" />
							</form>
						</div>
					</div>		
				</div>

				
			</div>
		</div>