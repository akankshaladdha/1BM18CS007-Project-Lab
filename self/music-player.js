
    var songs = ["bekhayali.mp3",
                "ghungroo.mp3",
                "yaad.mp3",
                "kabira.mp3",
                "paniyosa.mp3"];
    var currentSong = 0;
    var song = new Audio();
    
    var seekBar = document.querySelector('.seek-bar');
    var playButton = document.querySelector('.audio-player .playorpause');
    var forwardButton = document.querySelector('.audio-player .next');
    var backwardButton = document.querySelector('.audio-player .back');
    var playButtonIcon = playButton.querySelector('i');
    var forwardButtonIcon = forwardButton.querySelector('i');
    var backwardButtonIcon = backwardButton.querySelector('i');
    var fillBar = seekBar.querySelector('.fill');
    var replayButton = document.querySelector('.audio-player .loop');
    var replayButtonIcon = replayButton.querySelector('i');
    var mouseDown = false;
    var flag=0;

    seekbar = document.getElementsByClassName("seek-bar");
	curtimetext = document.getElementById("curtimetext");
    durtimetext = document.getElementById("durtimetext");    
    song.addEventListener("timeupdate",seektimeupdate,false);
    
    window.onload = loadSong;
    function loadSong(){
        
        song.src = "music/" + songs[currentSong];
        song.play();    
    } 

    song.addEventListener('ended',function(){
        durtimetext.innerHTML ="0:00";
        next();
      });
     
    function next()
    {
        currentSong = (currentSong + 1) % songs.length;
        fillBar.style.width = 0 + '%';
        loadSong();
        playButtonIcon.className = 'ion-pause';
    }
    function back()
    {
        currentSong = (currentSong - 1) ;
        currentSong = (currentSong < 0) ? songs.length - 1 : currentSong;
        fillBar.style.width = 0 + '%';
        loadSong();
        playButtonIcon.className = 'ion-pause';
    }
    function playorpausesong(){
    song.playbackrate = 1; 
    if(song.paused){
        song.play();
        playButtonIcon.className = 'ion-pause';
    }
    else{
        song.pause();
        playButtonIcon.className = 'ion-play';
        }
}

    
    song.addEventListener('timeupdate', function () {
        if (mouseDown) return;
    
        let p = song.currentTime / song.duration;
    
        fillBar.style.width = p * 100 + '%';
    });
    
    function clamp (min, val, max) {
        return Math.min(Math.max(min, val), max);
    }
    
    function getP (e) {
        let p = (e.clientX - seekBar.offsetLeft) / seekBar.clientWidth;
        p = clamp(0, p, 1);
    
        return p;
    }
    
    seekBar.addEventListener('mousedown', function (e) {
        mouseDown = true;
        let p = getP(e);
        fillBar.style.width = p * 100 + '%';
    });

    
    window.addEventListener('mousemove', function (e) {
        if (!mouseDown) return;
    
        let p = getP(e);
    
        fillBar.style.width = p * 100 + '%';
    });
    
    window.addEventListener('mouseup', function (e) {
        if (!mouseDown) return;
    
        mouseDown = false;
    
        let p = getP(e);
    
        fillBar.style.width = p * 100 + '%';
    
        song.currentTime = p * song.duration;
    });

    function seektimeupdate(){
        
        var nt = song.currentTime * (100 / song.duration);
        seekbar.value = nt;
        var curmins = Math.floor(song.currentTime / 60);
        var cursecs = Math.floor(song.currentTime - curmins * 60);
        var durmins = Math.floor(song.duration / 60);
        var dursecs = Math.floor(song.duration - durmins * 60);
        if(cursecs < 10){ cursecs = "0"+cursecs; }
        if(dursecs < 10){ dursecs = "0"+dursecs; }
        if(curmins < 10){ curmins = "0"+curmins; }
        if(durmins < 10){ durmins = "0"+durmins; }
        if (isNaN(song.duration)){
            durtimetext.innerHTML = '00:00';
        }
        else
        { curtimetext.innerHTML = curmins+":"+cursecs;
            durtimetext.innerHTML = durmins+":"+dursecs;
        }    
}
function replay()
{
    loadSong();
}
    




/*function Alert(){
    setTimeout(function () { 
        swal({
          title: "Do you wish to logout?",
          //icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: 'red',
            confirmButtonText: 'Yes, Logout!',
            background: 'black',
        },
        function(isConfirm){
          if (isConfirm) {
           
            window.location = "regorlogin.php";
            
          }
          
        }); }, 100);
    
    }*/
    