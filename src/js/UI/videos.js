import { loadYouTubeIframeAPI } from './youtube-api.js';
import { videoIds } from './selectores.js';


let player;
let currentVideoIndex = 0;

export async function initializePlayer() {
    try {
        const YT = await loadYouTubeIframeAPI();
        player = new YT.Player('player', {
            height: '360',
            width: '640',
            videoId: videoIds[0],
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            },
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });

        createVideoList();

        function onPlayerReady(event) {
            event.target.playVideo();
        }
        
        function onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.ENDED) {
                console.log('Video ended');
            }
        }

    } catch (error) {
        console.error('Failed to load YouTube IFrame API:', error);
    }
}

function createVideoList() {
    const videoItemsContainer = document.getElementById('videoItems');
    videoItemsContainer.innerHTML = '';

    videoIds.forEach((videoId, index) => {
        const videoItem = document.createElement('div');
        videoItem.className = 'video-item';

        const playButton = document.createElement('button');
        playButton.textContent = 'Play';
        playButton.addEventListener('click', () => playVideo(index));

        const videoTitle = document.createElement('span');
        videoTitle.textContent = `Video ${index + 1}`; // Fetch and use actual video title if needed

        videoItem.appendChild(videoTitle);
        videoItem.appendChild(playButton);
        videoItemsContainer.appendChild(videoItem);
    });

    document.getElementById('playAll').addEventListener('click', playAllVideos);
}

function playVideo(index) {
    currentVideoIndex = index;
    player.loadVideoById(videoIds[index]);
}

function playAllVideos() {
    currentVideoIndex = 0;
    player.loadVideoById(videoIds[currentVideoIndex]);
}

