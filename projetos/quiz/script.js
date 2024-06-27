const questions = [
    {
        question: "Qual é a capital do Brasil?",
        options: ["São Paulo", "Brasília", "Rio de Janeiro", "Belo Horizonte"],
        answer: "Brasília"
    },
    {
        question: "Quem pintou a Mona Lisa?",
        options: ["Leonardo da Vinci", "Pablo Picasso", "Vincent van Gogh", "Claude Monet"],
        answer: "Leonardo da Vinci"
    },
    {
        question: "Quantos planetas existem no sistema solar?",
        options: ["7", "8", "9", "10"],
        answer: "8"
    }
];

let currentQuestion = 0;
let score = 0;

const questionElement = document.getElementById('question');
const optionsContainer = document.getElementById('options-container');
const resultElement = document.getElementById('result');
const resultContainer = document.getElementById('result-container');
const nextButton = document.getElementById('next-btn');

function showQuestion() {
    const currentQ = questions[currentQuestion];
    questionElement.textContent = currentQ.question;
    
    optionsContainer.innerHTML = '';
    currentQ.options.forEach((option, index) => {
        const button = document.createElement('button');
        button.textContent = option;
        button.classList.add('option');
        button.onclick = () => checkAnswer(button);
        optionsContainer.appendChild(button);
    });
}

function checkAnswer(button) {
    const selectedAnswer = button.textContent;
    const currentQ = questions[currentQuestion];
    
    if (selectedAnswer === currentQ.answer) {
        score++;
        resultElement.textContent = 'Correto!';
    } else {
        resultElement.textContent = 'Incorreto. A resposta correta é: ' + currentQ.answer;
    }
    
    resultContainer.style.display = 'block';
    nextButton.style.display = 'block';
    
    // Desabilitar cliques em outras opções após responder
    const options = optionsContainer.querySelectorAll('.option');
    options.forEach(option => {
        option.onclick = null;
    });
}

function nextQuestion() {
    resultContainer.style.display = 'none';
    nextButton.style.display = 'none';
    
    currentQuestion++;
    
    if (currentQuestion < questions.length) {
        showQuestion();
    } else {
        endQuiz();
    }
}

function endQuiz() {
    questionElement.textContent = 'Quiz finalizado!';
    optionsContainer.innerHTML = `<p>Você acertou ${score} de ${questions.length} perguntas.</p>`;
}
  
// Iniciar o quiz ao carregar a página
document.addEventListener('DOMContentLoaded', () => {
    showQuestion();
});