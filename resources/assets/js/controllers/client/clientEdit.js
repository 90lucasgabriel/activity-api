(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ClientEditController', ClientEditController);

	ClientEditController.$inject = ['$scope', '$location', '$routeParams', 'Client'];

	function ClientEditController($scope, $location, $routeParams, Client){
		$scope.client = Client.get({id: $routeParams.id});

		$scope.save = function(){
			if($scope.form.$valid){
				Client.update(
					{id: $scope.client.id}, 
					$scope.client, 
					function(){
						$location.path('/clients');
					}
				);
			}
		}

	};
})();