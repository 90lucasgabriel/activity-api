(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectNewController', ProjectNewController);

	ProjectNewController.$inject = [
	'$scope', '$location', '$cookies', 
	'Project', 'Client', 'appConfig', 'Upload'
	];

	function ProjectNewController(
		$scope, $location, $cookies, 
		Project, Client, appConfig, Upload
		){
		$scope.project = new Project();
		$scope.clients = Client.query();
		$scope.status  = appConfig.project.status;

		$scope.save = function(){
			if($scope.form.$valid){
				Upload.upload({
					url: 'upload/url',
					data: {
						file: $scope.projectFile.file, 
						name: $scope.projectFile.name,
						description: $scope.projectFile.description
					}
				}).then(function (resp) {
					$location.path('/project/' + $routeParams.id + '/files');
					console.log('Success ' + resp.config.data.file.name + 'uploaded. Response: ' + resp.data);
				});
			}
		};
		
		$scope.formatName = function(model){
			if(model){
				return model.name;
			}
			return '';
		};

		$scope.getClients = function(name){
			return Client.query({
				search: name,
				searchFields: 'name:like'
			}).$promise;
		};

		$scope.selectClient = function(item){
			$scope.project.client_id = item.id;
		};

		$scope.due_date = {
			status: {
				opened: false
			}
		};

		$scope.open = function($event){
			$scope.due_date.status.opened = true
		};

	};
})();