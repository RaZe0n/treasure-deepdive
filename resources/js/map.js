let map = L.map('map').setView([53.210925, 6.566284], 15);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

let lines = [];

async function getRoute(part, color) {
    let json = await fetch("api/json/route.json");
    let data = await json.json();
    console.log(data[part]);
    let route = L.polyline(data[part], {color: color, weight: '5'}).addTo(map);
    lines.push(route);
    let group = L.featureGroup(lines);
    map.fitBounds(group.getBounds());
}

// https://maps.app.goo.gl/3k3YA5TaJQhcZAXd9

getRoute("deel-1", "red");
getRoute("deel-2", "green");
getRoute("deel-3", "blue");
getRoute("deel-4", "red");
getRoute("deel-5", "green");

let coordinates = [];

map.on("contextmenu", function (event) {
    // console.log("Coordinates: " + event.latlng.toString());
    coordinates += "[" + [event.latlng.lat, event.latlng.lng] + "], ";
});

map.on("keypress", (key) => {
    console.log(key.originalEvent.key);
    if (key.originalEvent.key == "Enter") {
        console.log(coordinates);
    }
});