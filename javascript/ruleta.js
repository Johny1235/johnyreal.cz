let chamber = 0;
let bulletPositions = [];

var audio = new Audio('../multimedia/revolver_shot.mp3');

document.getElementById("spin").addEventListener("click", () => {
    const bullets = parseInt(document.getElementById("bullets").value);
    bulletPositions = generateBulletPositions(bullets);
    chamber = Math.floor(Math.random() * 6);

    const revolver = document.getElementById("revolver");
    revolver.classList.add("rotate");

    setTimeout(() => {
        revolver.classList.remove("rotate");
        document.getElementById("shoot").disabled = false;
        document.getElementById("result").textContent = "Revolver je nabitý a připravený.";
    }, 1000);
});

document.getElementById("shoot").addEventListener("click", () => {
    if (bulletPositions.includes(chamber)) {
        document.getElementById("result").textContent = "Bang! Jsi mrtvý.";
        audio.play();
        document.getElementById("shoot").disabled = true;
    } else {
        document.getElementById("result").textContent = "Klik! Přežil jsi.";
        document.getElementById("shoot").disabled = bulletPositions.every(pos => pos !== chamber);
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