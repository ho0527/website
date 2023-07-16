// // Fetch the music data from the API (albumlist.json) using Ajax or fetch API

// // You can set the initial music data and state here for demonstration purposes
// const musicData = {
//     albumCover: 'https://example.com/album_cover.jpg',
//     title: 'Sample Song',
//     artists: 'Sample Artist',
//     audioPath: 'https://example.com/sample_song.mp3',
//     lyrics: 'Sample lyrics will be displayed here.'
// };

// // Get elements
// const albumCoverEl = document.querySelector('.album-cover img');
// const titleEl = document.querySelector('.title');
// const artistsEl = document.querySelector('.artists');
// const playBtn = document.querySelector('.play-btn');
// const prevBtn = document.querySelector('.prev-btn');
// const nextBtn = document.querySelector('.next-btn');
// const progressBar = document.querySelector('.progress-bar');
// const currentTimeEl = document.querySelector('.current-time');
// const totalTimeEl = document.querySelector('.total-time');
// const volumeSlider = document.querySelector('.volume-slider');
// const lyricsEl = document.querySelector('.lyrics-text');

// // Set initial music data
// albumCoverEl.src = musicData.albumCover;
// titleEl.textContent = musicData.title;
// artistsEl.textContent = musicData.artists;
// lyricsEl.textContent = musicData.lyrics;

// // Create an audio object
// const audio = new Audio();
// audio.src = musicData.audioPath;

// // Play/pause functionality
// let isPlaying = false;
// playBtn.addEventListener('click', () => {
//     if (isPlaying) {
//         audio.pause();
//         isPlaying = false;
//         playBtn.textContent = 'Play';
//     } else {
//         audio.play();
//         isPlaying = true;
//         playBtn.textContent = 'Pause';
//     }
// });

// // Update progress bar and time
// audio.addEventListener('timeupdate', () => {
//     const progress = (audio.currentTime / audio.duration) * 100;
//     progressBar.style.width = `${progress}%`;

//     // Format current and total time
//     const currentTime = formatTime(audio.currentTime);
//     const totalTime = formatTime(audio.duration);
//     currentTimeEl.textContent = currentTime;
//     totalTimeEl.textContent = totalTime;
// });

// // Format time in mm:ss format
// function formatTime(time) {
//     const minutes = Math.floor(time / 60);
//     const seconds = Math.floor(time % 60).toString().padStart(2, '0');
//     return `${minutes}:${seconds}`;
// }

// // Progress bar click functionality
// progressBar.addEventListener('click', (e) => {
//     const progressWidth = progressBar.clientWidth;
//     const clickX = e.offsetX;
//     const duration = audio.duration;
//     audio.currentTime = (clickX / progressWidth) * duration;
// });

// // Volume control functionality
// volumeSlider.addEventListener('input', () => {
//     const volume = volumeSlider.value / 100;
//     audio.volume = volume;
// });

// // Previous and Next buttons functionality
// // You need to implement a playlist array and manage the current index accordingly

// // Update lyrics if available
// // You can add logic to display lyrics based on current time
// Get elements
const albumCoverEl = document.querySelector('.album-cover img');
const titleEl = document.querySelector('.title');
const artistsEl = document.querySelector('.artists');
const playBtn = document.querySelector('.play-btn');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');
const progressBar = document.querySelector('.progress-bar');
const currentTimeEl = document.querySelector('.current-time');
const totalTimeEl = document.querySelector('.total-time');
const volumeSlider = document.querySelector('.volume-slider');
const lyricsEl = document.querySelector('.lyrics');

// Create an audio object
const audio = new Audio();
audio.src = 'https://www.youtube.com/watch?v=by4SYYWlhEs';

// Play/pause functionality
let isPlaying = false;
playBtn.addEventListener('click', () => {
    if (isPlaying) {
        audio.pause();
        isPlaying = false;
        playBtn.textContent = 'Play';
    } else {
        audio.play().catch(error => {
            console.log(error); // Handle any potential errors
        });
        isPlaying = true;
        playBtn.textContent = 'Pause';
    }
});

// Update progress bar and time
audio.addEventListener('timeupdate', () => {
    const progress = (audio.currentTime / audio.duration) * 100;
    progressBar.style.width = `${progress}%`;

    // Format current and total time
    const currentTime = formatTime(audio.currentTime);
    const totalTime = formatTime(audio.duration);
    currentTimeEl.textContent = currentTime;
    totalTimeEl.textContent = totalTime;
});

// Format time in mm:ss format
function formatTime(time) {
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60).toString().padStart(2, '0');
    return `${minutes}:${seconds}`;
}

// Progress bar click functionality
progressBar.addEventListener('click', (e) => {
    const progressWidth = progressBar.clientWidth;
    const clickX = e.offsetX;
    const duration = audio.duration;
    audio.currentTime = (clickX / progressWidth) * duration;
});

// Volume control functionality
volumeSlider.addEventListener('input', () => {
    const volume = volumeSlider.value / 100;
    audio.volume = volume;
});
