for(let i=0;i<6;i=i+1){
    let gifplayer=new GifPlayer();
    gifplayer.load('path/to/your-gif.gif', document.getElementById('gifContainer'));

    function toggleGif() {
        gifplayer.toggle();
    }
}