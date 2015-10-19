(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ClientRemoveController', ClientRemoveController);

	ClientRemoveController.$inject = ['$scope', '$location', '$routeParams', 'Client'];

	function ClientRemoveController($scope, $location, $routeParams, Client){
		$scope.client = Client.get({id: $routeParams.id});
		$scope.remove = function(){
			$scope.client.$delete().then(function(){
				$location.path('/clients');
			});
		}

	};
})();