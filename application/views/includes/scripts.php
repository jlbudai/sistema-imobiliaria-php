		<script src="<?php echo base_url(); ?>js/vendor/jquery.js"></script>
		<script src="<?php echo base_url(); ?>js/foundation.min.js"></script>
		<script>
			var path = '<?php echo base_url(); ?>';
		</script>
		<script>
			$(document).foundation();

			$(document).ready(function() {
				$('#btn-topo').hide();

				$('#btn-topo').click(function() {
					$('body,html').animate({
						scrollTop : 0
					}, 800);
					return false;
				});
				
				
				
				$(window).scroll(function() {
				    if ($(this).scrollTop() > 200) {
				        $('#btn-topo').fadeIn();
				    } else {
				        $('#btn-topo').fadeOut();
				    }
				});
				
				
				
				$("select[name=negocio]").change(function() {
		
					var negocio = $(this).val();

					resetaValor('faixapreco');
					
					if (negocio == 'Venda') {
						var valor = "";
						valor += "<option value=\"0a50000\">Até R$ 50.000,00</option>";
						valor += "<option value=\"50000a100000\">R$ 50.000,00 à R$ 100.000,00</option>";
						valor += "<option value=\"100000a200000\">R$ 100.000,00 à R$ 200.000,00</option>";
						valor += "<option value=\"200000a300000\">R$ 200.000,00 à R$ 300.000,00</option>";
						valor += "<option value=\"300000a400000\">R$ 300.000,00 à R$ 400.000,00</option>";
						valor += "<option value=\"400000a500000\">R$ 400.000,00 à R$ 500.000,00</option>";
						valor += "<option value=\"500000a10000000\">Acima de R$ 500.000,00</option>";
					}else{
						var valor = "";
						valor += "<option value=\"0a500\">Até R$ 500,00</option>";
						valor += "<option value=\"500a1000\">R$ 500,00 à R$ 1.000,00</option>";
						valor += "<option value=\"1000a1500\">R$ 1.000,00 à R$ 1.500,00</option>";
						valor += "<option value=\"1500a2000\">R$ 1.500,00 à R$ 2.000,00</option>";
						valor += "<option value=\"2000a3000\">R$ 2.000,00 à R$ 3.000,00</option>";
						valor += "<option value=\"3000a4000\">R$ 3.000,00 à R$ 4.000,00</option>";
						valor += "<option value=\"4000a5000\">R$ 4.000,00 à R$ 5.000,00</option>";
						valor += "<option value=\"5000a10000000\">Acima de R$ 5.000,00</option>";
					};
					$("#faixapreco").append(valor);
					
				});
				
				
				$("select[name=cidade]").change(function() {
		
					var cidade = $(this).val();
		
					resetaCombo('bairro');
		
					$.ajax({
						type : 'POST',
						url : path + 'home/lista_bairros/' + cidade,
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
			
			function resetaValor(el) {
				$("select[name='" + el + "']").empty();
				var option = document.createElement('option');
				$(option).attr({
					value : ''
				});
				$(option).append('Todos os valores');
				$("select[name='" + el + "']").append(option);
			}
			
			function resetaCombo(el) {
				$("select[name='" + el + "']").empty();
				var option = document.createElement('option');
				$(option).attr({
					value : ''
				});
				$(option).append('Todos os bairros');
				$("select[name='" + el + "']").append(option);
			}

		</script>

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-87115167-1', 'auto');
		  ga('send', 'pageview');
		
		</script>