var app = angular.module('app', ['ngSanitize','idf.br-filters','ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('minhasComprasController', ['$scope', '$http','$filter','$location','$anchorScroll', function($scope,$http,$filter,$location,$anchorScroll) {
    $scope.lista_compras = [];
    $scope.usuario = JSON.parse(usuario);
    $scope.lista_carrinho = JSON.parse(carrinho);
    $scope.qtd_carrinho = qtd;
    $scope.valor_carrinho = valor;
    
    $scope.getCompras = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Compra/getCompras.php',
            method: 'GET',
        }).then(function (retorno) {
            $scope.lista_compras = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getCompras();
}]);
