function clearDisplay() {
    document.getElementById('display').value = '';
}

function appendToDisplay(value) {
    document.getElementById('display').value += value;
}

function backspace() {
    var display = document.getElementById('display').value;
    document.getElementById('display').value = display.substring(0, display.length - 1);
}

function calculate() {
    var display = document.getElementById('display').value;
    var result = eval(display);
    document.getElementById('display').value = result;
}

function calculateSquareRoot() {
    var display = document.getElementById('display').value;
    var result = Math.sqrt(eval(display));
    document.getElementById('display').value = result;
}

function trigFunction(func) {
    var angle = parseFloat(document.getElementById('display').value);
    var result;
    
    switch(func) {
        case 'sin':
            result = Math.sin(angle * Math.PI / 180).toFixed(5);
            break;
        case 'cos':
            result = Math.cos(angle * Math.PI / 180).toFixed(5);
            break;
        case 'tan':
            result = Math.tan(angle * Math.PI / 180).toFixed(5);
            break;
        default:
            result = '';
    }
    
    document.getElementById('display').value = result;
}

