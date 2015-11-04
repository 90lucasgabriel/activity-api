(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectNoteNewController', ProjectNoteNewController);

	ProjectNoteNewController.$inject = ['$scope', '$location', '$routeParams', 'ProjectNote'];

	function ProjectNoteNewController($scope, $location, $routeParams, ProjectNote){
		$scope.projectNote = new ProjectNote();
		$scope.projectNote.project_id = $routeParams.id;
		
		$scope.save = function(){
			if($scope.form.$valid){
				$scope.projectNote.$save({
					id: $routeParams.id
				})
				.then(function(){
					$location.path('/project/' + $routeParams.id + '/notes');
				});
			}
		}

	};
})();