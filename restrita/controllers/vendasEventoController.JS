var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.controller('vendasEventoController', ['$scope', '$http','$filter','$window', function($scope,$http,$filter,$window) {
    $scope.lista_vendas = [];
    $scope.lista = [];
    $scope.objEvento = {};

    $scope.getVendasEvento = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Evento/getVendas.php',
            method: 'GET',
            params:{id}
        }).then(function (retorno) {
            $scope.lista_vendas = retorno.data.lista;
            $scope.valor = retorno.data.valor;
            $scope.qtd = retorno.data.qtd;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getEvento = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Evento/getEvento.php',
            method: 'GET',
            params:{id}
        }).then(function (retorno) {
            $scope.objEvento = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getRelatorio = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Evento/relatorio.php',
            method: 'GET',
        }).then(function (retorno) {
            $scope.lista = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }
    if(pagina=='VENDAS'){
        $scope.getVendasEvento();
        $scope.getEvento();
    }else if(pagina=='RELATORIO'){
        $scope.getRelatorio();
    }
    
}]);
