const form = document.querySelector("#shortenForm");
const shortenCard = document.querySelector("#shortCard");
const inputurl = document.querySelector("#url");
const btnshorted = document.querySelector("#btnshorted");

const URL_SHORTEN = "/ajax/shorten";
const errorMessage = {
    'INVALIDE_ARG_URL': "Impossible de raccourssir ce lien. Ce n'est pas un url valide",
    'MISSING_ARG_URL': "Veuillez saisir un lien à raccoursir!"
}

form.addEventListener('submit', function (e) {
    e.preventDefault();

    fetch(URL_SHORTEN, {
        method: 'POST',
        body: new FormData(e.target)
    })
        .then(response => response.json())
        .then(handleData);
});

const handleData = function (data) {
    console.log(data);
    if (data.statusCode >= 400) {
        return handleError(data);
    }

    inputurl.value = data.link;
    btnshorted.innerText = "Copier le lien";

    btnshorted.addEventListener('click', function (e) {
        e.preventDefault();
        inputurl.select();
        document.execCommand('copy');

        this.innerText = "Reduir l'url";


    }, { 'once': true })
}

const handleError = function (data) {
    const alert = document.createElement('div');
    alert.classList.add('alert', 'alert-danger', 'mt-2');
    alert.innerText = errorMessage[data.statusText];

    shortenCard.after(alert);

}