<nav class="top-bar" data-topbar role="navigation">
	<ul class="title-area">
		<li class="name">
			<h1><a href="#">Gerenciador de Conteúdo</a></h1>
		</li>
		<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
		<li class="toggle-topbar menu-icon">
			<a href="#"><span>Menu</span></a>
		</li>
	</ul>
	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="">
				<a>Bem vindo, <b><?php echo $this->session->userdata['logado']['nome']; ?></b></a>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>admin/logout" class="alert button">SAIR</a>
			</li>
		</ul>
	</section>
</nav>