(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectFileNewController', ProjectFileNewController);

	ProjectFileNewController.$inject = [
		'$scope', '$location', '$routeParams', 
		'appConfig', 'Url', 'Upload'];

	function ProjectFileNewController(
		$scope, $location, $routeParams, 
		appConfig, Url, Upload){


		$scope.save = function(){
			console.log($scope.projectFile);
			if($scope.form.$valid){
				var url = appConfig.baseUrl + Url.getUrlFromAngularSymbol(appConfig.urls.projectFile, {id: $routeParams.id, fileId: $routeParams.fileId});
				Upload.upload({
					url: url,
					data: {
						file: $scope.projectFile.file, 
						name: $scope.projectFile.file.name,
						description: $scope.projectFile.description,
						project_id: $routeParams.id
					}
				}).then(function (resp) {
					$location.path('/project/' + $routeParams.id + '/file');
					console.log('Success ' + resp.config.data.file.name + 'uploaded. Response: ' + resp.data);
				}, function (resp) {
					console.log('Error status: ' + resp.status);
				}, function (evt) {
					var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
					console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
				});

			}
		}

	};
})();