(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ClientViewController', ClientViewController);

	ClientViewController.$inject = ['$scope', '$location', '$routeParams', 'Client'];

	function ClientViewController($scope, $location, $routeParams, Client){
		$scope.client = Client.get({id: $routeParams.id});
	};
})();