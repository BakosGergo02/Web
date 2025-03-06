
// app.js

// Complete logic of game inside this function
const game = () => {
    let playerScore = 0;
    let computerScore = 0;
    let tieScore = 0;
    let moves = 0;


    // Function to
    const playGame = () => {
        const rockBtn = document.querySelector('.kő');
        const paperBtn = document.querySelector('.papír');
        const scissorBtn = document.querySelector('.olló');
        const playerOptions = [rockBtn, paperBtn, scissorBtn];
        const computerOptions = ['rock', 'paper', 'scissors']

        // Function to start playing game
        playerOptions.forEach(option => {
            option.addEventListener('click', function () {

                const movesLeft = document.querySelector('.maradeklepes');
                moves++;
                movesLeft.innerText = `Maradt lépések: ${10 - moves}`;


                const choiceNumber = Math.floor(Math.random() * 3);
                const computerChoice = computerOptions[choiceNumber];

                // Function to check who wins
                winner(this.value, computerChoice)

                // Calling gameOver function after 10 moves
                if (moves == 10) {
                    gameOver(playerOptions, movesLeft);
                }
            })
        })

    }

    // Function to decide winner
    const winner = (player, computer) => {

        console.log("Player's choice:", player);
        console.log("Computer's choice:", computer);

        const result = document.querySelector('.vegeredmeny');
        const playerScoreBoard = document.querySelector('.j-count');
        const computerScoreBoard = document.querySelector('.sz-count');
        const tieScoreBoard = document.querySelector('.d-count');


        player = player.toLowerCase();
        computer = computer.toLowerCase();

        if (player == computer) {
            result.textContent = 'Döntetlen'
            tieScore++;
            tieScoreBoard.textContent = tieScore;
        }
        else if (player == 'rock') {
            if (computer == 'paper') {
                result.textContent = 'A számítógép nyert!';
                computerScore++;
                computerScoreBoard.textContent = computerScore;

            } else {
                result.textContent = 'A játékos nyert!'
                playerScore++;
                playerScoreBoard.textContent = playerScore;
            }
        }
        else if (player == 'scissors') {
            if (computer == 'rock') {
                result.textContent = 'A számítógép nyert!';
                computerScore++;
                computerScoreBoard.textContent = computerScore;
            } else {
                result.textContent = 'A játékos nyert!';
                playerScore++;
                playerScoreBoard.textContent = playerScore;
            }
        }
        else if (player == 'paper') {
            if (computer == 'scissors') {
                result.textContent = 'A számítógép nyert!';
                computerScore++;
                computerScoreBoard.textContent = computerScore;
            } else {
                result.textContent = 'A játékos nyert!';
                playerScore++;
                playerScoreBoard.textContent = playerScore;
            }
        }
    }

    // Function to run when game is over
    const gameOver = (playerOptions, movesLeft) => {

        const chooseMove = document.querySelector('.lepes');
        const result = document.querySelector('.vegeredmeny');
        const reloadBtn = document.querySelector('.ujra');

        playerOptions.forEach(option => {
            option.style.display = 'none';
        })


        chooseMove.innerText = 'Játék Vége!'
        movesLeft.style.display = 'none';

        if (playerScore > computerScore) {
            result.style.fontSize = '2rem';
            result.innerText = 'Nyertél!!'
            result.style.color = '#308D46';
        }
        else if (playerScore < computerScore) {
            result.style.fontSize = '2rem';
            result.innerText = 'Vesztettél.';
            result.style.color = 'red';
        }
        else {
            result.style.fontSize = '2rem';
            result.innerText = 'Döntetlen';
            result.style.color = 'grey'
        }
        reloadBtn.innerText = 'Újra';
        reloadBtn.style.display = 'flex'
        reloadBtn.addEventListener('click', () => {
            window.location.reload();
        })
    }


    // Calling playGame function inside game
    playGame();

}

// Calling the game function
game();
