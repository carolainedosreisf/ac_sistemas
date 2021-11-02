var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.controller('clientesController', ['$scope', '$http','$filter','$window', function($scope,$http,$filter,$window) {
    $scope.lista_clientes = [];

    $scope.getClientes = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Cliente/getClientes.php',
            method: 'GET',
            params:{id}
        }).then(function (retorno) {
            $scope.lista_clientes = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getClientes();
    
}]);

