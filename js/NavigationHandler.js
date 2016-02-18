
function NavigationHandler() {

	var local = {            
    }
    
    var api = {
        // the API object contains all the public members and methods we wish to expose
        // the Class function shuld return this.
        init: init,
        getSongName: getSongName
    };
    return api;
    
    
    function init() {    
    	var ANDROID = /Android/i.test(navigator.userAgent);
    	if (ANDROID) $(".header").hide();

        if (this.navigationHandler == null) {
        	this.navigationHandler = api;
        }
	}	

    function getSongName(){
    	navigationHandler.setSongName ($(".song-title").text());
	}

}
	