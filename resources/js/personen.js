let groepen = document.querySelector("#groepen");
let hoeveel = document.querySelector("#hoeveel");
let personen = document.querySelector("#personen");

groepen.addEventListener("keyup", () => {
    console.log(groepen.value, hoeveel.innerHTML);
    let grote = Number(hoeveel.innerHTML) / groepen.value;
    console.log(Math.ceil(grote));
    if (Math.ceil(grote) != Infinity) {
        personen.innerHTML = "Elke groep heeft " + Math.ceil(grote) + " personen";
    } else {
        personen.innerHTML = "";
    }
});