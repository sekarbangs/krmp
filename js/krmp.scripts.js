$(function(){
	processView.init();	
});
function aab(){
	if($('#___gcse_0').length){
		$('.gsib_a').css('padding','0px');
		$('input[placeholder="Custom Search"]')
			.attr('placeholder','KRMP Search')
			.parent()
			.css('padding','0px')
			.removeClass('gsib_a');
			$('input.gsc-search-button').val('Search').css({
					'height':'auto',
					'width' : 'auto'
			});
	}
	else
	{
		setTimeout('aab()',1000);
	}
}
var processView={
	reqSongId 	: '',
	reqUrl		: '',
	audioCtx 	: null,
	songSrc 	: new Array(),
	songbuffer 	: null,
	playSong 	: {title:"",mp3:"",poster:""},
	songLength	: 0,
	totalDuration : 0,
	timeoutFunc : '',
	init : function(){
			var tS=document.createElement('script');tS.innerHTML='$(\'a\').click(function(e){e.preventDefault();processView.getView(this.href);});';
			document.body.appendChild(tS);
			aab();
			var reqURI = $('requesteduri').html();
			if(reqURI.length > 0)alert(reqURI);
			//processView.resetAdBlock();
	},
	getSongUrl 	: 	function(a){
		processView.reqSongId=a;
		//processView.songSrc = [];
		processView.songSrc[processView.reqSongId] = [];
		processView.songLength=0;
		processView.totalDuration = 0;
		clearTimeout(processView.timeoutFunc);
		if(a){
			$.ajax({
				url 	: 	'http:\/\/'+document.domain+'\/index.php\/songs\/s_home\/play\/'+a,
				cache	: 	'true',
				type	: 	'GET',
				dataType : 	'JSON',
				beforeSend : function(){
					if(typeof $('script#notifyJs').attr('src') == 'undefined'){
						var sa = document.createElement('script');
						sa.id  = 'notifyJs' ;
						sa.src = '\/\/'+document.domain+'\/js\/notify.min.js';
						document.body.appendChild(sa);
					}
					$('#togglePlayerBtn').fadeIn(1000).html('')
										.css('background','url(/images/mloading.gif) no-repeat center center')
										.css('background-size','cover');
				},
				success	: 	function(a,b,c){
					if(c.state=200&&b=='success'){
						processView.actionPlayer(a.a,a.b,a.c,a.d,processView.reqSongId);
					}
				},
				error 	: 	function(a,b,c){
					console.log(c);
				}
			});
		}
	},
	actionPlayer : 	function(a,b,c,d,e){
		processView.playSong.title = c.toUpperCase().replace(/ /g,'_');
		processView.playSong.mp3 = atob(a);
		processView.playSong.poster='http:\/\/'+document.domain+'\/images\/albums\/'+d+'\/a_art.jpg';
		var nowPlaying = "";
		$.ajax({
			url 	: 	(a&&b)?'http:\/\/'+document.domain+'\/index.php\/songs\/s_home\/play\/song\/'+b:'',
			cache	: 	'true',
			type	: 	'POST',
			data 	: 	{secKey:b},
			dataType : 	'JSON',
			success	: 	function(a,b){
				if(a.status==true&&b=='success'){
					(processView.audioCtx)?processView.audioCtx.close():'';
					processView.audioCtx = new (window.AudioContext || window.webkitAudioContext)();
					processView.audioCtx.onstatechange = processView.playerHandler();
					processView.updateSongBuffer();
				}
				else
				{
					alert('actionPlayer failed after ajax call');
				}
			}
		});	
	},
	updateSongBuffer 	: function(){
		var request = new XMLHttpRequest();
		processView.songLength++;
		request.open('GET', processView.playSong.mp3+'/'+processView.songLength, true);
		request.responseType = 'arraybuffer';
		request.onprogress = function(){
			$('#togglePlayerBtn').css('background','url(/images/mloading.gif) no-repeat center center').css('background-size','cover');
		},
		request.onload = function(a) {
			$('#togglePlayerBtn').css('background','transparent');



			var audioData = request.response;
			var songSrc = processView.audioCtx.createBufferSource();
			processView.audioCtx.decodeAudioData(audioData).then(function(buffer) {				
			    songSrc.buffer = buffer;
			    processView.songSrc[processView.reqSongId][processView.songLength] = songSrc;
			    processView.songSrc[processView.reqSongId][processView.songLength].connect(processView.audioCtx.destination);
			    if(processView.songSrc[processView.reqSongId].length > 2){
			     	processView.totalDuration += (processView.songSrc[processView.reqSongId][(processView.songLength-1)].buffer.duration)-0.0250;
				}
				else
				{
					processView.totalDuration += processView.audioCtx.currentTime;
				}

			   	processView.songSrc[processView.reqSongId][processView.songLength].start(processView.totalDuration);
				processView.timeoutFunc = setTimeout('processView.updateSongBuffer()',2000);		
		  	},
		  	function(e){ /*console.log("Error with decoding audio data ...");console.log(e);*/});
		 }
		 request.send();
	},
	playerHandler 	: function(){
		if($('#togglePlayerBtn').attr('state')=='playing'){
			if(processView.audioCtx.state=='running')processView.audioCtx.suspend();
			$('#togglePlayerBtn').attr('state','suspended');
			$('#togglePlayerBtn').html('<span class="fa fa-play" aria-hidden="true"></span>');
		}
		
		else if($('#togglePlayerBtn').attr('state')=='suspended'){
			processView.audioCtx.resume(processView.audioCtx.currentTime);
			$('#togglePlayerBtn').attr('state','playing');
			$('#togglePlayerBtn').html('<span class="fa fa-pause" aria-hidden="true"></span>');
		}
		else if($('#togglePlayerBtn').attr('state')=='idle'){
			if(processView.audioCtx.state=='suspended'){
				processView.audioCtx.resume(processView.audioCtx.currentTime);
				$('#togglePlayerBtn').attr('state','playing');
				$('#togglePlayerBtn').html('<span class="fa fa-pause" aria-hidden="true"></span>');
			}
			else if(processView.audioCtx.state=='closed'){
				$('#togglePlayerBtn').attr('state','idle');
				$('#togglePlayerBtn').html('<span class="fa fa-play" aria-hidden="true"></span>');
				processView.getSongUrl(processView.reqSongId);
			}
		}
		else 
		{
			$('#togglePlayerBtn').attr('state','playing').html('<span class="fa fa-pause" aria-hidden="true"></span>');
		}
	},
	getView		: function(aE){
		var aR=aE.toString().split('/');
		if(aR.length > 4){
			$.ajax({
				url 	: 	aE,
				cache	: 	'false',
				type	: 	'GET',
				dataType : 	'JSON',
				success	: 	function(a,b,c){
					if(c.status==200&&b=='success'){
						document.title=a.pageTitle;
						history.pushState({urlPath:aE.href},"",aE.href)
						$('#container').html(a.resHtml);
						$(window).bind('popstate', function(e) {
							e.preventDefault();
							history.replaceState({urlPath:aE.href},"",aE.href)
			            });
						$('#container a').click(function(e){e.preventDefault();processView.getView(this);});
					}
				},
				error	: 	function(c,b,a){
					lg(a);
					lg(b);
					lg(c);
				}
			});
		}
	}
};
function lg(txt){
	console.log(txt);
}