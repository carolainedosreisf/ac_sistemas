var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.controller('checkIngressosController', ['$scope', '$http','$filter','$window', function($scope,$http,$filter,$window) {
    $scope.lista_eventos = [];
    $scope.lista_ingressos = [];
    $scope.check_presenca = [];
    $scope.objEvento = {};
    
    $scope.getEventos = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Evento/getEventos.php',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_eventos = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getIngressos = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Evento/getIngressos.php',
            method: 'GET',
            params:{id}
        }).then(function (retorno) {
            $scope.lista_ingressos = retorno.data;
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

    $scope.openIngressos = function(dados){
        window.location = "ingressosEvento.php?id="+btoa(dados.cd_evento);
    }

    $scope.setCheckIngresso = function(dados){
        console.log($scope.check_presenca);
        $scope.check_presenca[dados.nr_lote] = 0;
        swal({
            title: "",
            text: "Deseja realmente confirmar presença nesse ingresso: "+dados.nr_lote+"?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim",
            cancelButtonText: "Não"
          },
          function(){
            $scope.carregando = true;
            var data  = {
                cd_compra:dados.cd_compra,
                cd_evento:dados.cd_evento,
                seq:dados.seq
            };
            $http({
                url: 'controllers_php/Evento/setCheckIngresso.php',
                method: 'POST',
                data: data
            }).then(function (retorno) {
                $scope.carregando = false;
                $scope.getIngressos();
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        });
    }

    var array_column_search = function(lista,coluna,id){
        var index = lista.map(e => e[coluna]).indexOf(id)
        return lista[index];
    }

    if(pagina == 'EVENTO'){
        $scope.getEventos();
    }else{
        $scope.getIngressos();
        $scope.getEvento();
    }

}]);
