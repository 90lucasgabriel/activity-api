(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectFileEditController', ProjectFileEditController);

	ProjectFileEditController.$inject = [
		'$scope', '$location', '$routeParams', 
		'ProjectFile'];

	function ProjectFileEditController(
		$scope, $location, $routeParams, 
		ProjectFile){

		$scope.projectFile = ProjectFile.get({
			id: $routeParams.id, 
			fileId: $routeParams.fileId
		});

		console.log($scope.projectFile);

		$scope.save = function(){
			if($scope.form.$valid){
				ProjectFile.update({
						id: $routeParams.id, 
						fileId: $routeParams.fileId
					},
					$scope.projectFile, 
					function(){
						$location.path('/project/' + $routeParams.id + '/file');
					}
				);
			}
		}

	};
})();