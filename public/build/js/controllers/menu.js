(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('MenuController', MenuController);

	MenuController.$inject = [
		'$scope', '$cookies'
	];

	function MenuController(
		$scope, $cookies
	){
		$scope.user = $cookies.getObject('user');
	};
})();