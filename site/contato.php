<?php include 'header.php' ?>

<!-- CONTENT =============================-->
<section class="item content" style="margin-top:50px">
	<div class="container toparea">
		<div class="underlined-title">
			<div class="editContent">
				<h1 class="text-center latestitems">Contato</h1>
			</div>
			<div class="wow-hr type_short">
				<span class="wow-hr-h">
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form method="post" action="contact.php" id="contactform">
					<div class="form">
						<label for="nome">Nome:</label>
						<input type="text" name="nome">

						<label for="email">E-mail:</label>
						<input type="text" name="email">

						<label for="assunto">Assunto:</label>
						<input type="text" name="assunto">

						<label for="mensagem">Mensagem:</label>
						<textarea name="comment" rows="7"></textarea>
						<input type="submit" id="submit" class="clearfix btn" value="Enviar Mensagem">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php include 'footer.php' ?>
