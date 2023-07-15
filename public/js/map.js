console.log("ok");



let map;

async function initMap() {
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");

  map = new Map(document.getElementById("map_c"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 6,
  });
}

initMap();