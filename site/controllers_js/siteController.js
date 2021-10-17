var app = angular.module('app', ['ngSanitize','idf.br-filters','ui.utils.masks','ui.mask']);
app.controller('siteController', ['$scope', '$http','$filter', function($scope,$http,$filter) {
    $scope.lista_lancamentos = [1,2,3,4,5,6];
    $scope.usuario = JSON.parse(usuario);

    if(localStorage.lista_carrinho){
        $scope.lista_carrinho = JSON.parse(localStorage.getItem("lista_carrinho"));
    }else{
        $scope.lista_carrinho = [];
    }
    $scope.lista_carrinho = [];
    $scope.setCarrinho = function(dados){
        $scope.carregando = true;
        var i = 0;
        if(localStorage.lista_carrinho){
            var lista = angular.copy($scope.lista_carrinho);
            $scope.lista_carrinho = [];
            lista.forEach(e => {
                $scope.lista_carrinho[i] = e;
                i++;
            });
        }
        
        $scope.lista_carrinho[i] = {
            teste:'',
            dados
        };
        localStorage.setItem("lista_carrinho", JSON.stringify($scope.lista_carrinho ));
        $scope.carregando = false;
    }
}]);
