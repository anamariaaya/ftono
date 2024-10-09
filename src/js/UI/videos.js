import { loadYouTubeIframeAPI } from './youtube-api.js';
import { videoIds } from './selectores.js';

let player;
let currentVideoIndex = 0;
let playAll = false;

export async function initializePlayer() {
    try {
        const YT = await loadYouTubeIframeAPI();
        player = new YT.Player('player', {
            height: '360',
            width: '100%',
            videoId: videoIds[0],
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });

        createVideoList();

        function onPlayerReady(event) {
            // No need to play the video immediately when the player is ready.
            // Just wait for user interaction (click or playAll button)
        }
        
        function onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.PLAYING) {
                // Add 'video__current' class when a video starts playing
                updateCurrentVideoClass();
            } else if (event.data === YT.PlayerState.ENDED) {
                if (playAll && currentVideoIndex < videoIds.length - 1) {
                    // Move to the next video
                    currentVideoIndex++;
                    player.loadVideoById(videoIds[currentVideoIndex]);
                }
            } else if (event.data === YT.PlayerState.PAUSED || event.data === YT.PlayerState.CUED) {
                // Remove 'video__current' class when the video is paused or cued
                clearCurrentVideoClass();
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
        videoItem.className = 'video__items__item';
        videoItem.dataset.index = index;
        videoItem.addEventListener('click', () => playVideo(index));

        const playButton = document.createElement('button');

        const playIcon = document.createElement('i');
        playIcon.className = 'fas fa-play';

        playButton.appendChild(playIcon);

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
    playAll = false; // Disable playAll mode when clicking on a single video
    player.loadVideoById(videoIds[index]);
}

function playAllVideos() {
    currentVideoIndex = 0;
    playAll = true; // Set playAll mode to true
    player.loadVideoById(videoIds[currentVideoIndex]);
}

function updateCurrentVideoClass() {
    const videoItems = document.querySelectorAll('.video__items__item');
    videoItems.forEach((item, index) => {
        if (index === currentVideoIndex) {
            item.classList.add('video__current');
        } else {
            item.classList.remove('video__current');
        }
    });
}

function clearCurrentVideoClass() {
    const videoItems = document.querySelectorAll('.video__items__item');
    videoItems.forEach((item) => {
        item.classList.remove('video__current');
    });
}
