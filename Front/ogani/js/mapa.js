function updateMap() {
    var selectedLocation = document.getElementById("locationSelect").value;
    var iframe = document.getElementById("mapFrame");
    var locationDetails = document.getElementById("locationDetails");

    var mapSrc = {
        option1: {
            src: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d555.1091833123237!2d-100.40487310915883!3d20.616030585356004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d3452af3e572cb%3A0xa88c8cc3fcd98038!2sOffice%20Depot!5e0!3m2!1sen!2smx!4v1722409948159!5m2!1sen!2smx",
            title: "Queretaro",
            phone: "+52 833 331 8671",
            address: "Queretaro, MX"
        },
        option2: {
            src: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3596.6064934146834!2d-100.34734802462604!3d25.651182586498432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8662bd90c010fd39%3A0x97658f8e1fb8cc24!2sOffice%20Depot!5e0!3m2!1sen!2smx!4v1722408120790!5m2!1sen!2smx",
            title: "Monterrey",
            phone: "+52 833 331 8671",
            address: "Monterrey, NL, MX"
        },
        option3: {
            src: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3732.904635210584!2d-103.39633020580605!3d20.673458454947834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428ae6ff60133b1%3A0x46bdf447dbdc1d4a!2sOffice%20Depot!5e0!3m2!1sen!2smx!4v1722410105893!5m2!1sen!2smx",
            title: "Guadalajara",
            phone: "+52 833 331 8671",
            address: "Guadalajara, Jalisco, MX"
        }
    };

    iframe.src = mapSrc[selectedLocation].src;
    locationDetails.innerHTML = `
        <h4>Sucursal ${mapSrc[selectedLocation].title}</h4>
        <ul>
            <li>Telefono: ${mapSrc[selectedLocation].phone}</li>
            <li>Direccion: ${mapSrc[selectedLocation].address}</li>
        </ul>
    `;
}