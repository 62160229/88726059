var score = 0,
    highScore = 0,
    time = 30,
    timer;
var IsPlaying = false;
var timeBoard = document.getElementById('time'),
    scoreBoard = document.getElementById('score'),
    btnStart = document.getElementById('btn');

/**
 * Makes the provided element fall down by changing the top property.
 * @param {HTMLElement} orange 
 */
function fallDown(orange) {
    if (!(IsPlaying && orange instanceof HTMLElement)) {
        return;
    }
    orange.setAttribute('data-top', orange.style.top);
    orange.style.top = "580px";
    score = score + 4;
    renderScore();
    hideFallenOrange(orange);
}
/**
 * Hides the provided element by changing the display property.
 * @param {HTMLElement} orange 
 */
function hideFallenOrange(orange) {
    setTimeout(function () {
        orange.style.display = 'none';
        restoreFallenOrange(orange);
    }, 600);
}
/**
 * Shows the provided element by changing the display property and restores top position.
 * @param {HTMLElement} orange 
 */
function restoreFallenOrange(orange) {
    orange.style.top = orange.getAttribute('data-top');
    setTimeout(function () {
        orange.style.display = 'inline-block';
    }, 600);
}

function renderScore() {
    scoreBoard.innerText = score;
    if (score > highScore) {
        highScore = score;
        document.getElementById('high').innerText = highScore;
    }
}

function startGame() {
    //disable the button to make it unclickable
    btnStart.disabled = "disabled";
    IsPlaying = true;
    renderScore();
    timer = setInterval(countDown, 1000);
}

function countDown() {
    time = time - 1;
    timeBoard.innerText = time;
    if (time == 0) {
        //clear interval the timer refrence
        clearInterval(timer);
        //call end game
        endGame();
    }
}
function endGame() {
    IsPlaying = false;
    alert("Your score is " + score);
    //reset score and time for next game.
    score = 0;
    time = 30;
    //enable the button to make it clickable
    btnStart.removeAttribute('disabled');
}