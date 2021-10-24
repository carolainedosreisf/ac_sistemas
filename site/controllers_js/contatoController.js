var app = angular.module('app', []);
app.controller('contatoController', ['$scope', '$http','$filter','$timeout','$location','$anchorScroll', function($scope,$http,$filter,$timeout,$location,$anchorScroll) {
    $scope.contato = {};
    $scope.usuario = JSON.parse(usuario);
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
}]);
