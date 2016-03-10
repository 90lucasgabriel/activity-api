(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectTaskNewController', ProjectTaskNewController);

	ProjectTaskNewController.$inject = ['$scope', '$location', '$routeParams', 'appConfig', 'ProjectTask'];

	function ProjectTaskNewController($scope, $location, $routeParams, appConfig, ProjectTask){
		$scope.projectTask = new ProjectTask();
		$scope.status = appConfig.projectTask.status;
		$scope.projectTask.project_id = $routeParams.id;

		$scope.start_date = {
			status: {
				opened: false
			}
		};

		$scope.due_date = {
			status: {
				opened: false
			}
		}

		$scope.operStartDatePicker = function($event){
			$scope.start_date.status.opened = true;
		}

		$scope.operDueDatePicker = function($event){
			$scope.due_date.status.opened = true;
		}		
		
		$scope.save = function(){
			if($scope.form.$valid){
				$scope.projectTask.$save({
					id: $routeParams.id
				})
				.then(function(){
					$location.path('/project/' + $routeParams.id + '/tasks');
				});
			}
		}

	};
})();