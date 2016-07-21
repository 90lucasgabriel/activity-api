(function () {
	"use strict";

	var app = angular.module('app.services');
	app.service('Project', Project);

	Project.$inject = ['$resource', '$filter', '$httpParamSerializer', 'appConfig'];

	function Project($resource, $filter, $httpParamSerializer, appConfig){
		function transformData(data){
			if(angular.isObject(data) && data.hasOwnProperty('due_date')){
				var o = angular.copy(data);
				o.due_date = $filter('date')(data.due_date, 'yyyy-MM-dd');
				return appConfig.utils.transformRequest(o);
			}
			return data;
		};

		return $resource(appConfig.baseUrl + '/project/:id', 
			{
				id: '@id'
			},
			{
				get:{
					method: 'GET',
					transformResponse: function(data, headers){
						var o = appConfig.utils.transformResponse(data, headers);
						if(angular.isObject(o) && o.hasOwnProperty('due_date')){
							var arrayDate = o.due_date.split('-'),
							month = parseInt(arrayDate[1])-1;
							o.due_date = new Date(arrayDate[0], month, arrayDate[2]);
						}
						return o;
					}
				},
				save: {
					method: 'POST',
					headers: {
				        'content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
				    },
					transformRequest: transformData
				},
				update: {
					method: 'PUT',
					headers: {
				        'content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
				    },
					transformRequest: transformData
				},
				query:{
					isArray: false
				},
				queryIsMember:{
					method: 'GET',
					url: appConfig.baseUrl + '/project/queryIsMember',
					isArray: false
				},

			}
		);
	};
	
})();