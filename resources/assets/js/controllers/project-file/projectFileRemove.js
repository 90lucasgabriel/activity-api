(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectFileRemoveController', ProjectFileRemoveController);

	ProjectFileRemoveController.$inject = [
		'$scope', '$location', '$routeParams', 
		'ProjectFile'];

	function ProjectFileRemoveController(
		$scope, $location, $routeParams, 
		ProjectFile){

		$scope.projectFile = ProjectFile.get({
			id: $routeParams.id, 
			fileId: $routeParams.fileId});

		$scope.remove = function(){
			$scope.projectFile.$delete({
				id: $routeParams.id, 
				fileId: $routeParams.fileId})
			.then(function(){
				$location.path('/project/' + $routeParams.id + '/file');
			});
		}

	};
})();