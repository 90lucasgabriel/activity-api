(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('HomeController', HomeController);

	HomeController.$inject = ['$scope', '$cookies'];

	function HomeController($scope, $cookies){
		console.log($cookies.getObject('user'));
	};
	
})();