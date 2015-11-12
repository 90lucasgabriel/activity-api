(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectViewController', ProjectViewController);

	ProjectViewController.$inject = ['$scope', '$location', '$routeParams', 'Project'];

	function ProjectViewController($scope, $location, $routeParams, Project){
		$scope.project = Project.get({id: $routeParams.id});
	};
})();