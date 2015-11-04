(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectNoteRemoveController', ProjectNoteRemoveController);

	ProjectNoteRemoveController.$inject = ['$scope', '$location', '$routeParams', 'ProjectNote'];

	function ProjectNoteRemoveController($scope, $location, $routeParams, ProjectNote){
		$scope.projectNote = ProjectNote.get({id: $routeParams.id, noteId: $routeParams.noteId});
		$scope.remove = function(){
			$scope.projectNote.$delete({id: $routeParams.id, noteId: $routeParams.noteId}).then(function(){
				$location.path('/project/' + $routeParams.id + '/notes');
			});
		}

	};
})();