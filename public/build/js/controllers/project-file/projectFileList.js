(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectFileListController', ProjectFileListController);

	ProjectFileListController.$inject = ['$scope', '$routeParams', 'ProjectFile'];

	function ProjectFileListController($scope, $routeParams, ProjectFile){
		$scope.project = {id: $routeParams.id};
		$scope.projectFiles = ProjectFile.query({id: $routeParams.id});
	};
	
})();