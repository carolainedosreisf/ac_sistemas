<?php include 'header.php' ?>
<?php include 'capa.php' ?>

<div>
<script>
    var pagina = "HOME";
</script>
	<div class="container">
		<div class="row filtros bs-callout bs-callout-default">
			<div class="col-sm-4">
				<label for="filtrar">Busca Rápida:</label>
				<input type="text" name="filtrar" id="filtrar" class="form-control" ng-model="filtrar" placeholder="Pesquisar...">
			</div>
			<div class="col-sm-4">
				<label for="nome_cidade">Cidade:</label>
				<select name="nome_cidade" id="nome_cidade" class="form-control" ng-model="filtros.nome_cidade">
					<option value="">Todas</option>
					<option value="{{l.nm_cidade}}" ng-repeat="l in lista_cidades">{{l.nm_cidade}} ({{l.uf_cidade}})</option>
				</select>
			</div>
			<div class="col-sm-4">
				<label for="nome_tipo_evento">Categoria:</label>
				<select name="nome_tipo_evento" id="nome_tipo_evento" class="form-control" ng-model="filtros.nome_tipo_evento">
					<option value="">Todas</option>
					<option value="{{l.ds_evento}}" ng-repeat="l in lista_tipos_eventos">{{l.ds_evento}}</option>
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
			<div class="alert alert-primary text-center" role="alert" ng-show="lista_lancamentos.length<=0">
				Em breve!
			</div>
        
			<div class="row">
				<div class="col-md-4" pagination-id="pg_lancamentos" dir-paginate="l in lista_lancamentos| filter:filtrar |filter:{nome_cidade:filtros.nome_cidade} | filter:{nome_tipo_evento:filtros.nome_tipo_evento} | itemsPerPage:6">
					<div class="productbox">
						<div class="fadeshop" ng-mouseover="aparece='evento-car-'+l.cd_evento">
							<span class="maxproduct card-evento" style="width: 100% !important">
							<img 
								id="evento-id-{{$index}}" 
								ng-class="l.lotado==1?'escurecer-img':''"
								src="../{{l.ft_caminho?l.ft_caminho:'arquivos/uploads_evento/sem-foto.jpg'}}" 
								alt="">
							<img 
								class="imagem-esgotado"  
								id="esgotado-evento-{{l.cd_evento}}"
								ng-class="l.lotado==0?'esconder-lotado':''"
								src="images/esgotado.png" />
						</span>
						</div>
						<div class="product-details">
							<a href="#">
								<h1>
									{{l.dt_evento_br}} {{l.hr_evento}} <br>
									<span>
										Lotação: {{l.qtd_vendas}}/{{l.nr_lotacao}}
									</span>
								</h1>
							</a>
							<span class="price">
								<span class="edd_price">
									<button class="main_bt eventos-button" ng-click="setCarrinho(l)" ng-disabled="l.lotado==1" ng-class="l.lotado==1?'botao-disabled':''">
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
	<div id="avisoCancelamento" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Aviso Cancelamento </h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger" role="alert" ng-repeat="l in lista_cancelados">
						<i>Olá {{usuario.nm_cadastro}}, informamos que o evento que você comprou foi cancelado, EM BREVE VOCÊ SERÁ REEMBOLSADO!</i><br><br>
						<b>O evento: </b>{{l.ds_evento}} ({{l.nome_tipo_evento}})<br>
						<b>Data Evento: </b> {{l.dt_evento_br}} {{l.hr_evento}}<br>
						<b>Valor a ser reembolsado: </b> {{l.vl_reembolso | currency:'R$'}} <br>
						<b>Motivo Cancelamento:</b> {{l.motivo_cancelamento}} <br><br>
						<i>Para nos confirmar que recebeu e leu essa mensagem clique no botão a baixo, para mais detalhes acesse o menu "MINHAS COMPRAS".</i><br><br>
						<button class="btn btn-primary" ng-click="setConscienciaCancelamento(l)">Ok, Estou ciente</button>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
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
				<span><b>Data: </b>{{objEvento.dt_evento_br}} {{objEvento.hr_evento}}</span><br>
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
