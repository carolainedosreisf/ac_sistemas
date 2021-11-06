var app = angular.module('app', ['ngSanitize','idf.br-filters','ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('siteController', ['$scope', '$http','$filter','$location','$anchorScroll','$timeout','$window', function($scope,$http,$filter,$location,$anchorScroll,$timeout,$window) {
    $scope.lista_lancamentos = [];
    $scope.usuario = JSON.parse(usuario);
    $scope.lista_carrinho = JSON.parse(carrinho);
    $scope.qtd_carrinho = qtd;
    $scope.valor_carrinho = valor;
    $scope.lista_cidades = [];
    $scope.lista_tipos_eventos = [];
    $scope.lista_formas_pagamento = [];
    $scope.parcelas = [];
    $scope.lista_albuns = [];
    $scope.lista_cancelados = [];
    $scope.contato = {};
    $scope.cad_compra = {};

    $scope.filtros = {
        nome_cidade:'',
        nome_tipo_evento:''
    };

    $scope.getComprasCanceladas = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Compra/getCompras.php',
            method: 'GET',
            params:{filtro:1}
        }).then(function (retorno) {
            $scope.lista_cancelados = retorno.data;
            if((retorno.data).length > 0){
                $('#avisoCancelamento').modal('show');
            }else{
                $('#avisoCancelamento').modal('hide');
            }

            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getEventos = function(){ 
        var ocorrido = pagina=='ALBUM'?1:0;
        $http({
            url: 'controllers_php/Evento/getEventos.php',
            method: 'GET',
            params:{ocorrido,cd_cadastro:$scope.usuario!=0?$scope.usuario.cd_cadastro:0}
        }).then(function (retorno) {
            $scope.lista_lancamentos = retorno.data;
            if($scope.lista_lancamentos.length >0){
                setTimeout(() => {
                    var img = document.getElementById('evento-id-0'); 
                    var img_esgotado = document.querySelector('.imagem-esgotado'); 
                    $scope.top_esgotado = parseInt(((img.clientHeight>300?300:img.clientHeight) - img_esgotado.clientHeight)/2);
                }, 500);
            }
            
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getAlbuns = function(dados){ 
        $scope.objEvento = angular.copy(dados);
        $http({
            url: 'controllers_php/Evento/getAlbunsEvento.php',
            method: 'GET',
            params:{cd_evento:dados.cd_evento}
        }).then(function (retorno) {
            $scope.lista_albuns = retorno.data;
            $('#album').modal('show');
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getCidades = function(){ 
        $http({
            url: 'controllers_php/Cidade/getCidades.php',
            method: 'GET',
        }).then(function (retorno) {
            $scope.lista_cidades = retorno.data;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getTiposEventos = function(){ 
        $http({
            url: 'controllers_php/TipoEvento/getTiposEvento.php',
            method: 'GET',
        }).then(function (retorno) {
            $scope.lista_tipos_eventos = retorno.data;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.setCarrinho = function(dados,tipo=4){
        if($scope.usuario==0 || $scope.usuario.cd_permissao ==1){
            swal({
                title: "",
                text: "Você deve logar para adicionar ao carrinho!",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: "btn-warning",
                confirmButtonClass: "btn-success",
                confirmButtonText: "Logar",
                cancelButtonText: "Cancelar"
              },
              function(){
                window.location = "login.php"
              });
        }else{
            if(dados.bloq_academico==1){
                $scope.msgAcademico();
                return;
            }

            if(dados.cd_tipoevento==1 && tipo==2){
                $scope.msgAcademico();
                return;
            }

            if(dados.cd_tipoevento==1 && tipo==4){
                var objEvento = array_column_search($scope.lista_carrinho,'cd_evento',dados.cd_evento);
                if( typeof objEvento != 'undefined'){
                    if(objEvento.cd_tipoevento=='1'){
                        $scope.msgAcademico();
                        return;
                    }
                }
            }

            console.log($scope.lista_carrinho)
            dados.tipo = tipo;
            if(!(tipo==1 && dados.qtd <=1)){
                if(tipo==3){
                    swal({
                        title: "",
                        text: "Deseja realmente excluir esse item do carrinho?",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonClass: "btn-info",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Sim",
                        cancelButtonText: "Cancelar"
                      },
                      function(){
                        postCarrinho(dados);
                      });
                }else{
                    postCarrinho(dados);
                }
            }
        }
    }

    var postCarrinho = function(dados){
        $http({
            url: 'controllers_php/Carrinho/setCarrinho.php',
            method: 'POST',
            data: dados
        }).then(function (retorno) {
            $scope.lista_carrinho = retorno.data.carrinho;
            $scope.qtd_carrinho = retorno.data.qtd;
            $scope.valor_carrinho = retorno.data.valor;
            if(dados.tipo==4){
                swal({
                    title: 'Adicionado com sucesso!',
                    text: '',
                    type: 'success',
                    timer: 1500,
                    showCancelButton: false,
                    showConfirmButton: false
                })
            }
            
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.openDetalhesEvento = function(dados){
        $scope.objEvento = angular.copy(dados);
        $('#modalDetalhesEvento').modal('show');
    }

    if($scope.usuario!=0){
        $scope.contato.nome = $scope.usuario.nm_cadastro;
        $scope.contato.email = $scope.usuario.ed_email;
    }

    $scope.setContato = function(){

        if($scope.form_contato.$valid){
            $scope.carregando = true;
            $http({
                url: 'controllers_php/Contato/sendEmail.php',
                method: 'POST',
                data: $scope.contato
            }).then(function (retorno) {
                $scope.carregando = false;
                if(retorno.data==1){
                    swal({
                        title: "Contato enviado sucesso!",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Ok",
                      },
                      function(){
                        $window.location.reload();
                    });
                }else{
                    console.log(retorno.data);
                    swal({
                        title: 'Erro ao salvar!',
                        text: '',
                        type: 'warning'
                    });
                }
                
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.getFormasPagamento = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/FormasPagamento/getFormasPagamento.php',
            method: 'GET',
            params:{valor_min:$scope.valor_carrinho}
        }).then(function (retorno) {
            $scope.lista_formas_pagamento = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.setToken = function(apaga=0){
        $http({
            url: 'controllers_php/Compra/setToken.php',
            method: 'GET',
            params: {apaga}
        }).then(function (retorno) {
            if(apaga==0){
                window.location = "compra.php?t="+retorno.data
            }else{
                window.location = "minhasCompras.php";
            }
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
        
    }

    $scope.calculaParcelas = function(){
        $scope.objFormaPagamento = array_column_search($scope.lista_formas_pagamento,'cd_fpagto',$scope.cad_compra.cd_fpagto);
        $http({
            url: 'controllers_php/FormasPagamento/calculaParcelas.php',
            method: 'GET',
            params:{
                qtd:$scope.objFormaPagamento.qt_parcela,
                valor:$scope.valor_carrinho
            }
        }).then(function (retorno) {
            $scope.parcelas = retorno.data;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
        
    }

    $scope.setCompra = function(){
        
        if($scope.form_compra.$valid){
            swal({
                title: "",
                text: "Deseja realmente finalizar sua compra?",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: "btn-danger",
                confirmButtonClass: "btn-success",
                confirmButtonText: "Sim",
                cancelButtonText: "Não"
              },
              function(){
                var data = {
                    usuario:$scope.usuario,
                    carrinho:$scope.lista_carrinho,
                    total:$scope.valor_carrinho,
                    data:$scope.cad_compra
                }
                $http({
                    url: 'controllers_php/Compra/setCompra.php',
                    method: 'POST',
                    data: data
                }).then(function (retorno) {
                    $scope.error = retorno.data;
                    if(retorno.data==1){
                        $scope.setToken(1);
                    }
                },
                function (retorno) {
                    console.log('Error: '+retorno.status);
                });
              });
        }
    }

    $scope.verificaItens = function(){
        
        $scope.lista_carrinho.forEach(e => {
            var strData = e.dt_evento_br;
            var partesData = strData.split("/");
            var data = new Date(partesData[2], partesData[1] - 1, partesData[0]);
            if(data <= new Date() || e.lotado==1){
                $scope.erro = 1
            }
            
        });
    }

    $scope.setConscienciaCancelamento = function(dados){
        $scope.carregando = true;
        var data = {
            cd_evento:dados.cd_evento,
            cd_compra:dados.cd_compra
        }
        $http({
            url: 'controllers_php/Evento/setConscienciaCancelamento.php',
            method: 'POST',
            data: data
        }).then(function (retorno) {
            $scope.carregando = false;
            $scope.getComprasCanceladas();
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.msgAcademico = function(){
        swal({
            title: "",
            text: "Esse evento é um evento do tipo acadêmico, por tanto só é permitido uma compra por cliente.",
            type: "warning",
            showCancelButton: false,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ok",
          });
    }
    
    var array_column_search = function(lista,coluna,id){
        var index = lista.map(e => e[coluna]).indexOf(id);
        return lista[index];
    }

    $scope.getCidades();
    $scope.getTiposEventos();

    if(pagina=='COMPRA'){
        $scope.getFormasPagamento();
        $scope.verificaItens();
    }

    if(pagina=='HOME' || pagina=='ALBUM'){
        $scope.getEventos();
        if(pagina=='HOME' && usuario !=0){
            $scope.getComprasCanceladas();
        }
    }

    
}]);
