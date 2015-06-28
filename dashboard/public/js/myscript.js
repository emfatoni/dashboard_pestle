var app = angular.module('daspestleApp', ['ngRoute', 'ui.bootstrap']);

app.run(function(){
	//
});

/* ROUTES */
app.config(function($routeProvider, $locationProvider){
	$routeProvider.when('/', {
		templateUrl: 'pages/home.html',
		controller: 'HomeController',
	});
	$routeProvider.when('/keyword', {
		templateUrl: 'pages/keyword.html',
		controller: 'KeywordController'
	});
	$routeProvider.when('/site', {
		templateUrl: 'pages/site.html',
		controller: 'SiteController',
	});
	$routeProvider.when('/environment', {
		templateUrl: 'pages/environment.html',
	});
	$routeProvider.when('/economy', {
		templateUrl: 'pages/economy.html',
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
			return $http({method: 'GET', url:'metric/create', params:data});
		},
		get: function(id)
		{
			return $http({method: 'GET', url:'metric/'+id});
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
			return $http({method: 'GET', url:'site/create', params:data});
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
			return $http({method: 'GET', url:'site/create', params:data});
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

app.filter('pestle', function(){
	return function(inputs, jenis){
		var terfilter = [];
		if(jenis === undefined || jenis === ''){
			return inputs;
		}

		angular.forEach(inputs, function(item){
			if(jenis === item.id_metric){
				terfilter.push(item);
			}
		});
		return terfilter;
	}
});

/* CONTROLLER */
app.controller('MainController', function($scope, $location){
	//
});
app.controller('HomeController', function($scope, $location, ConditionSvc){

	$scope.get_conditions = function(){
		var req = ConditionSvc.all();
		req.success(function(res){
			$scope.conditions = res;
			// $('#economy-box').unslider();
		});
	}

	// init
	$scope.get_conditions();

	// fungsi
	$scope.get_factor = function(jenis){
		var terfilter = [];
		if(jenis === undefined || jenis === ''){
			return $scope.conditions;
		}

		angular.forEach($scope.conditions, function(item) {
			if(jenis === item.id_metric){
				terfilter.push(item);
			}
		});

		return terfilter;
	}

});
app.controller('KeywordController', function($scope, $location, MetricSvc){

	// get all data
	$scope.get_metrics = function(){
		var req = MetricSvc.all();
		req.success(function(res){
			$scope.metrics = res;
		});
	}

	// initiate
	$scope.get_metrics();
	$scope.temp_metric = {
		"name": "",
		"keywords": "",
		"id": ""
	};
	$scope.is_loading = false;

	// fungsi-fungsi
	$scope.metric_add = function(){
		$scope.is_loading = true;
		var req = MetricSvc.update($scope.temp_metric.id, $scope.temp_metric);
		req.success(function(res){
			alert(res.status);
			$scope.get_metrics();
			$scope.is_loading = false;
		});
	}
	$scope.clear_keywords = function(){
		$scope.temp_metric.keywords = "";
	}
	$scope.get_metric = function(name){
		$scope.is_loading = true;
		var req = MetricSvc.get(name);
		req.success(function(res){
			$scope.temp_metric = res;
			$scope.is_loading = false;
		});
	}

});
app.controller('SiteController', function($scope, $location, SiteSvc){
	
	// get all data
	$scope.get_sites = function(){
		var req = SiteSvc.all();
		req.success(function(res){
			$scope.sites = res;
		});
	}

	// initiate
	$scope.get_sites();
	$scope.temp_site = {
		"id": "",
		"name": "",
		"url": "",
		"id_metric": ""
		
	};
	$scope.is_edit = false;
	$scope.is_loading = false;

	// functions
	$scope.empty_site = function(){
		$scope.temp_site = {
			"id": "",
			"name": "",
			"url": "",
			"id_metric": ""
			
		};
	}
	$scope.site_add = function(){
		$scope.is_loading = true;
		var req = SiteSvc.create($scope.temp_site);
		req.success(function(res){
			alert(res.status);
			$scope.get_sites();
			$scope.is_loading = false;
		});
	}
	$scope.site_edit = function(){
		$scope.is_loading = true;
		var req = SiteSvc.update($scope.temp_site.id, $scope.temp_site);
		req.success(function(res){
			alert(res.status);
			$scope.get_sites();
			$scope.empty_site();
			$scope.is_edit = false;
			$scope.is_loading = false;
		});
	}
	$scope.site_del = function(){
		$scope.is_loading = true;
		var req = SiteSvc.delete($scope.temp_site.id);
		req.success(function(res){
			alert(res.status);
			$scope.get_sites();
			$scope.empty_site();
			$scope.is_edit = false;
			$scope.is_loading = false;
		});
	}
	$scope.get_site = function(id){
		$scope.is_loading = true;
		var req = SiteSvc.get(id);
		req.success(function(res){
			$scope.temp_site = res;
			$scope.is_edit = true;
			$scope.is_loading = false;
		})
	}
	$scope.get_type = function(id){
		if(id == 1){
			return "politic";
		}else if(id == 2){
			return "social";
		}else if(id == 3){
			return "economy";
		}else if(id == 4){
			return "technology";
		}else if(id == 5){
			return "legal";
		}else if(id == 6){
			return "environment";
		}else{
			return "general";
		}
	}

});
