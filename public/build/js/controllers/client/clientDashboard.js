
(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ClientDashboardController', ClientDashboardController);

	ClientDashboardController.$inject = ['$scope', '$location', '$routeParams', 'Client'];

	function ClientDashboardController($scope, $location, $routeParams, Client){
		$scope.client = {

		};

		$scope.client = Client.query({
			orderBy: 'created_at',
			sortedBy: 'desc',
			limit: 8
		}, function(response){
			$scope.clients = response.data;
		});

		$scope.showClient = function(client){
			$scope.client = client;
		}
	};
})();
