(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('HomeController', HomeController);

	HomeController.$inject = [
	'$scope', '$cookies', '$timeout', '$pusher',
	'Project'
	];

	function HomeController(
		$scope, $cookies, $timeout, $pusher,
		Project
		){
		$scope.tasks = [];
		$scope.project = {};

		Project.query({
			orderBy: 'created_at',
			sortedBy: 'desc',
			limit: 8
		}, function(response){
			$scope.projects = response.data;
		});


		//Pusher--------------------------
		var pusher = $pusher(window.client);
		var channel = pusher.subscribe('user.' + $cookies.getObject('user').id);

		channel.bind('CodeProject\\Events\\TaskWasIncluded', 
			function(data){
				if($scope.tasks.length == 6) {
					$scope.tasks.splice($scope.tasks.length-1,1);
				}
				$timeout(function(){
					$scope.tasks.unshift(data.task);
				}, 300);
			}
			);	
	};
})();