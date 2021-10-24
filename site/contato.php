<?php include 'header.php' ?>

<!-- CONTENT =============================-->
<section class="item content" style="margin-top:50px;margin-bottom:50px;">
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
				<form name="form_contato" novalidate ng-submit="setContato()" id="contactform" autocomplete="off">
					<div class="form">
						<label for="nome">Nome:</label>
						<input type="text" name="nome" ng-model="contato.nome" ng-required="true">

						<label for="email">E-mail:</label>
						<input type="email" name="email" ng-model="contato.email" ng-required="true">

						<label for="assunto">Assunto:</label>
						<input type="text" name="assunto" ng-model="contato.assunto" ng-required="true">

						<label for="mensagem">Mensagem:</label>
						<textarea name="mensagem" rows="7" ng-model="contato.mensagem" ng-required="true"></textarea>
						<input ng-disabled="form_contato.$invalid" type="submit" id="submit" class="clearfix btn" value="Enviar Mensagem">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php include 'footer.php' ?>
