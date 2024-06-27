const mario = document.querySelector('.mario');
const pipe = document.querySelector('.pipe');
const scoreDisplay = document.getElementById('score'); // Selecionando o elemento que exibe a pontuação
let score = 0; // Inicializando a pontuação

const jump = () => {
    console.log("PULOUUUU")
    mario.classList.add('jump');

    setTimeout(() => {
        mario.classList.remove('jump');
    }, 500);
}

const loop = setInterval(() => {
    const pipePosition = pipe.offsetLeft;
    const marioPosition = parseFloat(window.getComputedStyle(mario).bottom);

    if (pipePosition <= 120 && pipePosition > 0 && marioPosition < 80) {
        pipe.style.animation = 'none';
        pipe.style.left = `${pipePosition}px`;

        mario.style.animation = 'none';
        mario.style.bottom = `${marioPosition}px`;

        mario.src = './imagem/game-over.png';
        mario.style.width = '75px';
        mario.style.marginLeft = '50px'; 
        clearInterval(loop); 
    } else {
        score++;
        scoreDisplay.textContent = score; 
    }
}, 10);

document.addEventListener('keydown', jump);
