(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ClientListController', ClientListController);

	ClientListController.$inject = ['$scope', 'Client'];

	function ClientListController($scope, Client){
		$scope.clients = Client.query();

	};
})();