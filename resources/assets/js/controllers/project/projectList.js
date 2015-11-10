(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectListController', ProjectListController);

	ProjectListController.$inject = ['$scope', '$routeParams', 'Project'];

	function ProjectListController($scope, $routeParams, Project){
		$scope.projects = Project.query();
	};
	
})();