(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectTaskViewController', ProjectTaskViewController);

	ProjectTaskViewController.$inject = ['$scope', '$location', '$routeParams', 'ProjectTask'];

	function ProjectTaskViewController($scope, $location, $routeParams, ProjectTask){
		$scope.projectTask = ProjectTask.get({id: $routeParams.id, taskId: $routeParams.taskId});
	};
})();