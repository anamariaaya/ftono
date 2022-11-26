document.addEventListener('DOMContentLoaded', function(){
    menuDropdown();
});

function menuDropdown(){
    const dropdownDiv = document.querySelector('.dropdown-btn');
    const dropdownMenu = document.querySelector('.menu-dropdown');
    const dropdownBtn = document.querySelector('#menu-btn');

    dropdownDiv.onclick = function(){
       dropdownMenu.classList.toggle('no-display');
       dropdownBtn.classList.toggle('active');
    };
};



function onYouTubeIframeAPIReady() {
    $('div[name="vp"]').each(function(){
    let vid =$(this).attr('videoId');
        let player = new YT.Player(this, {
        videoId: vid,
        playerVars:{'mute':1}
        });
    })    
}


    Mouseover = (el) => {
    let yt_object = YT.get(el.id);
    yt_object.playVideo();
    }
    Mouseout = (el) => {
    let yt_object = YT.get(el.id)
    yt_object.pauseVideo();
    }