/* ============================================================
 * File: app.js
 * Configure global module dependencies. Page specific modules
 * will be loaded on demand using ocLazyLoad
 * ============================================================ */

'use strict';

angular.module('app',['ngSanitize'])
    .controller('HomeCtrl', ['$scope','$http', function($scope, $http) {

        $scope.message = 'Persistir Dados';
        $scope.page = 1;


        $scope.sync = function(page){

            if (page==1){
                $http({method: 'GET', url: '/home/saveLastUpdate'});
            }

            if (page<=100){ // num requests
                    $http({
                        method: 'POST',
                        url: '/sync/'+page
                    }).then(function successCallback(response) {
                        $scope.status = response.data.registros_indexados +' Registros indexados';
                        page++;
                        $scope.page = page
                        $scope.sync(page);

                    }, function errorCallback(response) {
                        $scope.status = 'Error...';
                    });
            }

        }

        $scope.search = function(){

            $http({
                url: '/stack_moblee/question',
                params: {
                    page: $scope.pg,
                    rpp: $scope.rpp,
                    sort: $scope.sort,
                    score:$scope.score
                }
            }).then(function successCallback(response) {
                $scope.code = $scope.syntaxHighlight(JSON.stringify(response.data, undefined, 4));

            }, function errorCallback(response) {
                $scope.status = 'Error...';
            });

        }

        $scope.syntaxHighlight = function (json) {
            if (typeof json != 'string') {
                json = JSON.stringify(json, undefined, 2);
            }
            json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                var cls = 'number';
                if (/^"/.test(match)) {
                    if (/:$/.test(match)) {
                        cls = 'key';
                    } else {
                        cls = 'string';
                    }
                } else if (/true|false/.test(match)) {
                    cls = 'boolean';
                } else if (/null/.test(match)) {
                    cls = 'null';
                }
                return '<span class="' + cls + '">' + match + '</span>';
            });
        }





    }]);