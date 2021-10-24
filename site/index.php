<?php include 'header.php' ?>
<?php include 'capa.php' ?>

<div>
	<div class="container filtros">
		<div class="row">
			<div class="col-sm-4">
				<input type="text" class="form-control" placeholder="Pesquisar...">
			</div>
			<div class="col-sm-4">
				<select name="" id="" class="form-control">
					<option value="">Cidade</option>
				</select>
			</div>
			<div class="col-sm-4">
				<select name="" id="" class="form-control">
					<option value="">Categoria</option>
				</select>
			</div>
		</div>
	</div>
	<section class="item content">
		<div class="container">
			<div class="underlined-title">
				<div class="editContent">
					<h1 class="text-center latestitems">Lançamentos</h1>
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
				<div class="col-md-4" pagination-id="pg_lancamentos" dir-paginate="l in lista_lancamentos| filter:filtrar | itemsPerPage:6">
					<div class="productbox">
						<div class="fadeshop" ng-mouseover="aparece='evento-car-'+l.cd_evento">
							<div class="captionshop text-center" id="evento-car-{{l.cd_evento}}" ng-show="aparece=='evento-car-'+l.cd_evento">
								<h3>Estádio Old Trafford</h3>
								<p>
									It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software ...
								</p>
								<p>
									<a href="#" class="learn-more detailslearn"><i class="fa fa-link"></i> Ver Mais</a>
								</p>
							</div>
							<span class="maxproduct card-evento" style="width: 100% !important"><img src="../{{l.ft_caminho?l.ft_caminho:'arquivos/uploads_evento/sem-foto.jpg'}}" alt=""></span>
						</div>
						<div class="product-details">
							<a href="#">
								<h1>
									{{l.dt_evento_br}}
									
								</h1>
							</a>
							<span class="price">
								<span class="edd_price">
									<button class="main_bt eventos-button" ng-click="setCarrinho(l)">
										<i class="fa fa-shopping-cart"></i> 
										<span ng-class="l.cd_promocao>0?'vl-venda':''">
											{{l.cd_promocao>0?('('+(l.vl_venda | currency:'R$')+')'):(l.vl_venda | currency:'R$')}}
										</span>
										<span ng-class="l.cd_promocao>0?'vl-promocao':''" ng-show="l.cd_promocao>0">&nbsp;&nbsp;{{l.vl_promocao | currency:'R$'}}</span>
									</button>
									<button class="main_bt" ng-click="openDetalhesEvento(l)"><i class="fa fa-search"></i>  </button>
								</span>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div style="margin-bottom:50px" class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<dir-pagination-controls 
					max-size="7" 
					direction-links="true" 
					boundary-links="true" 
					pagination-id="pg_lancamentos">  
				</dir-pagination-controls>  
			</div>
		</div>
	</div>
	
	<div id="modalDetalhesEvento" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close fechar" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">{{objEvento.ds_evento}} ({{objEvento.nome_tipo_evento}})</h4>
			</div>
			<div class="modal-body">
				<span><b>Local: </b>{{objEvento.ds_local}} - {{objEvento.nome_cidade}} ({{objEvento.uf_cidade}})</span><br>
				<span><b>Classificação: </b>{{objEvento.nr_classifi?objEvento.nr_classifi+' anos':'Livre'}} </span><br>
				<span><b>Data: </b>{{objEvento.dt_evento_br}}</span><br>
				<span><b>Valor: </b>
					<span ng-class="objEvento.cd_promocao>0?'vl-promocao':''" ng-show="objEvento.cd_promocao>0">{{objEvento.vl_promocao | currency:'R$'}}</span>
					<span ng-class="objEvento.cd_promocao>0?'vl-venda':''">
						{{objEvento.cd_promocao>0?('('+(objEvento.vl_venda | currency:'R$')+')'):(objEvento.vl_venda | currency:'R$')}}
					</span>
				</span><br>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php' ?>
