function moveToNextInput(event, nextInputId) {
    if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById(nextInputId).focus();
    }
}
function checkAndSum() {
    const firstName = document.getElementById('firstname').value;
    const lastName = document.getElementById('lastname').value;

    const numbers = [
        parseFloat(document.getElementById('number1').value),
        parseFloat(document.getElementById('number2').value),
        parseFloat(document.getElementById('number3').value),
        parseFloat(document.getElementById('number4').value),
        parseFloat(document.getElementById('number5').value),
        parseFloat(document.getElementById('number6').value),
        parseFloat(document.getElementById('number7').value),
    ];
    const number = [...numbers];
    const sumOfAllNumbers = numbers.reduce((acc, value) => acc + value, 0);
    const minValue = Math.min(...numbers);
    const maxValue = Math.max(...numbers);
    if (numbers.filter(value => value === minValue).length > 1 && numbers.filter(value => value === maxValue).length > 1) {
        const hasMaxValue = numbers.includes(maxValue);
        const hasMinValue = numbers.includes(minValue);
        if (hasMaxValue && hasMinValue) {
            numbers.splice(numbers.indexOf(minValue), 1);
            numbers.splice(numbers.indexOf(maxValue), 1);
        }
    } else {

        numbers.splice(numbers.indexOf(minValue), 1);
        numbers.splice(numbers.indexOf(maxValue), 1);
    }

    const finalSum = numbers.reduce((acc, value) => acc + value, 0);
    saveScores(firstName, lastName, number, sumOfAllNumbers, finalSum);
}

function saveScores(firstName, lastName, numbers, sumOfAllNumbers, finalSum) {
    $.ajax({
        type: 'POST',
        url: '../../service/score/create.php',
        data: {
            firstname: firstName,
            lastname: lastName,
            scores: numbers,
            totalSum: sumOfAllNumbers,
            finalSum: finalSum
        },
        dataType: 'json'
    }).done(function (resp) {
        Swal.fire({
            text: 'เพิ่มข้อมูลเรียบร้อย',
            icon: 'success',
            confirmButtonText: 'ตกลง',
            showConfirmButton: false,
            timer: 500
        }).then((result) => {
            location.assign('./index.php');
        });
    });
}