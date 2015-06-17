var app = angular.module('daspestleApp', ['ngRoute']);

app.run(function(){
	//
});

/* ROUTES */
app.config(function($routeProvider, $locationProvider){
	$routeProvider.when('/', {
		templateUrl: 'pages/home.html',
	});
	$routeProvider.when('/keyword', {
		templateUrl: 'pages/keyword.html',
		controller: 'KaywordController'
	});
});

/* SERVICES */
app.factory("MetricSvc", function($http){
	return{
		all: function()
		{
			return $http.get('metric');
		},
		create: function(data)
		{
			return $http.get('metric/create', data);
		},
		get: function(id)
		{
			return $http.get('metric/'+id);
		},
		update: function(id, data)
		{
			return $http.put('metric/'+id, data);
		},
		delete: function(id)
		{
			return $http.delete('metric/'+id);
		}
	}
});
app.factory("SiteSvc", function($http){
	return{
		all: function()
		{
			return $http.get('site');
		},
		create: function(data)
		{
			return $http.get('site/create', data);
		},
		get: function(id)
		{
			return $http.get('site/'+id);
		},
		update: function(id, data)
		{
			return $http.put('site/'+id, data);
		},
		delete: function(id)
		{
			return $http.delete('site/'+id);
		}
	}
});
app.factory("ConditionSvc", function($http){
	return{
		all: function()
		{
			return $http.get('condition');
		},
		create: function(data)
		{
			return $http.get('condition/create', data);
		},
		get: function(id)
		{
			return $http.get('condition/'+id);
		},
		update: function(id, data)
		{
			return $http.put('condition/'+id, data);
		},
		delete: function(id)
		{
			return $http.delete('condition/'+id);
		}
	}
});

/* CONTROLLER */
app.controller('MainController', function($scope, $location){
	//
});
app.controller('KaywordController', function($scope, $location, MetricSvc, SiteSvc){

	// get all data
	$scope.get_metrics = function(){
		var req = MetricSvc.all();
		req.success(function(res){
			$scope.metrics = res;
		});
	}
	$scope.get_sites = function(){
		var req = SiteSvc.all();
		req.success(function(res){
			$scope.sites = res;
		});
	}

	// initiate
	$scope.get_metrics();
	$scope.temp_metric = {
		"name": "",
		"keywords": ""
	};

});