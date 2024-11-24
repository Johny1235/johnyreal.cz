let chamber = 0;
let bulletPositions = [];
let mustSpin = true; 
let shotsFired = 0;
var audio = new Audio('../multimedia/revolver_shot.mp3');

document.getElementById("spin").addEventListener("click", () => {
    const bullets = parseInt(document.getElementById("bullets").value);
    bulletPositions = generateBulletPositions(bullets);
    chamber = Math.floor(Math.random() * 6);
    shotsFired = 0;

    const revolver = document.getElementById("revolver");
    revolver.classList.add("rotate");

    setTimeout(() => {
        revolver.classList.remove("rotate");
        document.getElementById("shoot").disabled = false;
        mustSpin = false;
        document.getElementById("result").textContent = "Revolver je nabitý a připravený.";
        updateShotCount();
    }, 1000);
});

document.getElementById("shoot").addEventListener("click", () => {
    if (mustSpin) {
        document.getElementById("result").textContent = "Nejdříve musíš roztočit revolver!";
        return;
    }

    shotsFired++;
    updateShotCount();

    if (bulletPositions.includes(chamber)) {
        document.getElementById("result").textContent = "Bang! Jsi mrtvý.";
        audio.play();
        document.getElementById("shoot").disabled = true;
    } else {
        document.getElementById("result").textContent = "Klik! Přežil jsi.";
        chamber = (chamber + 1) % 6;
        document.getElementById("shoot").disabled = false;
    }
});

function generateBulletPositions(bullets) {
    let positions = [];
    while (positions.length < bullets) {
        let position = Math.floor(Math.random() * 6);
        if (!positions.includes(position)) {
            positions.push(position);
        }
    }
    return positions;
}

function updateShotCount() {
    const shotCounter = document.getElementById("shot-count");
    if (!shotCounter) {
        const counterElement = document.createElement("p");
        counterElement.id = "shot-count";
        counterElement.textContent = `Počet vystřelených nábojů: ${shotsFired}`;
        document.body.appendChild(counterElement);
    } else {
        shotCounter.textContent = `Počet vystřelených nábojů: ${shotsFired}`;
    }
}
