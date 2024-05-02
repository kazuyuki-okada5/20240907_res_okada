// reservation.js

function updateDisplay() {
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    const numPeople = document.getElementById('num_people').value;
    const storeName = document.getElementById('displayStoreName').textContent;
    document.getElementById('displayDate').textContent = date;
    document.getElementById('displayTime').textContent = time;
    document.getElementById('displayNumPeople').textContent = numPeople;
    document.getElementById('displayStoreName').textContent = storeName;
}

document.getElementById('date').addEventListener('input', updateDisplay);
document.getElementById('time').addEventListener('change', updateDisplay);
document.getElementById('num_people').addEventListener('change', updateDisplay);

document.getElementById('bookingForm').addEventListener('submit', function () {
    updateDisplay();
});