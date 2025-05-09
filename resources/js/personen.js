let groepen = document.querySelector("#groepen");
let hoeveel = document.querySelector("#hoeveel");
let personen = document.querySelector("#personen");

groepen.addEventListener("keyup", () => {
    let grote = Number(hoeveel.innerHTML) / groepen.value;
    if (Math.ceil(grote) != Infinity) {
        personen.innerHTML = "Elke groep heeft " + Math.ceil(grote) + " personen";
    } else {
        personen.innerHTML = "";
    }
});