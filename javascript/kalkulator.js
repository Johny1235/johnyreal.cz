// Import required libraries
const readline = require('readline');

// Define functions
function scitaniAOdcitani(a, b) {
  const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
  });

  return new Promise((resolve) => {
    rl.question("Zadejte, kolik chcete secist a/nebo odecist cisel: \n", (scitanec) => {
      if (scitanec >= 2) {
        let soucet = 0;
        let poradi_plus = 0;

        const askForNumber = () => {
          poradi_plus++;
          rl.question(`${poradi_plus}. cislo: `, (cislo) => {
            soucet += parseFloat(cislo);
            if (poradi_plus < scitanec) {
              askForNumber();
            } else {
              rl.close();
              resolve(soucet);
            }
          });
        };

        askForNumber();
      } else {
        console.log("Musi se secist/odecist minimalne 2 cisla!");
        rl.close();
        resolve(null);
      }
    });
  });
}

function nasobeni(a, b) {
  const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
  });

  return new Promise((resolve) => {
    rl.question("Zadejte, kolik chcete vynasobit cisel: \n", (cinitel) => {
      if (cinitel >= 2) {
        let soucin = 0;
        let poradi_krat = 0;

        const askForNumber = () => {
          poradi_krat++;
          rl.question(`${poradi_krat}. cislo: `, (cislo) => {
            const parsedCislo = parseFloat(cislo);
            if (poradi_krat === 1) {
              soucin += parsedCislo;
            } else {
              soucin *= parsedCislo;
            }
            if (poradi_krat < cinitel) {
              askForNumber();
            } else {
              rl.close();
              resolve(soucin);
            }
          });
        };

        askForNumber();
      } else {
        console.log("Musi se vynasobit minimalne 2 cisla!");
        rl.close();
        resolve(null);
      }
    });
  });
}

function deleni(a, b) {
  const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
  });

  return new Promise((resolve) => {
    rl.question("Zadejte delenec: \n", (delenec) => {
      rl.question("Zadejte delitel: \n", (delitel) => {
        rl.close();
        resolve(parseFloat(delenec) / parseFloat(delitel));
      });
    });
  });
}

function umocnovani(a, b) {
  const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
  });

  return new Promise((resolve) => {
    rl.question("Zadejte zaklad mocniny: \n", (zaklad) => {
      rl.question("Zadejte exponent: \n", (exponent) => {
        rl.close();
        resolve(Math.pow(parseFloat(zaklad), parseFloat(exponent)));
      });
    });
  });
}

function odmocnovani(a, b) {
  const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
  });

  return new Promise((resolve) => {
    rl.question("Zadejte odmocninu z y: \n", (y) => {
      rl.question("Zadejte x-tou odmocninu: \n", (x) => {
        rl.close();
        resolve(Math.pow(parseFloat(y), 1 / parseFloat(x)));
      });
    });
  });
}

function posloupnost(n) {
  const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
  });

  return new Promise((resolve) => {
    rl.question("Zadejte pocet prvku z Fibonacciho posloupnosti (alespon 3): \n", (pocetPrvku) => {
      if (pocetPrvku >= 3) {
        let prvni = 0;
        let druhe = 1;
        let rada = prvni + druhe;

        console.log(`Fibonacciho posloupnost: ${prvni} ${druhe}`);

        for (let i = 3; i <= pocetPrvku; i++) {
          console.log(rada);
          prvni = druhe;
          druhe = rada;
          rada = prvni + druhe;
        }
      } else {
        console.log("Bylo zadano malo prvku!");
      }

      rl.close();
      resolve();
    });
  });
}

function faktorial(x) {
  if (x === 0) {
    return 1;
  }

  return x * faktorial(x - 1);
}

function konstanty(konst, co) {
  const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
  });

  return new Promise((resolve) => {
    rl.question("Zadejte 'e' pro Eulerovo cislo, 'p' pro Pi nebo 'z' pro zlaty rez: \n", (volba) => {
      if (volba === 'e') {
        console.log(`= ${Math.exp(1)}`);
      } else if (volba === 'p') {
        console.log(`= ${Math.PI}`);
      } else if (volba === 'z') {
        const zlatyRez = (1.0 + Math.sqrt(5)) / 2.0;
        console.log(`= ${zlatyRez}`);
      }

      rl.close();
      resolve();
    });
  });
}

// Main function
async function main() {
  const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
  });

  while (true) {
    console.log("--------------------------------------------------------------");
    console.log("|                       ZADEJTE OPERACI                      |");
    console.log("| '+' nebo '-' pro scitani a odcitani                        |");
    console.log("| '*' pro nasobeni                                           |");
    console.log("| '/' pro deleni dvou cisel                                  |");
    console.log("| 'o' pro odmocnovani                                        |");
    console.log("| 'm' pro umocnovani                                         |");
    console.log("| 'r' pro radu cisel Fibonacciho posloupnosti                |");
    console.log("| 'f' pro fatorial cisla x                                   |");
    console.log("| 'k' pro konstantu                                          |");
    console.log("|                 (Zadejte 'x' pro ukonceni.)                |");
    console.log("| (Pro opetovne spusteni kalkulacky stisnete na konci Enter) |");
    console.log("--------------------------------------------------------------");

    const operace = await new Promise((resolve) => rl.question(" ", resolve));

    switch (operace) {
      case '+':
      case '-':
        const vysledekScitaniOdcitani = await scitaniAOdcitani();
        if (vysledekScitaniOdcitani !== null) {
          console.log(`= ${vysledekScitaniOdcitani}`);
        }
        break;
      case '*':
        const vysledekNasobeni = await nasobeni();
        if (vysledekNasobeni !== null) {
          console.log(`= ${vysledekNasobeni}`);
        }
        break;
      case '/':
        const vysledekDeleni = await deleni();
        console.log(`= ${vysledekDeleni}`);
        break;
      case 'm':
      case 'M':
        const vysledekUmocnovani = await umocnovani();
        console.log(`= ${vysledekUmocnovani}`);
        break;
      case 'o':
      case 'O':
        const vysledekOdmocnovani = await odmocnovani();
        console.log(`= ${vysledekOdmocnovani}`);
        break;
      case 'r':
      case 'R':
        await posloupnost();
        break;
      case 'f':
      case 'F':
        rl.question("Zadejte cislo Vaseho faktorialu: \n", (cislo) => {
          const cisloFaktorialu = faktorial(parseInt(cislo));
          console.log(`= ${cisloFaktorialu}`);
        });
        break;
      case 'k':
      case 'K':
        await konstanty();
        break;
      case 'x':
      case 'X':
        rl.close();
        return;
      default:
        console.log("JSI DEBILEK!");
        rl.close();
        return;
    }

    rl.question("Stiskněte Enter pro další operaci...", () => {});
  }
}

main();