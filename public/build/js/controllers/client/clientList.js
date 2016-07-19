(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ClientListController', ClientListController);

	ClientListController.$inject = ['$scope', 'Client'];

	function ClientListController($scope, Client){

		$scope.clients = [];
		$scope.totalClients = 0;
		$scope.clientsPerPage = 3; 

		$scope.pagination = {
		    current: 1
		};

		$scope.pageChanged = function(newPage) {
		    getResultsPage(newPage);
		};

		$scope.clients = Client.query();
		function getResultsPage(pageNumber) {
			//$scope.clients = Client.query({);
			Client.query({
				page: pageNumber,
				limit: $scope.clientsPerPage
			}, function(data){
				$scope.clients = data.data;
				$scope.totalClients = data.meta.pagination.total;
			});
		}

		getResultsPage(1);

	};
})();
