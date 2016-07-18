(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectTaskListController', ProjectTaskListController);

	ProjectTaskListController.$inject = [
		'$scope', '$routeParams', 
		'appConfig', 'ProjectTask'];

	function ProjectTaskListController(
		$scope, $routeParams, 
		appConfig, ProjectTask){
		$scope.projectTask = new ProjectTask();
		$scope.projectTask.project_id = $routeParams.id;

		

		$scope.save = function(){
			if($scope.form.$valid){
				$scope.projectTask.status = appConfig.projectTask.status[0].value;
				$scope.projectTask.project_id = $routeParams.id;
				$scope.projectTask.start_date = new Date();
				$scope.projectTask.due_date = new Date();
		
				console.log($scope.projectTask);
				$scope.projectTask.$save(
					{id: $routeParams.id}
				)
				.then(function(){
					$scope.projectTask = new ProjectTask();
					$scope.loadTask();
				})
			}

		};

		$scope.loadTask = function(){
			$scope.projectTasks = ProjectTask.query({
				id: $routeParams.id,
				orderBy: 'id',
				sortedBy: 'desc'
			});
		};

		$scope.loadTask();
	};
	
})();