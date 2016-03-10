(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectNoteEditController', ProjectNoteEditController);

	ProjectNoteEditController.$inject = [
		'$scope', '$location', '$routeParams', 
		'ProjectNote'];

	function ProjectNoteEditController(
		$scope, $location, $routeParams, 
		ProjectNote){

		$scope.projectNote = ProjectNote.get(
			{
				id: $routeParams.id, 
				noteId: $routeParams.noteId
			});
		
		$scope.save = function(){
			if($scope.form.$valid){
				ProjectNote.update({
						noteId: $scope.projectNote.id
					},
					$scope.projectNote, 
					function(){
						$location.path('/project/' + $routeParams.id + '/notes');
					}
				);
			}
		}

	};
})();