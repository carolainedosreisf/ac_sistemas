var app = angular.module('app', ['ui.utils.masks','ui.mask','angularUtils.directives.dirPagination']);
app.controller('eventosController', ['$scope', '$http','$filter','$window', function($scope,$http,$filter,$window) {
    $scope.cad = {};
    $scope.lista_eventos = [];
    $scope.lista_promocoes = [];
    $scope.filtro_status = "N";
    $scope.erro_promocao = 0;

    $scope.cad = {
        // ds_evento:"Evento de incentivo a leitura",
        // dt_evento:"21/03/2022",
        // nr_classifi:"",
        // cd_tipoevento:"3",
        // vl_venda:"5",
        // cd_promossao:"",
        // cd_cidade:"70",
        // ds_local:"Ginasio"
    };

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

    $scope.getEvento = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Evento/getEvento.php',
            method: 'GET',
            params:{id}
        }).then(function (retorno) {
            $scope.cad = retorno.data;
               
            // var $option = $("<option selected></option>").val($scope.cad.cd_cidade).text($scope.cad.nome_cidade+" ("+$scope.cad.uf_cidade+")");
            // $('#cd_cidade').append($option).trigger('change');
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
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

    $scope.getCidades = function(){ 
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Cidade/getCidades.php',
            method: 'GET',
        }).then(function (retorno) {
            $scope.lista_cidades = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.getPromocoes = function(){
        $scope.carregando = true;
        $http({
            url: 'controllers_php/Promocao/getPromocoes.php',
            method: 'GET'
        }).then(function (retorno) {
            $scope.lista_promocoes = retorno.data;
            $scope.carregando = false;
        },
        function (retorno) {
            console.log('Error: '+retorno.status);
        });
    }

    $scope.setEvento = function(){
        if($scope.form_evento.$valid && !($scope.erro_hora) && $scope.erro_promocao==0){
            var form_data = new FormData();  
            angular.forEach($scope.files, function(file){  
                form_data.append('file', file);  
            });  
            $http.post('controllers_php/Evento/upload.php', form_data,  
            {  
                transformRequest: angular.identity,  
                headers: {'Content-Type': undefined,'Process-Data': false}  
            }).success(function(response){ 
                $scope.cad.ft_caminho_novo = response;
                
                $http({
                    url: 'controllers_php/Evento/setEvento.php',
                    method: 'POST',
                    data: $scope.cad
                }).then(function (retorno) {
                    if(retorno.data == 1){
                        window.location = "eventos.php";
                    }else{
                        $scope.carregando = false;
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
                
            });  
            $scope.carregando = true;
            
        }
    }
    $scope.setCampoPromocao = function(){
        $scope.erro_promocao = 0;
        if($scope.cad.cd_promocao){
            var obj = array_column_search($scope.lista_promocoes,'cd_promossao',$scope.cad.cd_promocao);
            if($scope.cad.vl_venda <= obj.vl_promossao){
                $scope.erro_promocao = 1;
            }
            $scope.cad.vl_promocao = obj.vl_promossao;
        }else{
            $scope.cad.vl_promocao = "";
        }
        
    }

    $scope.apagarImagem = function(liberado=0){
        swal({
            title: "",
            text: "Deseja realmente apagar a imagem?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim",
            cancelButtonText: "Não"
          },
          function(){
            $http({
                url: 'controllers_php/Evento/apagarImagem.php',
                method: 'POST',
                data: $scope.cad
            }).then(function (retorno) {
                if(retorno.data == 1){
                    $window.location.reload();
                }else{
                    $scope.carregando = false;
                    $scope.mensagem = "Erro ao apagar.";
                }
            },
            function (retorno) {
                console.log('Error: '+retorno.status);
            });
        });
    }

    $scope.openSetEvento = function(id)
    {
        window.location = "novoEvento.php?id="+btoa(id);
    }

    $scope.validaHora = function(){

        if($scope.form_evento.hr_evento.$valid){
            $scope.erro_hora = false;
            var hr = $scope.cad.hr_evento.substr(0, 2);
            var min = $scope.cad.hr_evento.substr(2, 2);
            if(hr > 23 || min > 59){
                $scope.erro_hora = true;
            }
        }
    }

    $scope.openRelatorio = function(){
        window.open('relatorioEventos.php','_blank');
    }

    $scope.openVendas = function(id){
        window.location = "vendasEvento.php?id="+btoa(id);
    }

    $scope.openAlbuns = function(id){
        window.location = "albunsEvento.php?id="+btoa(id);
    }

    var array_column_search = function(lista,coluna,id){
        var index = lista.map(e => e[coluna]).indexOf(id)
        return lista[index];
    }
    
    if(cadastro==1){
        $scope.getTiposEventos();
        $scope.getPromocoes();
    }else{
        $scope.getEventos();
    }

    if(id != 0 ){
        $scope.getEvento();
    }
    $scope.getCidades();
}]);

// $(document).ready(function() {
//     $(".select_search").select2();
// });

app.directive("fileInput", function($parse){  
    return{  
         link: function($scope, element, attrs){  
              element.on("change", function(event){  
                   var files = event.target.files;  
                   $parse(attrs.fileInput).assign($scope, element[0].files);  
                   $scope.$apply();  
              });  
         }  
    }  
});  

app.directive('somentenumeros', function () {
    return {
      require: 'ngModel',
      restrict: 'A',
      link: function (scope, element, attr, ctrl) {
        function inputValue(val) {
          if (val) {
            var numeros = val.replace(/[^0-9]/g, '');
            if (numeros !== val) {
              ctrl.$setViewValue(numeros);
              ctrl.$render();
            }
            return parseInt(numeros,10);
          }
          return '';
        }
        ctrl.$parsers.push(inputValue);
      }
    };
});