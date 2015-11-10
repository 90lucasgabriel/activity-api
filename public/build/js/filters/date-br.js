(function(){
	"use strict";

	var app = angular.module('app.filters');
	app.filter('DateBr', DateBr);

	DateBr.$inject = ['$filter'];
	
	function DateBr($filter){
		return function(input){
			return $filter('date')(input, 'dd/MM/yyyy');
		}
	}

})();