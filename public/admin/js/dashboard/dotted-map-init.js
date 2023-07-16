// Generated by CoffeeScript 1.4.0

(function($) {
	
var SalreoMap = function(){	

	var mapSettings = function(){

	var mapSelector = jQuery('#smallimap');

	mapSelector.empty();		
	
	var containerWidth = parseInt(mapSelector.parents(mapSelector.data('container')).width());
	
	var  containerHeight = 300;
	var dotRadiusValue = 8;
	if(containerWidth > 1200){
		containerHeight = 300; 
	}else if(containerWidth > 600 && containerWidth <= 991){
		containerHeight = 400; 
		dotRadiusValue = 4;
	}else if(containerWidth > 991 && containerWidth <= 1200){
		containerHeight = 500; 
		dotRadiusValue = 4;
	}else if(containerWidth > 350 && containerWidth < 600){
		containerHeight = 300; 
		dotRadiusValue = 4;
	}else if(containerWidth < 350 ){
		containerHeight = 200; 
		dotRadiusValue = 2;
	}
	
	
	var debugMode, getClientsForMap, log, mapOptions, markerPath, myLogoPath, siLogoPath, testIntervalId;
	  debugMode = true;
	  testIntervalId = -1;
	  mapOptions = {
		dotRadius: dotRadiusValue,
		width: containerWidth,
		//width: 1000,
		height: containerHeight,
		//height: 500,
		colors: {
		  lights: ["#fdf6e3", "#fafafa", "#dddddd", "#cccccc", "#bbbbbb"],
		  darks: ["#777777", "#888888", "#999999", "#aaaaaa"]
		}
	  };
	  
	log = function(message) {
		var _ref;
		if (debugMode) {
		  return (_ref = window.console) != null ? _ref.log(message) : void 0;
		}
	};
	
	getClientsForMap = function() {
		smallimap.addMapIcon('85 Connor pt. Japan',
							'Mountain View, California, United States',
							'',
							myLogoPath,
							70, -60,
							0,1,
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
							'javascript:void(0);',
							'circle-marker'
							);
							
		smallimap.addMapIcon('Small Improvements, Berlin',
							'1634 Metro Manila, Philippines',
							'',
							siLogoPath,
							120, -70,
							2,2,
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
							'javascript:void(0);',
							'circle-marker bg-success sm'
							);
		
		smallimap.addMapIcon('Small Improvements, Berlin',
							'65 King Street East and in Kitchener',
							'',
							siLogoPath,
							180, -100,
							2,1,
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
							'javascript:void(0);',
							'circle-marker'
							);
							
		smallimap.addMapIcon('Small Improvements, Berlin',
							'6 Pancras Square, London N1C 4AG, United Kingdom',
							'',
							siLogoPath,
							220, 25.156409430378805,
							2,1,
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
							'javascript:void(0);',
							'circle-marker'
							
							);
							
		smallimap.addMapIcon('Small Improvements, Berlin',
							'2300 Traverwood Dr. Ann Arbor',
							'',
							siLogoPath,
							170, 0,
							2,1,
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
							'javascript:void(0);',
							'circle-marker'
							);
		
		smallimap.addMapIcon('Small Improvements, Berlin',
							'Aabogade 158200 Aarhus Denmark',
							'',
							siLogoPath,
							-40, -70,
							2,1,
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
							'javascript:void(0);',
							'circle-marker bg-success'
							);
							
		smallimap.addMapIcon('Small Improvements, Berlin',
							'Claude Debussylaan 34 1082 MD',
							'',
							siLogoPath,
							-80, 0,
							2,1,
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
							'javascript:void(0);',
							'circle-marker'
							
							);
							
		smallimap.addMapIcon('Small Improvements, Berlin',
							'Skt. Petri Passage 5 1165 Copenhagen Denmark',
							'',
							siLogoPath,
							85.85336795021482, 0,
							2,1,
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
							'javascript:void(0);',
							'circle-marker bg-danger md'
							);
							
		smallimap.addMapIcon('Small Improvements, Berlin',
							'TECOM Zone, Dubai Internet City',
							'',
							siLogoPath,
							130, -25.156409430378805,
							2,1,
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
							'javascript:void(0);',
							'gg'
							);
							
		smallimap.addMapIcon('Small Improvements, Berlin',
							'Building 30 MATAM, Advanced Technology',
							'',
							siLogoPath,
							160, -22.156409430378805,
							2,1,
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
							'javascript:void(0);',
							'circle-marker bg-danger sm'
							);
							
		smallimap.addMapIcon('Small Improvements, Berlin',
							'Eski Buyukdere Caddesi No: 209 34394',
							'',
							siLogoPath,
							200, -60.156409430378805,
							2,1,
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
							'javascript:void(0);',
							'circle-marker bg-success'
							);
							
		smallimap.addMapIcon('Small Improvements, Berlin',
							'35 Ballyclare Drive, Building E Johannesburg',
							'',
							siLogoPath,
							-20, -100.156409430378805,
							2,1,
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
							'javascript:void(0);',
							'circle-marker sm'
							);
							
		smallimap.addMapIcon('Small Improvements, Berlin',
							'Yigal Alon 98 Tel Aviv, 6789141 Israel ',
							'',
							siLogoPath,
							75.85336795021482, 25.156409430378805,
							2,1,
							'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
							'javascript:void(0);',
							'circle-marker'
							);
		
		
		smallimap.addMapIcon('45 Connor St. London, 44523',
									'98AB Alexander Court, London',
									'',
									siLogoPath,
									-43.173, -22.925,
									1,2,
									'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun',
									'javascript:void(0);',
									'circle-marker'
									);
	};
  
 
	 setTimeout(function(){
	  
		window.smallimap = mapSelector.smallimap(mapOptions).data('api');
		
		smallimap.run();
		getClientsForMap();
	  
	  }, 500);
  
	}
	
	/* Function ============ */
	return {
		init:function(){
			mapSettings();
		},

		
		load:function(){
			mapSettings();
		},
		
		resize:function(){
			mapSettings();
		}
	}
	
}();  

jQuery(document).ready(function(){
	
}); 

jQuery(window).on('load',function(){
	SalreoMap.load();
});

jQuery(window).on('resize',function(){
	
	
	setTimeout(function(){
		SalreoMap.resize();	
	}, 1000);
	
});  		
	
})(jQuery);