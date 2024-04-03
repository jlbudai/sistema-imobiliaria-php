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



						<h4>Cadastrar Novo Bairro</h4>
						<?php
							if ($this -> session -> flashdata('sucesso')) {
								echo '<div class="alert-box success">' . $this -> session -> flashdata('sucesso') . '<a href="" class="close">&times;</a></div>';
							}
						?>
						
						<form method="post" action="<?php echo base_url() ?>admin/cadastrar-bairro" enctype="multipart/form-data" id="formulario">
							<div class="row">
								<div class="medium-6 columns">
									<label>Bairro
										<input type="text" name="bairro" id="bairro" />
									</label>
								</div>
								<div class="medium-6 columns">
									<label>Cidade
										<select name="cidade">
											<?php
											foreach ($cidades as $cidade):
											?>
											<option value="<?php echo $cidade->cidade ?>"><?php echo $cidade->cidade ?></option>
											<?php
											endforeach;										
											?>										
	
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
						
						<h4>Bairros Cadastrados</h4>
						
						<?php
						if ($this -> session -> flashdata('deleteok')):
							echo '<div class="alert-box success">' . $this -> session -> flashdata('deleteok') . '</div>';
						endif;
						
						if ($bairros):
							$this -> table -> set_heading('Bairro', 'Cidade', '');
							foreach ($bairros as $bairro) :
								$this -> table -> add_row($bairro -> bairro, $bairro -> cidade, '<a href="'.base_url().'admin/excluir-bairro/'.$bairro->idBairro.'" class="button alert [tiny small large] right margin0">Excluir</a>');
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
						bairro : {
							required : true,
							minlength : 3
						}
					},
		
					messages : {
						bairro : {
							required : "Digite o baiarro",
							minLength : "O bairro deve conter, no mínimo, 3 caracteres"
						}
					},
					
				});
			});
		</script>
		
		

	</body>
</html>