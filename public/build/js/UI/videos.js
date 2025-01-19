import { loadYouTubeIframeAPI } from './youtube-api.js';

let player;
let currentVideoIndex = 0;
let playAll = false;

export async function initializePlayer(videoData) {
    try {
        const YT = await loadYouTubeIframeAPI();
        player = new YT.Player('player', {
            height: '360',
            width: '100%',
            videoId: videoData[0].videoId, // Set the first video initially
            events: {
                'onReady': onPlayerReady,
                'onStateChange': (event) => onPlayerStateChange(event, videoData)
            }
        });

        createVideoList(videoData);

        function onPlayerReady(event) {
            // No need to play the video immediately when the player is ready.
            // Just wait for user interaction (click or playAll button)
        }

        function onPlayerStateChange(event, videoData) {
            if (event.data === YT.PlayerState.PLAYING) {
                updateCurrentVideoClass();
            } else if (event.data === YT.PlayerState.ENDED) {
                if (playAll && currentVideoIndex < videoData.length - 1) {
                    // Move to the next video in the playlist
                    currentVideoIndex++;
                    player.loadVideoById(videoData[currentVideoIndex].videoId);
                }
            } else if (event.data === YT.PlayerState.PAUSED || event.data === YT.PlayerState.CUED) {
                clearCurrentVideoClass();
            }
        }

    } catch (error) {
        console.error('Failed to load YouTube IFrame API:', error);
    }
}

function createVideoList(videoData) {
    const videoItemsContainer = document.getElementById('videoItems');
    videoItemsContainer.innerHTML = ''; // Clear any existing video list

    videoData.forEach((video, index) => {
        const videoItem = document.createElement('div');
        videoItem.className = 'video__items__item';
        videoItem.dataset.index = index;
        videoItem.addEventListener('click', () => playVideo(index, videoData));

        const playButton = document.createElement('button');
        const playIcon = document.createElement('i');
        playIcon.className = 'fas fa-play';

        playButton.appendChild(playIcon);

        const videoTitle = document.createElement('span');
        videoTitle.textContent = video.title; // Use actual video title from the database

        videoItem.appendChild(videoTitle);
        videoItem.appendChild(playButton);
        videoItemsContainer.appendChild(videoItem);
    });

    // Attach the event listener for the "Play All" button
    document.getElementById('playAll').addEventListener('click', () => playAllVideos(videoData));
}

function playVideo(index, videoData) {
    currentVideoIndex = index;
    playAll = false; // Disable playAll mode when clicking on a single video
    player.loadVideoById(videoData[index].videoId);
}

function playAllVideos(videoData) {
    currentVideoIndex = 0;
    playAll = true; // Enable playAll mode
    player.loadVideoById(videoData[currentVideoIndex].videoId);
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
