document.addEventListener('DOMContentLoaded', function () {
    var deadbodyButton = document.getElementById('deadbodyButton');
    var crimeButton = document.getElementById('crimeButton');
    var deadbodyCard = document.getElementById('deadbody_card');
    var crimeCard = document.getElementById('crime_card');

    deadbodyButton.addEventListener('click', function () {
        deadbodyCard.style.display = 'block';
        crimeCard.style.display = 'none';
    });

    crimeButton.addEventListener('click', function () {
        deadbodyCard.style.display = 'none';
        crimeCard.style.display = 'block';
    });
});