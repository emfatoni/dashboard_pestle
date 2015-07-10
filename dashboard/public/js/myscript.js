var app = angular.module('daspestleApp', ['ngRoute', 'ui.bootstrap', 'highcharts-ng']);

app.run(function(){
	//
});

/* ROUTES */
app.config(function($routeProvider, $locationProvider){
	$routeProvider.when('/', {
		templateUrl: 'pages/home_new.html',
		controller: 'HomeNewController',
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
		controller: 'DetailController'
	});
	$routeProvider.when('/economy', {
		templateUrl: 'pages/economy.html',
		controller: 'DetailController'
	});
	$routeProvider.when('/politic', {
		templateUrl: 'pages/politic.html',
		controller: 'DetailController'
	});
	$routeProvider.when('/social', {
		templateUrl: 'pages/social.html',
		controller: 'DetailController'
	});
	$routeProvider.when('/technology', {
		templateUrl: 'pages/technology.html',
		controller: 'DetailController'
	});
	$routeProvider.when('/legal', {
		templateUrl: 'pages/legal.html',
		controller: 'DetailController'
	});
	$routeProvider.when('/testing', {
		templateUrl: 'pages/pengujian.html',
		controller: 'TestController'
	});
	$routeProvider.when('/behind', {
		templateUrl: 'pages/behind.html',
		controller: 'TestController'
	});
});

/* SERVICES */
app.factory("TestSvc", function($http){
	return{
		crawl: function(data)
		{
			return $http({method: 'GET', url:'dashboard/crawl', params:data});
		},
		content: function(data)
		{
			return $http({method: 'GET', url:'dashboard/content', params:data});
		},
		keyword: function(data)
		{
			return $http({method: 'GET', url:'dashboard/keyword', params:data});
		},
		sentiment: function(data)
		{
			return $http({method: 'GET', url:'dashboard/sentiment', params:data});
		}
	}
});
app.controller('TestController', function($scope, $location, TestSvc, $filter, NewsSvc){

	$scope.query = "";
	$scope.is_loading1 = false;
	$scope.is_loading2 = false;
	$scope.is_loading3 = false;
	$scope.is_loading4 = false;

	$scope.news_now = {
		"title": "",
		"url": "",
		"website": ""
	};

	$scope.news_temp = {
		"title": "",
		"url": "",
		"website": "",
		"summary": "",
		"sentiment": "",
		"keyword": "",
		"id_metric": ""
	}

	$scope.url_news = "";
	$scope.content_news = "";
	$scope.keyword_news = "";
	$scope.sentiment_news = "";

	$scope.get_url_news = function(url_find){
		$scope.news_now = $filter('filter')($scope.urls, {url:url_find})[0];
		console.log($scope.news_now);
	}

	$scope.crawl = function(){
		$scope.is_loading1 = true;
		var obj = {"query": $scope.query};
		var req = TestSvc.crawl(obj);
		req.success(function(res){
			$scope.is_loading1 = false;
			$scope.urls = res;
		});
	}

	$scope.content = function(){
		$scope.is_loading2 = true;
		var obj = {"url": $scope.news_now.url};
		var req = TestSvc.content(obj);
		req.success(function(res){
			$scope.is_loading2 = false;
			$scope.content_news = res;
			console.log($scope.content_news);
		});
	}

	$scope.keyword = function(){
		$scope.is_loading4 = true;
		var obj = {"title": $scope.news_now.title};
		var req = TestSvc.keyword(obj);
		req.success(function(res){
			$scope.is_loading4 = false;
			$scope.keyword_news = res;
			console.log($scope.keyword_news);
		});
	}

	$scope.sentiment = function(){
		$scope.is_loading3 = true;
		var obj = {"text": $scope.content_news.text};
		var req = TestSvc.sentiment(obj);
		req.success(function(res){
			$scope.is_loading3 = false;
			$scope.sentiment_news = res;
			console.log($scope.sentiment_news);
		});
	}

	$scope.get_label = function(sentiment){
		if(sentiment === 'positive'){
			return 'label-success';
		}else if(sentiment === 'negative'){
			return 'label-danger';
		}else{
			return 'label-primary';
		}
	}

	$scope.get_summ = function(){
		$scope.summ_news = $scope.content_news.text.split('\n')[0];
	}

	$scope.save_news = function(){
		$scope.news_temp.title = $scope.news_now.title;
		$scope.news_temp.url = $scope.news_now.url;
		$scope.news_temp.website = $scope.news_now.website;
		$scope.news_temp.summary = $scope.summ_news;
		$scope.news_temp.keyword = $scope.keyword_news.keywords[0].text;
		$scope.news_temp.sentiment = $scope.sentiment_news.docSentiment.type;

		$scope.is_loading2 = true;
		var req = NewsSvc.create($scope.news_temp);

		req.success(function(res){
			$scope.is_loading2 = false;
			alert(res.status);
		});

	}

});

app.factory("NewsSvc", function($http){
	return{
		all: function()
		{
			return $http.get('news');
		},
		create: function(data)
		{
			return $http({method: 'GET', url:'news/create', params:data});
		},
		get: function(id)
		{
			return $http({method: 'GET', url:'news/'+id});
		},
		update: function(id, data)
		{
			return $http.put('news/'+id, data);
		},
		delete: function(id)
		{
			return $http.delete('news/'+id);
		}
	}
});


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
app.controller('HomeNewController', function($scope, $location, NewsSvc, $filter){
	

	$scope.get_sum_sentiment = function(metric, sentiment_val){
		var factor = $filter('filter')($scope.newss, {id_metric:metric});
		return $filter('filter')(factor, {sentiment:sentiment_val});
	}
	$scope.chart_val = function(metric){
		var data = [0, 0, 0];
		data[0] = $scope.get_sum_sentiment(metric, 'positive').length;
		data[1] = $scope.get_sum_sentiment(metric, 'neutral').length;
		data[2] = $scope.get_sum_sentiment(metric, 'negative').length;
		return data;
	}
	$scope.get_newss = function(){
		var req = NewsSvc.all();
		req.success(function(res){
			$scope.newss = res;

			// politic
			$scope.pol_val[0] = $scope.get_sum_sentiment(1, 'positive').length;
			$scope.pol_val[1] = $scope.get_sum_sentiment(1, 'neutral').length;
			$scope.pol_val[2] = $scope.get_sum_sentiment(1, 'negative').length;

			// economy
			$scope.eco_val[0] = $scope.get_sum_sentiment(3, 'positive').length;
			$scope.eco_val[1] = $scope.get_sum_sentiment(3, 'neutral').length;
			$scope.eco_val[2] = $scope.get_sum_sentiment(3, 'negative').length;

			// social
			$scope.soc_val[0] = $scope.get_sum_sentiment(2, 'positive').length;
			$scope.soc_val[1] = $scope.get_sum_sentiment(2, 'neutral').length;
			$scope.soc_val[2] = $scope.get_sum_sentiment(2, 'negative').length;

			// technology
			$scope.tec_val[0] = $scope.get_sum_sentiment(4, 'positive').length;
			$scope.tec_val[1] = $scope.get_sum_sentiment(4, 'neutral').length;
			$scope.tec_val[2] = $scope.get_sum_sentiment(4, 'negative').length;

			// legal
			$scope.leg_val[0] = $scope.get_sum_sentiment(5, 'positive').length;
			$scope.leg_val[1] = $scope.get_sum_sentiment(5, 'neutral').length;
			$scope.leg_val[2] = $scope.get_sum_sentiment(5, 'negative').length;

			// environment
			$scope.env_val[0] = $scope.get_sum_sentiment(6, 'positive').length;
			$scope.env_val[1] = $scope.get_sum_sentiment(6, 'neutral').length;
			$scope.env_val[2] = $scope.get_sum_sentiment(6, 'negative').length;

		});
	}

	//
	$scope.get_newss();

	//
	$scope.get_per_factor = function(metric){
		return $filter('filter')($scope.newss, {id_metric:metric});
	}
	$scope.get_label = function(sentiment){
		if(sentiment === 'positive'){
			return 'label-success';
		}else if(sentiment === 'negative'){
			return 'label-danger';
		}else{
			return 'label-primary';
		}
	}
	

	//
	$scope.pol_val = [0, 0, 0];
	$scope.eco_val = [0, 0, 0];
	$scope.soc_val = [0, 0, 0];
	$scope.tec_val = [0, 0, 0];
	$scope.leg_val = [0, 0, 0];
	$scope.env_val = [0, 0, 0];
	
	$scope.chart_pol = {
        options: {
            chart: {
                type: 'column'
            },
            plotOptions: {
				column: {
					colorByPoint: true,
					colors: [
						'#27ae60',
						'#3498db',
						'#c0392b'
					],
				}
			},
        },
        series: [{
            data: $scope.pol_val,
            pointWidth: 20
        }],
        title: {
            text: ''
        },
        xAxis: {
			categories: ['Positive', 'Neutral', 'Negative']
		},	
		yAxis: {
			title: {
				text: 'Jumlah'
			}
		},
		

        loading: false
    }
    $scope.chart_eco = {
        options: {
            chart: {
                type: 'column'
            },
            plotOptions: {
				column: {
					colorByPoint: true,
					colors: [
						'#27ae60',
						'#3498db',
						'#c0392b'
					],
				}
			},
        },
        series: [{
            data: $scope.eco_val,
            pointWidth: 20
        }],
        title: {
            text: ''
        },
        xAxis: {
			categories: ['Positive', 'Neutral', 'Negative']
		},	
		yAxis: {
			title: {
				text: 'Jumlah'
			}
		},
		

        loading: false
    }
    $scope.chart_soc = {
        options: {
            chart: {
                type: 'column'
            },
            plotOptions: {
				column: {
					colorByPoint: true,
					colors: [
						'#27ae60',
						'#3498db',
						'#c0392b'
					],
				}
			},
        },
        series: [{
            data: $scope.soc_val,
            pointWidth: 20
        }],
        title: {
            text: ''
        },
        xAxis: {
			categories: ['Positive', 'Neutral', 'Negative']
		},	
		yAxis: {
			title: {
				text: 'Jumlah'
			}
		},
		

        loading: false
    }
    $scope.chart_tec = {
        options: {
            chart: {
                type: 'column'
            },
            plotOptions: {
				column: {
					colorByPoint: true,
					colors: [
						'#27ae60',
						'#3498db',
						'#c0392b'
					],
				}
			},
        },
        series: [{
            data: $scope.tec_val,
            pointWidth: 20
        }],
        title: {
            text: ''
        },
        xAxis: {
			categories: ['Positive', 'Neutral', 'Negative']
		},	
		yAxis: {
			title: {
				text: 'Jumlah'
			}
		},
		

        loading: false
    }
    $scope.chart_leg = {
        options: {
            chart: {
                type: 'column'
            },
            plotOptions: {
				column: {
					colorByPoint: true,
					colors: [
						'#27ae60',
						'#3498db',
						'#c0392b'
					],
				}
			},
        },
        series: [{
            data: $scope.leg_val,
            pointWidth: 20
        }],
        title: {
            text: ''
        },
        xAxis: {
			categories: ['Positive', 'Neutral', 'Negative']
		},	
		yAxis: {
			title: {
				text: 'Jumlah'
			}
		},
		

        loading: false
    }
    $scope.chart_env = {
        options: {
            chart: {
                type: 'column'
            },
            plotOptions: {
				column: {
					colorByPoint: true,
					colors: [
						'#27ae60',
						'#3498db',
						'#c0392b'
					],
				}
			},
        },
        series: [{
            data: $scope.env_val,
            pointWidth: 20
        }],
        title: {
            text: ''
        },
        xAxis: {
			categories: ['Positive', 'Neutral', 'Negative']
		},	
		yAxis: {
			title: {
				text: 'Jumlah'
			}
		},
		

        loading: false
    }

});
app.controller('DetailController', function($scope, $location, NewsSvc, $filter){

	$scope.get_sum_sentiment = function(metric, sentiment_val){
		var factor = $filter('filter')($scope.newss, {id_metric:metric});
		return $filter('filter')(factor, {sentiment:sentiment_val});
	}
	$scope.get_newss = function(){
		var req = NewsSvc.all();
		req.success(function(res){
			$scope.newss = res;

			// politic
			$scope.pol_val[0] = $scope.get_sum_sentiment($scope.met, 'positive').length;
			$scope.pol_val[1] = $scope.get_sum_sentiment($scope.met, 'neutral').length;
			$scope.pol_val[2] = $scope.get_sum_sentiment($scope.met, 'negative').length;
		});
	}

	$scope.get_newss();

	$scope.get_per_factor = function(metric){
		return $filter('filter')($scope.newss, {id_metric:metric});
	}
	$scope.get_label = function(sentiment){
		if(sentiment === 'positive'){
			return 'label-success';
		}else if(sentiment === 'negative'){
			return 'label-danger';
		}else{
			return 'label-primary';
		}
	}
	$scope.get_box_color = function(sentiment){
		if(sentiment === 'positive'){
			return 'fd-box-turquoise';
		}else if(sentiment === 'negative'){
			return 'fd-box-pomegranate';
		}else{
			return 'fd-box-peter-river';
		}
	}
	$scope.get_sign = function(sentiment){
		if(sentiment === 'positive'){
			return 'glyphicon-plus-sign';
		}else if(sentiment === 'negative'){
			return 'glyphicon-minus-sign';
		}else{
			return 'glyphicon-record';
		}
	}

	$scope.pol_val = [0, 0, 0];
	$scope.chart_pol = {
        options: {
            chart: {
                type: 'column'
            },
            plotOptions: {
				column: {
					colorByPoint: true,
					colors: [
						'#27ae60',
						'#3498db',
						'#c0392b'
					],
				}
			},
        },
        series: [{
            data: $scope.pol_val,
            pointWidth: 20
        }],
        title: {
            text: ''
        },
        xAxis: {
			categories: ['Positive', 'Neutral', 'Negative']
		},	
		yAxis: {
			title: {
				text: 'Jumlah'
			}
		},
		

        loading: false
    }

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
