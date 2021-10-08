
<section class="content-block" style="background-color:#282e40;">
<div class="container text-center">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="formas-pagamento">
				<p>Formas de pagamento</p>
				<img src="images/master-card.png" alt="">
				<img src="images/visa.png" alt="">
				<img src="images/boleto.png" alt="">
			</div>
			<div class="contatos">
				<span class="item-contatos">
					<i class="fa fa-envelope"></i> <span>blablablaentrada@gmail.com</span>
				</span>
				<span class="item-contatos">
					<i class="fa fa-phone"></i> <span>(48) 3434-1455</span>
				</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<ul class="social-iconsfooter">
				<li><a href="#"><i class="fa fa-phone"></i></a></li>
				<li><a href="#"><i class="fa fa-envelope"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram"></i></a></li>
			</ul>
		</div>
	</div>
</div>
</section>


<!-- FOOTER =============================-->
<div class="footer text-center">
	<div class="container">
		<div class="row">
			<p>
				Copyright 2021 Todos os direitos reservados - AC Sistemas
			</p>
		</div>
	</div>
</div>

<!-- SCRIPTS =============================-->
<script src="js/jquery-.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/anim.js"></script>
<script src="js/owl.carousel.js"></script>
<script>
//----HOVER CAPTION---//	  
jQuery(document).ready(function ($) {
	$('.fadeshop').hover(
		function(){
			$(this).find('.captionshop').fadeIn(150);
		},
		function(){
			$(this).find('.captionshop').fadeOut(150);
		}
	);
});
$(document).ready(function() {
	$("#owl-demo").owlCarousel({
		navigation : true, // Show next and prev buttons
		slideSpeed : 300,
		paginationSpeed : 400,
		items : 1, 
		itemsDesktop : false,
		itemsDesktopSmall : false,
		itemsTablet: false,
		itemsMobile : false,
		loop:true,
		autoplay:true,
		autoplayTimeout:4000, 
		autoplayHoverPause:false,
	});
});
</script>
	
</body>
</html>