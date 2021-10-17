var app = angular.module('app', [,'angularUtils.directives.dirPagination']);
app.controller('tiposEventosController', ['$scope', '$http','$filter', function($scope,$http,$filter) {
    $scope.cad = {};
    $scope.lista_tipos_eventos = [];

    $scope.openModalCad = function(dados = {}){
        $scope.cad = angular.copy(dados);

        $scope.txt_modal = (typeof $scope.cad.cd_tipoevento != 'undefined'?" Editar":"Cadastrar")+" Tipo de Evento";
        $('#cadTipoEvento').modal('show');
    }

    $scope.getTiposEventos = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Evento/getTiposEventos.php',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_tipos_eventos = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.setTipoEvento = function(){
        if($scope.form_tipo_evento.$valid){
            $scope.carregando = true;

            $http({
                url: 'controllers_php/Evento/setTipoEvento.php',
                method: 'POST',
                data: $scope.cad
            }).then(function (retorno) {
                $('#cadTipoEvento').modal('hide');
                $scope.cad = {};
                if(retorno.data!=1){
                    alert("Erro ao salvar!");
                }else{
                    $scope.getTiposEventos();
                }
                $scope.carregando = false;
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        }
    }

    $scope.getTiposEventos();
}]);
