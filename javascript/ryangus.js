let cislo;

document.getElementById("genbutton").onclick = function()
{
    cislo = Math.floor(Math.random() * 6) + 1;
    console.log(cislo);

    if(cislo == 1)
    {
        window.open("https://www.youtube.com/watch?v=lCsgZytKPv8&ab_channel=NuIndustrialMetalcore");
    }
    else if(cislo == 2)
    {
        window.open("https://www.youtube.com/watch?v=n6UbPd9R4V8&ab_channel=NezavisiLe");
    }
    else if(cislo== 3)
    {
        window.open("https://www.youtube.com/watch?v=ca0DQXE5JRw&ab_channel=4l1v1%D0%B8%D0%91%D1%803%D1%93%C2%A70%D0%B8");
    }
    else if(cislo == 4)
    {
        window.open("https://www.youtube.com/shorts/k1WITxmoq0E");
    }
    else if(cislo == 5)
    {
        window.open("https://www.youtube.com/watch?v=-HB06ajlZYI&ab_channel=BiniciWmeemes");
    }
    else if(cislo == 6)
    {
        window.open("https://www.youtube.com/shorts/DJAu6E3Jj2c");
    }
    else
    {
        alert("Jsi kkt!")
    }
}