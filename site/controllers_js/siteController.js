var app = angular.module('app', ['ngSanitize','idf.br-filters','ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('siteController', ['$scope', '$http','$filter', function($scope,$http,$filter) {
    $scope.lista_lancamentos = [1,2,3,4,5,6];
    $scope.usuario = JSON.parse(usuario);
    $scope.lista_carrinho = JSON.parse(carrinho);
    $scope.qtd_carrinho = qtd;
    $scope.valor_carrinho = valor;
    $scope.lista_cidades = [];
    $scope.lista_tipos_eventos = [];
    $scope.contato = {};

    $scope.filtros = {
        nome_cidade:'',
        nome_tipo_evento:''
    };

    $scope.getEventos = function(){ 
        $http({
            url: 'controllers_php/Evento/getEventos.php',
            method: 'GET',
        }).then(function (retorno) {
            $scope.lista_lancamentos = retorno.data;
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
            $http({
                url: 'controllers_php/Contato/sendEmail.php',
                method: 'POST',
                data: $scope.contato
            }).then(function (retorno) {
                
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    var array_column_search = function(lista,coluna,id,tipo=1){
        if(tipo==1){
            var index = lista.map(e => e[coluna]).indexOf(id);
            return index>=0?1:0;
        }else{
            return lista.map(e => e[coluna]).filter(x => x === id).length
        }
    }

    $scope.getEventos();
    $scope.getCidades();
    $scope.getTiposEventos();
}]);
