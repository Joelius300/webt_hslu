function drawMushroom() {
    const canvas = document.getElementById('mushroom-canvas');
    const ctx = canvas.getContext('2d');

    const canvasCenter = canvas.width / 2;

    const hatRadius = canvas.height * 0.35;
    const stemWidth = canvas.height * 0.2;
    const stemHeight = canvas.height * 0.55;
    const stemTop = canvas.height * 0.95 - stemHeight;

    // Stem
    ctx.fillStyle = '#f7deb4';
    ctx.strokeStyle = '#d2b385';
    ctx.fillRect(canvasCenter - stemWidth / 2, stemTop, stemWidth, stemHeight);
    ctx.strokeRect(canvasCenter - stemWidth / 2, stemTop, stemWidth, stemHeight);

    // White stuff around top of stem
    ctx.beginPath();
    ctx.moveTo(canvasCenter - stemWidth / 2, stemTop);
    ctx.lineTo(canvasCenter - stemWidth / 2 - stemWidth / 5, stemTop + stemHeight / 3);
    ctx.lineTo(canvasCenter + stemWidth / 2 + stemWidth / 5, stemTop + stemHeight / 3);
    ctx.lineTo(canvasCenter + stemWidth / 2, stemTop);
    ctx.closePath();
    ctx.strokeStyle = '#c4c4c4';
    ctx.fillStyle = '#ece3e3';
    ctx.fill();
    ctx.stroke();

    // Hat
    ctx.fillStyle = 'red';
    ctx.beginPath();
    ctx.arc(canvasCenter, stemTop, hatRadius, Math.PI - Math.PI / 8, Math.PI / 8, false);
    ctx.closePath();
    ctx.fill();

    // Dots
    // This should be done with a loop, but to ensure that I'm explicitly calling 10 drawing methods, it's unwrapped.
    ctx.fillStyle = '#ece3e3';
    ctx.beginPath();
    ctx.arc(canvasCenter + hatRadius * 0.05, stemTop - hatRadius * 0.65, hatRadius / 10, 0, 2 * Math.PI);
    ctx.closePath();
    ctx.fill();
    ctx.stroke();

    ctx.beginPath();
    ctx.arc(canvasCenter + hatRadius * 0.45, stemTop - hatRadius * 0.25, hatRadius / 10, 0, 2 * Math.PI);
    ctx.closePath();
    ctx.fill();
    ctx.stroke();

    ctx.beginPath();
    ctx.arc(canvasCenter - hatRadius * 0.1, stemTop - hatRadius * 0.05, hatRadius / 10, 0, 2 * Math.PI);
    ctx.closePath();
    ctx.fill();
    ctx.stroke();

    ctx.beginPath();
    ctx.arc(canvasCenter - hatRadius * 0.4, stemTop - hatRadius * 0.5, hatRadius / 10, 0, 2 * Math.PI);
    ctx.closePath();
    ctx.fill();
    ctx.stroke();

    ctx.beginPath();
    ctx.arc(canvasCenter - hatRadius * 0.6, stemTop + hatRadius * 0.05, hatRadius / 10, 0, 2 * Math.PI);
    ctx.closePath();
    ctx.fill();
    ctx.stroke();
}

const knownMushrooms = {
    steinpilz: {
        color: 'Hellbraun',
    },
    fliegenpilz: {
        color: 'Rot'
    },
};

function validateKnownMushrooms() {
    const name = document.getElementById('name').value;
    const mushroom = knownMushrooms[name.toLowerCase()];
    if (!name || !mushroom)
        return;

    const select = document.getElementById('color');
    const color = select.options[select.selectedIndex].label;

    if (color !== mushroom.color) {
        const errorLabel = document.getElementById('colorErrorLabel');
        errorLabel.innerText = `Dies ist ein bekannter Pilz und hat die Farbe ${mushroom.color}, nicht ${color}.`;
        errorLabel.removeAttribute('hidden');
        const handler = () =>
        {
            if (select.options[select.selectedIndex].label === mushroom.color) {
                errorLabel.setAttribute('hidden', '');
                select.removeEventListener('input', handler);
            }
        }
        select.addEventListener('input', handler);

        return false;
    }

    return true;
}

drawMushroom();