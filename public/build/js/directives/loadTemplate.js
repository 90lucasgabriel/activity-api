
(function () {
	"use strict";

	var app = angular.module('app.directives');
	app.directive('loadTemplate', loadTemplate);

	loadTemplate.$inject = [
		'$compile', '$http', 'OAuth'
		];

	function loadTemplate(
		$compile, $http, OAuth
		){

		return {
			restrict: 		'E',
			link: 			
				function (scope, element, attr){
					scope.$on('$routeChangeStart', function(event, next, current){
						if(OAuth.isAuthenticated()){
							$http.get(attr.url).then(function(response){
								element.html(response.data);
								$compile(element.contents())(scope);
							});
						}
					});
				}
		};
	};
})();
