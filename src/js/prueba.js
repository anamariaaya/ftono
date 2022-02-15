document.addEventListener('DOMContentLoaded', function(){
    mainSlide();
    pruebaNueva();
});
let i = 0;
function mainSlide(){
    const imgArray = [
        '../build/img/1.jpg',
        '../build/img/2.jpg',
        '../build/img/3.jpg',
        '../build/img/4.jpg',
        '../build/img/5.jpg',
        '../build/img/6.jpg',
        '../build/img/7.jpg'
    ];

    const slider = document.querySelector('.slider');
	imgArray.forEach(image => {		
	
	    const img = document.createElement('IMG');
	    img.src = `${imgArray[i]}`;
	    img.dataset.imagenId = i++;

	    slider.appendChild(img);
        const id = parseInt(img.dataset.imagenId);
	    // console.log(id);

        if (id == 0){
            img.classList.add('mainImg');
        } else if(id == 1){
            img.classList.add('rightImg');
        } else if(id == imgArray.length-1){
            img.classList.add('leftImg');
        }

        const buttonNext = document.querySelector('.next');
        const buttonPrev = document.querySelector('.prev');

        buttonNext.addEventListener('click', function(){
            img.src = `${imgArray[id]}`;
            if ( id < imgArray.length -1 ) {
                img.src = `${imgArray[id+1]}`  
            } else if(id = imgArray.length -1){
                img.src = `${imgArray[0]}`
            }
        });
            
        buttonPrev.addEventListener('click', function(){
            img.src = `${imgArray[id]}`;
            if ( id >= 0 ) {
                img.src = `${imgArray[id-1]}`;
            } else if(id = 0){
                img.src = `${imgArray[imgArray.length -1]}`;
            }
        });

    });    

};

function pruebaNueva(){
    const songs = document.querySelector('.ft-songs');
    console.log(songs);
}
