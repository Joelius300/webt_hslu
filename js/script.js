// Failed stuff with OpenAI sadge
var canvas = document.getElementById('mushroom-canvas');
var ctx = canvas.getContext('2d');
var diameter = 200;
var mushroom = {
    // Mushroom properties
    radius: diameter / 2,
    height: (diameter - 100) / 2,
    center: {x: 400, y: 500},
    // Color
    color: {r: 0.4, g: 0.4, b: 0.4},
    // Fungus (mushroom cap) properties
    // Position of center of cap relative to mushroom center
    capPosition: {x: diameter - 25, y: diameter - 25},
    // Cap properties
    capRadius: 25,
    capHeight: 25,
    capColor: {r: 0.3, g: 0.8, b: 0.3},
};

// function draw() {
//     ctx.clearRect(0, 0, canvas.width, canvas.height);
//     // Draw the center of the mushroom
//     ctx.beginPath();
//     ctx.arc(mushroom.center.x, mushroom.center.y, mushroom.radius, 0, Math.PI * 2);
//     ctx.stroke();
//     // Draw the fungus cap
//     // ctx.beginPath();
//     // ctx.arc(mushroom.center.x, mushroom.center.y, mushroom.capPosition.x, mushroom.capPosition.y, 0, 2 * Math.PI);
//     // ctx.fillStyle = mushroom.capColor;
//     // ctx.strokeStyle = mushroom.capColor;
//     // ctx.fill();
//     // ctx.stroke();
// }

function drawMushroom() {
    var radius = mushroom.radius;
    var capColor = mushroom.capColor;

// Calculate x and y coordinates of the center of the cap
    var capX = mushroom.center.x - radius;
    var capY = mushroom.center.y - radius;

// Calculate radius of cap
    var capRadius = (mushroom.capPosition.x - mushroom.center.x) * 2 +
        (mushroom.capPosition.y - mushroom.center.y) * 2;

// // Set black color and fill the canvas with it
//     ctx.fillStyle = 'black';
//     ctx.fillRect(0, 0, canvas.width, canvas.height);

// Draw the cap
    ctx.fillStyle = capColor.r;
    ctx.fillRect(capX, capY, capRadius, mushroom.capHeight);

// Draw the stem
    ctx.fillStyle = capColor.g;
    ctx.fillRect(mushroom.center.x, mushroom.center.y, diameter,
        diameter);

// Draw the mushroom
    ctx.fillStyle = capColor.b;
    ctx.fillRect(mushroom.center.x, mushroom.center.y, diameter,
        diameter);
}

drawMushroom();