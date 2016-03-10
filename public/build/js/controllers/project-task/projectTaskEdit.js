(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectTaskEditController', ProjectTaskEditController);

	ProjectTaskEditController.$inject = [
		'$scope', '$location', '$routeParams', 
		'appConfig', 'ProjectTask'];

	function ProjectTaskEditController(
		$scope, $location, $routeParams, 
		appConfig, ProjectTask){

		$scope.projectTask = ProjectTask.get(
			{
				id: $routeParams.id, 
				taskId: $routeParams.taskId
			});

		$scope.status = appConfig.projectTask.status;

		$scope.start_date = {
			status: {
				opened: false
			}
		};

		$scope.due_date = {
			status: {
				opened: false
			}
		};

		$scope.operStartDatePicker = function($event){
			$scope.start_date.status.opened = true;
		}

		$scope.operDueDatePicker = function($event){
			$scope.due_date.status.opened = true;
		}	

		$scope.save = function(){

				console.log($scope.projectTask);
				ProjectTask.update({
						taskId: $scope.projectTask.id
					},
					$scope.projectTask, 
					function(data){
						$location.path('/project/' + $routeParams.id + '/tasks');
					},
					function(response){
						console.log(response);
					}
				);
			
		}

	};
})();