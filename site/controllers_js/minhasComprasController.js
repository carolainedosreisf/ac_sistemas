var app = angular.module('app', ['ngSanitize','idf.br-filters','ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('minhasComprasController', ['$scope', '$http','$filter','$location','$anchorScroll', function($scope,$http,$filter,$location,$anchorScroll) {
    $scope.lista_compras = [];
    $scope.lista_ingressos = [];
    $scope.usuario = JSON.parse(usuario);
    $scope.lista_carrinho = JSON.parse(carrinho);
    $scope.qtd_carrinho = qtd;
    $scope.valor_carrinho = valor;
    $scope.objEvento = {};

    $scope.msgLogar = function(){
        swal({
            title: "",
            text: "Você deve logar primerio!",
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
    }
    
    $scope.getCompras = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Compra/getCompras.php',
            method: 'GET',
            params:{filtro:0}
        }).then(function (retorno) {
            $scope.lista_compras = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.openCancelamento = function(dados){
        $scope.objEvento = angular.copy(dados);
        $('#cancelamento').modal('show');
    }

    $scope.openCertificado = function(dados){
        $scope.carregando = true;

        $http({
            url: 'check_login.php',
            method: 'GET'
        }).then(function (retorno) {
            $scope.carregando = false;
            if(retorno.data.erro_login){
                $scope.msgLogar();
            }else{
                var data = {
                    cd_evento:dados.cd_evento,
                    cd_compra:dados.cd_compra
                }
                window.open('../gerar_certificado/gerador.php?t='+btoa(JSON.stringify(data)),'_blank');
            }
            
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
        
    }

    $scope.openIngressos = function(dados){
        $scope.objEvento = angular.copy(dados);
        $scope.carregando = true;
        var cd_evento = dados.cd_evento;
        var cd_compra = dados.cd_compra;
        $http({
            url: 'controllers_php/Compra/getIngressos.php',
            method: 'GET',
            params:{cd_evento,cd_compra}
        }).then(function (retorno) {
            $scope.carregando = false;
            if(retorno.data.erro_login){
                $scope.msgLogar();
            }else{
                $scope.lista_ingressos = retorno.data;
                $('#ingressos').modal('show');
            }
            
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getCompras();
}]);
