(function() {
	/* App Singleton MAIN 
	 * 
	 * @copyright: (C) 2014 Kibble Games Inc in cooperation with Vancouver Film School. All Rights Reserved. 
	 * @author: Scott Henshaw {@link mailto:shenshaw@vfs.com} 
	 * @version: 1.1.0 
	 * 
	 * @summary: Framework Singleton Class to contain a web app
	 */
	function App() {
	
		var _BASEDIR = "../MediaPlayer/media/";
		var _SETTINGS = {	formats: ["mp3"],
						    preload: true,
						    autoplay: true,
						    loop: false };
		var _LOADSETTINGS = {	formats: ["mp3"],
						    preload: true,
						    autoplay: false,
						    loop: false };
		
		var local = {
	        // the local object contains all the private members used in this class	            
            firstPlay: true,
            currentSong: null,
            currentPosition: 0,
            playlist: null,
            serverPlaylist: [],
            userPlaylist: []
	    }
	    
        var api = {
	        // the API object contains all the public members and methods we wish to expose
	        // the Class function shuld return this.
            init: init
	    };
	    return api;
	    
	    
	    function ajax (cmd){
	    	return $.post( "server.php", { "action": cmd } );
	    }
	    //Function to add the name of the song currently playing to the title area
	    function nowPlaying( title ) {
	    	$(".song-title").html(title);
	    }
	    
	    
        function init() {    
        	//Buzz library properties initilization
        	buzz.defaults.formats = ['ogg', 'mp3'];
        	
//        	if (!buzz.isOGGSupported())
//        	    alert("Your browser doesn't support OGG Format.");
        	if (!buzz.isMP3Supported()) 
        	    alert("Your browser doesn't support MP3 Format.");
        	
        	
        	//First hide the play button, so that only the pause button is visible
        	$("#pauseicon").hide();
        	$("#off").hide();
        	
        	//Ask for the list of songs on the server
        	ajax("getPlaylist").done(function(data){
        		var response = JSON.parse(data);
        		setPlaylist( response );
        	});
    
        	//Click events for player controllers
        	$(".controlls").click(function(){
        		switch(this.id){
		    		case "previous":
		    			previous();
						break;
					case "togglePlay":
						togglePlay();
						break;
					case "next":
						next();
						break;
					default: break;
        		}
        	});
        	
        	$(".controlls").mousedown(function(){
        		if(local.currentSong.isPaused()) return;
        		
        		switch(this.id){
					case "rewind":
						if(local.currentSong.getTime()-6 > 0)
							local.currentSong.setTime(local.currentSong.getTime()-5);
						break;
					case "forward":
						if(local.currentSong.getTime()+6 < local.currentSong.getDuration())
							local.currentSong.setTime(local.currentSong.getTime()+5);
						break;
					default: break;
	    		}
        	});
        	
        	$(".volume").click(function() {
        		local.currentSong.toggleMute();
        		$("#off").hide();
            	$("#on").show();
            	
            	if(local.currentSong.isMuted()){
        			$("#off").show();
                	$("#on").hide();
        		}
        	});
        	
        	//To add to the user playlist
        	$("#serverPlaylist").on("click", "i",  function(){
        		var songID = "#song" + this.id;
        		$(songID).clone().appendTo("#userPlaylist");
        		$("#collapseUserPlaylist").collapse('show');
            	
            	$(this, "#userPlaylist").removeClass('fa fa-plus-square fa-lg').addClass('fa fa-minus-square fa-lg');
            	$(this, "#serverPlaylist").removeClass('fa fa-plus-square fa-lg').addClass('fa fa-minus-square fa-lg');
            	
            	local.userPlaylist.push(local.serverPlaylist[this.id]);
            	
            	$("p", songID).html(local.userPlaylist.length + ".");
            	
            	console.log(local.userPlaylist);

            	if(local.userPlaylist.length != 0)
            		local.currentSong = new buzz.sound(_BASEDIR + local.userPlaylist[local.currentPosition], _LOADSETTINGS);
            });
    	}	
        
        
        
        function setPlaylist( response ) {
        	local.playlist = response.playlist;
        	local.serverPlaylist = response.playlist;
    		if (!local.playlist) return;
    		
    		for(var i=0;i<local.playlist.length;i++){
    			//For adding to a playlist
    			var $bottonAdd = $("<i>", {class: 'fa fa-plus-square fa-lg', id: i });
    			
    			var $trackNo = $("<p>", {class: "songNo", html: i+1 + ". "});
    			var $song = $("<li>", {class: "list-group-item song", id: "song"+i,	 html:$trackNo});
    			$song.append(local.playlist[i]);
    			
    			$("#serverPlaylist").append($song);
    		}
    		
    		local.currentSong = new buzz.sound(_BASEDIR + local.playlist[local.currentPosition], _LOADSETTINGS);
    		//Set the sound events
    		setEvents();
        }
        
        
        function previous(){
        	if ((local.currentPosition - 1) < 0) return;
        	
        	local.currentPosition--;
        	$("#song" + (local.currentPosition+1)).show();
        	local.currentSong.stop();
        	
        	local.currentSong = new buzz.sound(_BASEDIR + local.playlist[local.currentPosition], _SETTINGS);
        	local.currentSong.togglePlay();
    		setEvents(); //Reset the events to the new sound element
        	
        	updateView();
        }
        
        function rewind(){
        	
        }
        
        function togglePlay(){
        	local.currentSong.togglePlay();
        	$("#song"+local.currentPosition).hide();
    		nowPlaying(local.playlist[local.currentPosition]);
        	updateView();
        }
        
        function forward(){
        	
        }
        
        function next(){
        	if ((local.currentPosition + 1) >= local.playlist.length) return;
        	
        	local.currentPosition++;
        	$("#song" + (local.currentPosition)).hide();
        	local.currentSong.stop();
        	
        	local.currentSong = new buzz.sound(_BASEDIR + local.playlist[local.currentPosition], _SETTINGS);
        	local.currentSong.togglePlay();
    		setEvents(); //Reset the events to the new sound element
    		
        	updateView();
        }
    	
    	
        function setEvents() {
        	local.currentSong.bind("timeupdate", function(e) {
	        	time     = local.currentSong.getTime(),
	            duration = local.currentSong.getDuration(),
	            percent  = buzz.toPercent( time, duration, 2 );
	        	$('.progress-bar').css('width', percent+'%').attr('aria-valuenow', percent); 
        	});
        	
        	local.currentSong.bind("ended", function(e){
        		next();
        	});
        }

        
        function updateView (){
        	$("#playicon").hide();
        	$("#pauseicon").show();
        	
        	if (local.currentSong.isPaused()){
            	$("#playicon").show();
            	$("#pauseicon").hide();
        	}
        	
    		nowPlaying(local.playlist[local.currentPosition]);
        }
    }
	
        
	var app = new App();
	
	$(document).ready( function() {
		app.init();
	});
})();