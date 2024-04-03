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



						<h4>Cadastrar Nova Cidade</h4>
						<?php
							if ($this -> session -> flashdata('sucesso')) {
								echo '<div class="alert-box success">' . $this -> session -> flashdata('sucesso') . '</div>';
							}
						?>
						<form method="post" action="<?php echo base_url() ?>admin/cadastrar-cidade" enctype="multipart/form-data" id="formulario">
							<div class="row">
								<div class="medium-6 columns">
									<label>Nome da Cidade
										<input type="text" name="cidade" id="cidade" />
									</label>
								</div>
								<div class="medium-2 columns end">
									<label>Estado
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
									</label>
								</div>
							</div>
							<div class="row">
								<div class="medium-12 columns">
									<input type="submit" class="button" value="Cadastrar" />
								</div>
							</div>
						</form>
						
						<h4>Cidades Cadastradas</h4>
						<?php
						if ($this -> session -> flashdata('deleteok')):
							echo '<div class="alert-box success">' . $this -> session -> flashdata('deleteok') . '</div>';
						endif;
						
						if ($cidades):
							$this -> table -> set_heading('Cidade', '');
							foreach ($cidades as $cidade) :
								$this -> table -> add_row($cidade -> cidade, '<a href="'.base_url().'admin/excluir-cidade/'.$cidade->idCidade.'" class="button alert [tiny small large] right margin0">Excluir</a>');
							endforeach;
							echo $this -> table -> generate();
							echo !empty($paginacao) ? $paginacao : '';
							
						else :
							echo 'Não existem registros.';
						endif;
						
						
						
						?>
						

						
						
						

					</div>		
				</div>
			</div>
		</div>


		<!-- Include Scripts -->
		<?php $this->load->view('admin/scripts'); ?>
		<script>
			$(document).ready(function() {
				var validator = $("#formulario").validate({
					rules : {
						cidade : {
							required : true,
							minlength : 3
						}
					},
		
					messages : {
						cidade : {
							required : "Digite o nome da cidade",
							minLength : "A cidade de conter, no mínimo, 3 caracteres"
						}
					},
					
				});
			});
		</script>
		
		

	</body>
</html>