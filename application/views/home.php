<!doctype html>
<html class="no-js" lang="pt-br">
	<head>
		<?php $this -> load -> view('includes/head'); ?>
		<link rel="stylesheet" href="<?php echo base_url() ?>css/slick.css" />
	</head>
	<body>

		<!-- Topo -->
		<?php $this -> load -> view('includes/menu'); ?>
		
		<!-- Banner -->
		<?php $this -> load -> view('includes/banners'); ?>
		
		<div class="clefix">&nbsp;</div>
		
		<!-- Busca -->
		<?php $this -> load -> view('includes/busca'); ?>
		
		<div class="row.full">
			<div class="medium-12 columns mrg0">
				<hr class="hr-lr5">
			</div>
		</div>
		<div class="clefix">&nbsp;</div>

		<div class="row">
			<div class="medium-12 columns">
				<div class="row destaques-imoveis">
					<h1>IMÓVEIS EM DESTAQUE</h1>
					<?php foreach($destaques as $destaque): ?>
						<div class="medium-12 columns">
							<div class="row">
								<div class="medium-6 columns">
									<?php if($destaque -> status == 'Vendido'): ?>
										<img src="<?php echo base_url() ?>/images/btn-vendido.png" style="position: absolute" />
									<?php elseif($destaque -> status == 'Alugado'): ?>	
										<img src="<?php echo base_url() ?>/images/btn-alugado.png" style="position: absolute" />
									<?php elseif($destaque -> status == 'Oferta'): ?>	
										<img src="<?php echo base_url() ?>/images/btn-oferta.png" style="position: absolute" />
									<?php elseif($destaque -> status == 'Oportunidade'): ?>	
										<img src="<?php echo base_url() ?>/images/btn-oportunidade.png" style="position: absolute" />
									<?php endif; ?>
									
									<?php if($destaque -> capa != '0'): ?>
										<img src="<?php echo base_url() ?>images/ico-mais-detalhes-foto.png" style="position: absolute;" />
										<a href="<?php echo base_url() ?>imoveis/detalhe_imovel/<?php echo $destaque -> CodUnico ?>"><img src="./fotos-imoveis/<?php echo $destaque -> capa ?>" /></a>
									<?php else: ?>
										<img src="<?php echo base_url() ?>images/ico-mais-detalhes-foto.png" style="position: absolute;" />
										<a href="<?php echo base_url() ?>imoveis/detalhe_imovel/<?php echo $destaque -> CodUnico ?>"><img src="./images/sem-foto-cadastrada.jpg" /></a>										
									<?php endif; ?>
								</div>
								<div class="medium-6 columns text-left">
									<h3 class="color-az"><?php echo $destaque -> tipo ?></h3>
									<span><?php echo $destaque -> negocio ?> - cód.: <span class="bold color-az"><?php echo $destaque -> CodUnico ?></span></span><br />
									<?php if($destaque -> dormitorios != '0'): ?><span><?php echo $destaque -> dormitorios ?> </span><br /><?php else: ?><?php endif; ?>
									<span><?php echo $destaque -> cidade ?></span>
									<h3 class="color-az">R$ <?php echo number_format($destaque -> valor, 2, ",", ".") ?></h3>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		
		
		<div class="clearfix">&nbsp;</div>
		<div class="row">
			<div class="medium-12 columns">
				<hr class="hr-az">
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
		
		
		
		<div class="row">
			<div class="medium-12 medium-centered columns">
				<h1 class="color-cz">OUTROS IMÓVEIS</h1>
				
				<!-- Linha Imóvel -->
				<div class="row">
					<!-- Imovel -->	
					<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-3">
					<?php foreach($imoveis as $imovel1): ?>
					<li>
						<div class="row">
							<div class="medium-6 columns">
								<?php if($imovel1 -> status == 'Vendido'): ?>
									<img src="<?php echo base_url() ?>images/btn-vendido.png" style="position: absolute" />
								<?php elseif($imovel1 -> status == 'Alugado'): ?>	
									<img src="<?php echo base_url() ?>images/btn-alugado.png" style="position: absolute" />
								<?php elseif($imovel1 -> status == 'Oferta'): ?>	
									<img src="<?php echo base_url() ?>images/btn-oferta.png" style="position: absolute" />
								<?php elseif($imovel1 -> status == 'Oportunidade'): ?>	
									<img src="<?php echo base_url() ?>images/btn-oportunidade.png" style="position: absolute" />
								<?php endif; ?>
								
								<?php if($imovel1 -> capa != '0'): ?>
									<img src="<?php echo base_url() ?>images/ico-mais-detalhes-foto.png" style="position: absolute;" />
									<a href="<?php echo base_url() ?>imoveis/detalhe_imovel/<?php echo $imovel1 -> CodUnico ?>"><img src="./fotos-imoveis/<?php echo $imovel1 -> capa ?>" /></a>
								<?php else: ?>
									<img src="<?php echo base_url() ?>images/ico-mais-detalhes-foto.png" style="position: absolute;" />
									<a href="<?php echo base_url() ?>imoveis/detalhe_imovel/<?php echo $imovel1 -> CodUnico ?>"><img src="./images/sem-foto-cadastrada.jpg" /></a>										
								<?php endif; ?>
							</div>		
							<div class="medium-6 columns">
								<h4 class="color-az"><?php echo $imovel1 -> tipo ?></h4>
								<span><?php echo $imovel1 -> negocio ?> <br/> Cód.: <span class="bold color-az"><?php echo $imovel1 -> CodUnico ?></span></span><br />
								<?php if($imovel1 -> dormitorios != '0'): ?><span><?php echo $imovel1 -> dormitorios ?></span><br /><?php else: ?><?php endif; ?>
								<span><?php echo $imovel1 -> cidade ?></span>
								<h4 class="color-az">R$ <?php echo number_format($imovel1 -> valor, 2, ",", ".") ?></h4>
								   							
							</div>
						</div>
					</li>
					<?php endforeach; ?>
					</ul>
				</div>
				
				<div class="clearfix">&nbsp;</div>
				
				

			</div>
		</div>
		
		
		<div class="clearfix">&nbsp;</div>

		<?php $this -> load -> view('includes/rodape'); ?>
		
		<?php $this -> load -> view('includes/scripts'); ?>
		<script src="<?php echo base_url(); ?>js/slick.min.js"></script>
		<script>
			$(document).ready(function(){
				$('.destaques-imoveis').slick({
				  	infinite: true,
				  	slidesToShow: 2,
				  	slidesToScroll: 1,
				  	autoplay: true,
  					autoplaySpeed: 2000,
				});
			});
		</script>
	</body>
</html>