(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectTaskRemoveController', ProjectTaskRemoveController);

	ProjectTaskRemoveController.$inject = ['$scope', '$location', '$routeParams', 'ProjectTask'];

	function ProjectTaskRemoveController($scope, $location, $routeParams, ProjectTask){
		$scope.projectTask = ProjectTask.get({id: $routeParams.id, taskId: $routeParams.taskId});
		$scope.remove = function(){
			$scope.projectTask.$delete({id: $routeParams.id, taskId: $routeParams.taskId}).then(function(){
				$location.path('/project/' + $routeParams.id + '/tasks');
			});
		}

	};
})();