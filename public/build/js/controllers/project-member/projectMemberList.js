(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectMemberListController', ProjectMemberListController);

	ProjectMemberListController.$inject = [
		'$scope', '$routeParams', 
		'appConfig', 'ProjectMember', 'User'];

	function ProjectMemberListController(
		$scope, $routeParams, 
		appConfig, ProjectMember, User){
		$scope.projectMember = new ProjectMember();
		$scope.projectMember.project_id = $routeParams.id;

		

		$scope.save = function(){
			if($scope.form.$valid){
				$scope.projectMember.project_id = $routeParams.id;
		
				console.log($scope.projectMember);
				$scope.projectMember.$save(
					{id: $routeParams.id}
				)
				.then(function(){
					$scope.projectMember = new ProjectMember();
					$scope.loadMember();
				})
			}

		};

		$scope.loadMember = function(){
			$scope.projectMembers = ProjectMember.query({
				id: $routeParams.id,
				orderBy: 'id',
				sortedBy: 'desc'
			});
		};

		$scope.loadMember();

		$scope.formatName = function(model){
			if(model){
				return model.name;
			}
			return '';
		};

		$scope.getUsers = function (name) {
			return User.query({
				search: name, 
				searchFields: 'name:like'
			}).$promise;

		};

		$scope.selectUser = function(item){
			$scope.projectMember.member_id = item.id;
		}
	};
	
})();