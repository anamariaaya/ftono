// youtube-api.js
export function loadYouTubeIframeAPI() {
    return new Promise((resolve, reject) => {
        if (window.YT && window.YT.Player) {
            resolve(window.YT);
            return;
        }

        const tag = document.createElement('script');
        tag.src = 'https://www.youtube.com/iframe_api';
        tag.onload = () => {
            window.onYouTubeIframeAPIReady = () => {
                resolve(window.YT);
            };
        };
        tag.onerror = (error) => reject(error);

        const firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    });
}
