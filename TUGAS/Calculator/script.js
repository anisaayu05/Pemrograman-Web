let backspaceButton = document.getElementById('backspace');
let display = document.getElementById('display');
let currentInput = '';
let operator = '';

function updateDisplaySize() {
    if (currentInput.length > 10) {
        display.style.fontSize = '30px';
    } else if (currentInput.length > 15) {
        display.style.fontSize = '25px';
    } else if (currentInput.length > 20) {
        display.style.fontSize = '20px';
    } else {
        display.style.fontSize = '40px';
    }
}

function appendNumber(number) {
    if (display.value === 'Error' || currentInput === '') {
        currentInput = number;
    } else {
        currentInput += number;
    }
    display.value = currentInput;
    updateDisplaySize();
    toggleBackspaceButton();
}

function appendDecimal() {
    if (currentInput.includes('.')) return;
    if (display.value === 'Error' || currentInput === '') {
        currentInput = '0.';
    } else {
        currentInput += '.';
    }
    display.value = currentInput;
    updateDisplaySize();
    toggleBackspaceButton();
}

function toggleSign() {
    if (display.value) {
        let expression = display.value.trim();
        let lastNumberMatch = expression.match(/([+\-*/])?(-?\d*\.?\d+)$/);

        if (lastNumberMatch) {
            let lastOperator = lastNumberMatch[1] || '';
            let lastNumber = lastNumberMatch[2];

            if (lastNumber.startsWith('-')) {
                lastNumber = lastNumber.slice(1);
            } else {
                lastNumber = '-' + lastNumber;
            }

            display.value = expression.slice(0, expression.length - lastNumberMatch[0].length) + lastOperator + lastNumber;
        }
    }
}


function setOperator(op) {
    if (currentInput === '') return;
    if (operator !== '') calculate();
    operator = op;
    currentInput += ' ' + operator + ' ';
    display.value = currentInput;
    updateDisplaySize();
}

function calculate() {
    if (currentInput === '') return;
    try {
        let result = currentInput.replace(/×/g, '*').replace(/÷/g, '/').replace(/\^/g, '**');

        result = eval(result);
        
        display.value = result;
        currentInput = result.toString();
        operator = '';
        updateDisplaySize();
        toggleBackspaceButton();
    } catch (error) {
        display.value = 'Error';
        currentInput = '';
        toggleBackspaceButton();
    }
}

function clearDisplay() {
    currentInput = '';
    operator = '';
    display.value = '';
    display.style.fontSize = '40px';
    toggleBackspaceButton();
}

function deleteLastCharacter() {
    if (currentInput.length > 0) {
        currentInput = currentInput.slice(0, -1);
        display.value = currentInput;
        updateDisplaySize();
    } else {
        display.value = '';
    }
    toggleBackspaceButton();
}

function toggleBackspaceButton() {
    if (currentInput.length > 0) {
        backspaceButton.style.display = 'block';
    } else {
        backspaceButton.style.display = 'none';
    }
}

document.querySelectorAll('.button').forEach(button => {
    button.addEventListener('click', () => {
        const value = button.textContent;
        if (value === '=') {
            calculate();
        } else if (value === 'AC') {
            clearDisplay();
        } else if (value === '+/-') {
            toggleSign();
        } else if (['+', '-', '×', '÷', '^'].includes(value)) {
            setOperator(value);
        } else if (value === ',') {
            appendDecimal();
        } else {
            appendNumber(value);
        }
    });
});